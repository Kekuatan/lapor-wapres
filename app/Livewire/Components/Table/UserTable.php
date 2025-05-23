<?php

namespace App\Livewire\Components\Table;

//use App\Enums\AttachmentEnum;
//use App\Enums\DiskEnum;
use App\Enums\RoleAndPermissionEnum;

//use App\Models\ApprovalList;
//use App\Models\Department;
use App\Models\Role;
use App\Models\User;

//use App\Models\UserHasApprovalList;
//use App\Services\Attachments\AttachmentService;
use App\Services\RoleAndPermission\PermissionService;
use App\Services\UserService\UserService;
use App\Services\UserService\UserTableActionService;
use Filament\Forms\Components\Select;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Mockery\Exception;

class UserTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    private UserTableActionService $userTableActionService;

    public function __construct()
    {
        $this->userTableActionService = new UserTableActionService();
        if (!(new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: RoleAndPermissionEnum::READ)) {
            $this->redirect('/');
        }
    }

    public function table(Table $table): ?Table
    {
        return $table
            ->query($this->userTableActionService->getTableQuery())
            ->columns([
                TextColumn::make('name')->label('name')->searchable(),
                TextColumn::make('email')->label('email')->searchable(),
                TextColumn::make('roles')
                    ->label('roles')
                    ->badge()
                    ->separator(',')
                    ->getStateUsing(function ($record) {
                        if (!blank($record->roles)) {
                            return (collect($record->roles)
                                ->pluck('name')
                                ->join(',')
                            );
                        }
                        return '';
                    }),
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


    private function getActionFormForCreateAndUpdate($actionBuilder, $type = 'create')
    {
        return $actionBuilder->form([
            TextInput::make('name')->required(),
            Select::make('roles')
                ->label('roles')
                ->dehydrated(function () {
                    return ['admin'];
                })
                ->multiple()
                ->options(function () {
                    return Role::all()->pluck('name', 'name');
                })->searchable(),

            TextInput::make('email')->email()->required(),
            TextInput::make('password')->password()->required(function () use ($type) {
                return $type == 'create' ? true : false;
            }),
        ]);
    }

    private function getActionCreate()
    {
        $actionBuilder = CreateAction::make()
            ->using(function (array $data, Action $action): Model {
                try {
                    $response = $this->userTableActionService->store($data);
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
            ->fillForm(function (array $data, Action $action): array {
                $default = $action->getRecord()->toArray();
                if (!blank($default['roles'])) {
                    $default['roles'] = collect($default['roles'])->pluck('name')->toArray();
                }
                return $default;
            })
            ->using(function (array $data, Action $action): Model {
                try {
                    $default = $action->getRecord()->toArray();
                    $id = $default['id'];
                    $response = $this->userTableActionService->update($id, $data);
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

    private function getActionDelete(): DeleteAction
    {
        return DeleteAction::make('delete')
            ->using(function (array $data, Action $action): Model {
                try {
                    $default = $action->getRecord()->toArray();
                    $id = $default['id'];
                    $response = $this->userTableActionService->delete($id);
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
        return view('livewire.components.table.user-table');
    }
}
