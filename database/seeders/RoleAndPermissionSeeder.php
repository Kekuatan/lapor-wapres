<?php

namespace Database\Seeders;

use App\Enums\RoleAndPermissionEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public $roles = [];

    public function run(): void
    {

        $this->command->info('Seeding Role and Permission');
        $this->command->getOutput()->progressStart();
        try {
            // truncate role and permission

//            $this->truncateRoleAndPermissionTables();
            DB::beginTransaction();
            $this->createRole();
            $this->createPermission();
            $this->giveRoleToUser();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
        }
        $this->command->getOutput()->progressFinish();
    }

    private function createRole()
    {
        $roles = RoleAndPermissionEnum::getRoles();
        foreach ($roles as $role) {
            $roleSelect = Role::query()->where('name', $role)->first();
            if (blank($roleSelect)) {
                $roleSelect = Role::create([
                    'name' => $role,
                    'guard_name' => 'web',
                ]);
            }

            $this->roles[] = $roleSelect;
        }
    }

    private function createPermission()
    {
        $roles = RoleAndPermissionEnum::getRoles();
        foreach ($roles as $role) {
            $permissionWithCrudKeys = RoleAndPermissionEnum::getPermissions($role);
//            dd($permissionWithCrudKeys);
            $permissions = collect($permissionWithCrudKeys)->keys();
            foreach ($permissions as $permission) {
                $crudKeys = $permissionWithCrudKeys[$permission];
                foreach ($crudKeys as $crudKey) {
                    $name = $crudKey . $permission;
                    $permissionSelect = Permission::query()->where('name', $name)->first();
                    if (blank($permissionSelect)) {
                        $permissionSelect = Permission::create([
                            'guard_name' => 'web',
                            'name' => $name
                        ]);
                    }
                    $this->command->getOutput()->progressAdvance();
                    $this->givePermissionToRole($role, $permissionSelect);
                }
            }
        }
    }

    private function givePermissionToRole($role, $permisionSelect)
    {

        Role::query()->where('name', $role)->first()->givePermissionTo($permisionSelect);
//        foreach ($this->roles as $role) {
//            $role->givePermissionTo($permisionSelect);
//        }
    }

    private function giveRoleToUser()
    {
//        $roles = RoleAndPermissionEnum::getRoles();
//        foreach ($roles as $role) {
//            $email = Str::lower(Str::replace(' ', '_', $role)) . '@admin.com';
//            $user  = User::query()->where('email', $email)->first();
//            $user->syncRoles([$role]);
//        }
        $user = User::query()->where('email', 'superadmin@test.com')->first();
        $user->syncRoles([RoleAndPermissionEnum::ROLE_SUPERADMIN]);

        $user = User::query()->where('email', 'admin@test.com')->first();
        $user->syncRoles([RoleAndPermissionEnum::ROLE_ADMIN]);
        $user = User::query()->where('email', 'user@test.com')->first();
        $user->syncRoles([RoleAndPermissionEnum::ROLE_USER]);

//        $cashiers = User::where('email', '!=', 'admin@admin.com')->get();
//        foreach ($cashiers as $cashier){
//            $cashier->syncRoles([RoleAndPermissionEnum::ROLE_CASHIER]);
//        }
//        $user  = User::query()->where('email', 'wanna@admin.com')->first();
//        $user->syncRoles([RoleAndPermissionEnum::ROLE_REQUESTER]);
//        $user  = User::query()->where('email', 'tami@admin.com')->first();
//        $user->syncRoles([RoleAndPermissionEnum::ROLE_REQUESTER]);

    }

//    private function truncateRoleAndPermissionTables()
//    {
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        DB::table('model_has_permissions')->truncate();
//        DB::table('model_has_roles')->truncate();
//        DB::table('role_has_permissions')->truncate();
//        DB::table('permissions')->truncate();
//        DB::table('roles')->truncate();
//
//        DB::statement('ALTER TABLE `permissions` AUTO_INCREMENT = 1;');
//        DB::statement('ALTER TABLE `roles` AUTO_INCREMENT = 1;');
//
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
//        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
//    }

}
