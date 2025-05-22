<?php

namespace App\Livewire\Components\Table;

use App\Enums\RoleAndPermissionEnum;
use App\Models\Problem;
use App\Models\Role;
use App\Services\RoleAndPermission\PermissionService;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
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
    use \Filament\Tables\Concerns\InteractsWithTable;
    use \Filament\Forms\Concerns\InteractsWithForms;

    public function __construct()
    {
//        $this->attachmentService = new AttachmentService();
        if (!(new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: RoleAndPermissionEnum::READ)) {
            $this->redirect('/');
        }
    }


    private function getActionFormForCreateAndUpdate($actionBuilder, $type = 'create'){
        return $actionBuilder->form([
            Textarea::make('problem')->required(),
        ]);
    }

    private function getActionCreate(){

        $actionBuilder = CreateAction::make()
            ->using(function (array $data, Action $action): Model {
                try {
                    DB::beginTransaction();
                    $data = collect($data)->except([ 'signature'])
                        ->put('created_by', Auth::user()->id)
                        ->toArray();
                    $problem = Problem::create($data);
                    DB::commit();
                } catch (Exception $exception) {
                    DB::rollBack();
                    toastr()->error($exception->getMessage() . ' ' . $exception->getLine());
                    $action->halt();
                }
                toastr()->success('Create success');
                return $problem;

            })
            ->successNotification(null)
            ->slideOver();
        return
            $this->getActionFormForCreateAndUpdate($actionBuilder)
            ;
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
                    $updateData = collect($data)->toArray();
                    Problem::where('id', $id)->update($updateData);
                    $problem = Problem::where('id', $id)->first();
                    DB::commit();
                } catch (Exception $exception) {
                    DB::rollBack();
                    toastr()->error($exception->getMessage() . ' ' . $exception->getLine());
                    $action->halt();
                }
                toastr()->success('Edit success');
                return $problem;

            })
            ->successNotification(null)
            ->slideOver();
        return $this->getActionFormForCreateAndUpdate($actionBuilder, 'edit');
    }
    public function table(Table $table): ?Table
    {
        return $table
            ->query(Problem::query()->with(['createdBy']))
            ->columns([
                TextColumn::make('createdBy.name')->label('name')->searchable(),
                TextColumn::make('problem')->label('problem')->searchable(),
                TextColumn::make('status')->label('status')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        return 'Terkirim' ;
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
                )
//                    ->icon('icon-filtering')
//                    ->color('theme-green')
                ,
            ], position: ActionsPosition::BeforeCells);

    }

    private function getActionDelete()
    {
        return DeleteAction::make('delete')->requiresConfirmation();
    }
    public function render()
    {
        return view('livewire.components.table.problem-table');
    }
}
