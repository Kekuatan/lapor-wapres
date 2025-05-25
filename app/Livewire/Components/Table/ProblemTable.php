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
use Livewire\Component;
use Mockery\Exception;

class ProblemTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    private ProblemTableActionService $problemTableActionService;
    private PermissionService $permissionService;

    public function __construct()
    {
        $this->problemTableActionService = new ProblemTableActionService();
        $this->permissionService = new PermissionService();
    }

    public function table(Table $table): ?Table
    {
        return $table
            ->query($this->problemTableActionService->getTableQuery())
            ->columns([
                TextColumn::make('createdBy.name')->label(__('app.name'))->searchable(),
                TextColumn::make('problem')->label(__('app.problem'))->searchable(),
                TextColumn::make('note')->label(__('app.note'))->searchable(),
                TextColumn::make('status')->label(__('app.status'))
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
                        $this->getActionAnswer(),
                    ]
                ),
            ], position: ActionsPosition::BeforeCells);

    }
    private function getActionFormForCreateAndUpdate($actionBuilder, $type = 'create')
    {
        if ($type == 'answer') {
            return $actionBuilder->form([
                Textarea::make('problem')->label(__('app.problem'))->readOnly(),
                Select::make('status')->label( __('app.status'))->required()
                    ->live()
                    ->options(ProblemEnum::getStatusArrays()),
                Textarea::make('note')->label(__('app.note'))
                    ->required(function ($get) {
                        return ($get('status') ?? false) == ProblemEnum::DONE || ($get('status') ?? false) == ProblemEnum::REJECT;
                    }),
            ]);
        }
        return $actionBuilder->form([
            Textarea::make('problem')->label(__('app.problem'))->required(),
        ]);
    }



    private function getActionCreate()
    {

        $actionBuilder = CreateAction::make()
            ->hidden( function (array $data, Action $action): bool {
                $isPermitted = $this->permissionService->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_PROBLEM, crudKey: RoleAndPermissionEnum::CREATE);
                return !$isPermitted;
            })
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

    private function getActionEdit()
    {
        $actionBuilder = EditAction::make()
            ->hidden( function (array $data, Action $action): bool {
                $isPermitted = $this->permissionService->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_PROBLEM, crudKey: RoleAndPermissionEnum::UPDATE);
                return !$isPermitted;
            })
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
            ->disabled(function (array $data, Action $action): bool {
                 $default = $action->getRecord()->toArray();
                return $default['status'] != ProblemEnum::SEND;
            })
            ->successNotification(null)
            ->slideOver();
        return $this->getActionFormForCreateAndUpdate($actionBuilder, 'edit');
    }


    private function getActionDelete()
    {
        return DeleteAction::make('delete')
            ->hidden( function (array $data, Action $action): bool {
                $isPermitted = $this->permissionService->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_PROBLEM, crudKey: RoleAndPermissionEnum::DELETE);
                return !$isPermitted;
            })
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


    private function getActionAnswer()
    {
        $actionBuilder = Action::make('answer')
            ->label(__('app.answer'))
            ->hidden( function (): bool {
                $isPermitted = $this->permissionService->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_PROBLEM, crudKey: RoleAndPermissionEnum::ANSWERED);
                return !$isPermitted;
            })
            ->fillForm(function (array $data, Action $action): array {
                $default = $action->getRecord()->toArray();
                return $default;
            })
            ->action(function (array $data, Action $action): Model {
                try {
                    $default = $action->getRecord()->toArray();
                    $id = $default['id'];
                    $response = $this->problemTableActionService->update($id, $data);
                } catch (Exception $exception) {
                    toastr()->error($exception->getMessage());
                    $action->halt();
                }
                toastr()->success('Edit success');
                return $response['data'];
            })
            ->successNotification(null)
            ->slideOver();
        return $this->getActionFormForCreateAndUpdate($actionBuilder, 'answer');
    }

    public function render()
    {
        return view('livewire.components.table.problem-table');
    }
}
