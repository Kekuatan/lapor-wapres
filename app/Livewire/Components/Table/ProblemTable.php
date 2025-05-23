<?php

namespace App\Livewire\Components\Table;

use App\Enums\ProblemEnum;
use App\Enums\RoleAndPermissionEnum;
use App\Models\Problem;
use App\Models\Role;
use App\Services\ProblemService\ProblemTableActionService;
use App\Services\RoleAndPermission\PermissionService;
use App\Services\UserService\UserTableActionService;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Mockery\Exception;

class ProblemTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    private ProblemTableActionService $problemTableActionService;

    public function __construct()
    {
        $this->problemTableActionService = new ProblemTableActionService();
        if (!(new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: RoleAndPermissionEnum::READ)) {
            $this->redirect('/');
        }
    }


    private function getActionFormForCreateAndUpdate($actionBuilder, $type = 'create'){
        return $actionBuilder->form([
            Textarea::make('problem')->required(),
        ]);
    }

    public function table(Table $table): ?Table
    {
        return $table
            ->query($this->problemTableActionService->getTableQuery())
            ->columns([
                TextColumn::make('createdBy.name')->label('name')->searchable(),
                TextColumn::make('problem')->label('problem')->searchable(),
                TextColumn::make('status')->label('status')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        return ProblemEnum::getStatus($record->status);
                    })
                    ->searchable(),
            ])
            ->headerActions([$this->getActionCreate()])
            ->actions([
                ActionGroup::make(
                    [
                        $this->getActionEdit(),
                        $this->getActionDelete(),
                    ]
                ),
            ], position: ActionsPosition::BeforeCells);

    }
    private function getActionCreate(){

        $actionBuilder = CreateAction::make()
            ->using(function (array $data, Action $action): Model {
                try {
                    $data = collect($data)
                        ->put('created_by', Auth::user()->id)
                        ->toArray();
                    $response = $this->problemTableActionService->store($data);
                } catch (Exception $exception) {
                    toastr()->error($exception->getMessage());
                    $action->halt();
                }
                toastr()->success($response['message']);
                return $response['data'];
            })
            ->successNotification(null)
            ->slideOver();
        return
            $this->getActionFormForCreateAndUpdate($actionBuilder);
    }

    private function getActionEdit(){
        $actionBuilder = EditAction::make()
            ->fillForm(function (array $data, Action $action): array {
                $default = $action->getRecord()->toArray();
                return $default;
            })
            ->using(function (array $data, Action $action): Model {
                try {
                    DB::beginTransaction();
                    $default = $action->getRecord()->toArray();
                    $id = $default['id'];
                    $response = $this->problemTableActionService->update($id, $data);
                    DB::commit();
                } catch (Exception $exception) {
                    toastr()->error($exception->getMessage());
                    $action->halt();
                }
                toastr()->success('Edit success');
                return $response['data'];
            })
            ->successNotification(null)
            ->slideOver();
        return $this->getActionFormForCreateAndUpdate($actionBuilder, 'edit');
    }


    private function getActionDelete()
    {
        return DeleteAction::make('delete')
            ->using(function (array $data, Action $action): Model {
            try {
                $default = $action->getRecord()->toArray();
                $id = $default['id'];
                $response = $this->problemTableActionService->delete($id);
            } catch (Exception $exception) {
                toastr()->error($exception->getMessage());
                $action->halt();
            }
            toastr()->success($response['message']);
            return $response['data'];
        })->requiresConfirmation();
    }
    public function render()
    {
        return view('livewire.components.table.problem-table');
    }
}
