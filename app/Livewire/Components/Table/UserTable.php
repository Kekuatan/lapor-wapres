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
            TextInput::make('name')->required(),
//            Select::make('department_id')
//                ->label('Request code')
//                ->hint('Budget request code number')
//                ->hintIcon('heroicon-m-question-mark-circle')
//                ->options(function () {
//                    return Department::query()->pluck('code', 'id');
//                })->searchable(),
//            Select::make('approval_lists')
//                ->label('Approvals')
//                ->multiple()
//                ->options(function () {
//                    return ApprovalList::query()->pluck('name', 'id');
//                })->searchable(),
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
            TextInput::make('password')->password()->required(function() use ($type){
                return $type == 'create' ? true : false;
            }),
//            $this->attachmentService->filament()->getFormAttachment(formId:'signature',self : $this ,multiple: false, withHint: true),

        ]);
    }

    private function getActionCreate(){

        $actionBuilder = CreateAction::make()
            ->using(function (array $data, Action $action): Model {
                try {
                    DB::beginTransaction();
                    $userData = collect($data)->except([ 'signature'])->toArray();
                    $user = \App\Models\User::create($userData);
                    $id = $user->id;
//                    if (!blank($data['approval_lists'])) {
//                        $approvalLists = array_map(function($approvalList) use ($id) {
//                            return [
//                                'id' => Str::uuid()->toString(),
//                                'user_id' => $id,
//                                'approval_list_id' => $approvalList
//                            ];
//                        }, $data['approval_lists']);
//                        UserHasApprovalList::query()->insert($approvalLists);
//                    }
//                    if (!blank($data['signature'])) {
//                        $this->attachmentService->store(file: $data['signature'], path: AttachmentEnum::SIGNATURE_PATH, disk: DiskEnum::PUBLIC->value, transactional: $user, type: AttachmentEnum::SIGNATURE);
//                    }

                    $user = \App\Models\User::where('id', $id)->first();
                    $user->syncRoles($data['roles']);
                    DB::commit();
                } catch (Exception $exception) {
                    DB::rollBack();
                    toastr()->error($exception->getMessage() . ' ' . $exception->getLine());
                    $action->halt();
                }
                toastr()->success('Create success');
                return $user;

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
                $default['signature'] = $default['attachment']['path'] ?? null;
                if (!blank($default['roles'])) {
                    $default['roles'] = collect($default['roles'])->pluck('name')->toArray();
                }
//                if (!blank($default['approval_lists'])) {
//                    $default['approval_lists'] = collect($default['approval_lists'])->pluck('id')->toArray();
//                }
                return $default;
            })
            ->using(function (array $data, Action $action): Model {
                try {
                    DB::beginTransaction();
                    $default = $action->getRecord()->toArray();

                    $id = $default['id'];
                    $updateData = collect($data)
                        ->except(['roles'])
                        ->toArray();

//                    UserHasApprovalList::query()->where('user_id', $id)->delete();
//                    if (!blank($data['approval_lists'])) {
//                        $approvalLists = array_map(function($approvalList) use ($id) {
//                            return [
//                                'id' => Str::uuid()->toString(),
//                                'user_id' => $id,
//                                'approval_list_id' => $approvalList
//                            ];
//                        }, $data['approval_lists']);
//                        UserHasApprovalList::query()->insert($approvalLists);
//                    }

                    if(!blank($data['password'])){
                        $updateData['password'] = Hash::make($data['password']);
                    }else{
                        $updateData = collect($updateData)->except('password')->toArray();
                    }
                    \App\Models\User::where('id', $id)->update($updateData);
                    $user = \App\Models\User::where('id', $id)->first();
//                    if (!blank($data['signature'])) {
//                        $this->attachmentService->store(file: $data['signature'], path: AttachmentEnum::SIGNATURE_PATH, disk: DiskEnum::PUBLIC->value, transactional: $user, type: AttachmentEnum::SIGNATURE);
//                    } else{
//                        $this->attachmentService->delete(transactionalId: $default['attachment']['transactional_id'] ?? null, transactionalType: $default['attachment']['transactional_type'] ?? null);
//                    }
                    $user->syncRoles($data['roles']);
                    DB::commit();
                } catch (Exception $exception) {
                    DB::rollBack();
                    toastr()->error($exception->getMessage() . ' ' . $exception->getLine());
                    $action->halt();
                }
                toastr()->success('Edit success');
                return $user;

            })
            ->successNotification(null)
            ->slideOver();
        return $this->getActionFormForCreateAndUpdate($actionBuilder, 'edit');
    }
    public function table(Table $table): ?Table
    {
        return $table
            ->query(\App\Models\User::query()->with(['roles']))
            ->columns([
                TextColumn::make('name')->label('name')->searchable(),
                TextColumn::make('email')->label('email')->searchable(),
//                TextColumn::make('department.code')->label('Request code'),
//                TextColumn::make('approvalLists.name')->label('Approvals')
//                    ->badge()
//                    ->separator(',')->getStateUsing(function ($record) {
//                        if (!blank($record->approvalLists)) {
//                            return (collect($record->approvalLists)
//                                ->pluck('name')
//                                ->join(',')
//                            );
//                        }
//                        return '';
//                    }),
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
                )
//                    ->icon('icon-filtering')
//                    ->color('theme-green')
                ,
            ], position: ActionsPosition::BeforeCells);

    }

    public function mount()
    {
//        dd(Role::query()->get()->toArray());
//        Auth::user()->assignRole('admin');
    }

    private function getActionDelete()
    {
        return DeleteAction::make('delete')->requiresConfirmation();
    }
    public function render()
    {
        return view('livewire.components.table.user-table');
    }
}
