<?php

namespace App\Livewire\Pages;

use App\Enums\RoleAndPermissionEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleAndPermission\PermissionService;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RoleAndPermissionSetting extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public $schemas = [];
    public $groupPermissions = [];

    public function mount(): void
    {
        if (!(new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_ROLE_AND_PERMISSION, crudKey: RoleAndPermissionEnum::READ)){
            $this->redirect('/');
        }
        $this->groupPermissions = $this->getGroupPermission();

        $this->form->fill();
    }

    public function form(Form $form): Form
    {

        $this->groupPermissions = $this->getGroupPermission();
        return $form
            ->schema(
                function () {
                    $sections = [
                        Select::make('role')
                            ->label('roles')
                            ->live()
                            ->options(function () {
                                return Role::query()->whereNot('name' , RoleAndPermissionEnum::ROLE_SUPERADMIN)->pluck('name', 'name');
                            })
                            ->afterStateUpdated(function ($state, Set $set) {
                                $role = Role::query()->where('name', $state)->with('permissions')->first();
                                foreach ($this->groupPermissions as $groupPermission) {
                                    $crudKeys = RoleAndPermissionEnum::getCrudKeyValues();
                                    foreach ($crudKeys as $crudKey) {
                                        $set($crudKey . $groupPermission, false);
                                    }
                                }

                                if (!blank($role)) {
                                    if (!blank($role->permissions)) {
                                        $permissions = collect($role->permissions)->pluck('name')->toArray();
                                        foreach ($permissions as $permission) {
                                            $set($permission, true);
                                        }
                                    }
                                }
                            })
                            ->columnSpanFull()
                            ->required()
                            ->searchable(),
                    ];


                    foreach ($this->groupPermissions as $groupPermission) {
                        $permissionWithCrudKeys = RoleAndPermissionEnum::getPermissions();
                        $crudKeys = $permissionWithCrudKeys[$groupPermission] ?? null;
                        $forms = [];
                        foreach ($crudKeys ?? [] as $crudKey) {
                            $forms[] = Toggle::make($crudKey . $groupPermission)
                                ->label(__('app.permission.' . $crudKey . $groupPermission))
                                ->onColor('success')
                                ->offColor('danger')
                                ->live()
                                ->disabled(function ($state) use ($groupPermission, $crudKey) {
                                    return blank($this->data['role']) ;
                                })
                                ->afterStateUpdated(function($state) use ($groupPermission, $crudKey) {
                                    $role = Role::query()->where('name', $this->data['role'] ?? null)->first();
                                    $permission = $crudKey . $groupPermission;
                                    if(!blank($role)){
                                        if($state ){
                                            $role->givePermissionTo($permission);
                                        } else{
                                            $role->revokePermissionTo($permission);
                                        }
                                    }
                                });
                        }

                        $sections[] = Section::make($groupPermission)
                            ->heading(__('app.permission.' . $groupPermission))
                            ->schema($forms)
                            ->hidden(function ($state) use ($groupPermission, $crudKey) {
                                return blank($this->data['role']) ;
                            })
                            ->live()
                            ->columnSpan(1);
                    }


                    $schemas = [
                        Section::make('Manage Permission')
                            ->headerActions([
                                Action::make('create_role')->form([
                                    TextInput::make('name')
                                        ->required()
                                ])->slideOver()
                                    ->successNotification(null)
                                    ->modalWidth(MaxWidth::SevenExtraLarge)
                                    ->action(function (array $data, Action $action){
                                        try {
                                            $isRoleExist = Role::query()->where('name', $data['name'])->exists();
                                            if ($isRoleExist) {
                                                throw new \Exception('Role exist!');
                                            }
                                            Role::create([
                                                'name' => trim($data['name']),
                                                'guard_name' => 'web',
                                            ]);
                                            toastr()->success('Success');
                                        } catch (\Exception $e) {
                                            toastr()->error($e->getMessage());
                                            $action->halt();
                                        }
                                    })
                            ])
                            ->schema($sections)
                            ->live()
                            ->columns(4)

                    ];

                    return $schemas;
                })
            ->columns(4)
            ->statePath('data');
    }

    private function getGroupPermission()
    {

        $names = Permission::query()->pluck('name');
        $formatted = $names->map(function ($name) {
            $parts = explode(' ', $name);
            return end($parts);
        })->unique();

        return $formatted;

    }
    public function render()
    {
        return view('livewire.pages.role-and-permission-setting');
    }
}
