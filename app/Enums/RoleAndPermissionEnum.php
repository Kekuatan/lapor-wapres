<?php

namespace App\Enums;

class RoleAndPermissionEnum
{
    const ROLE_SUPERADMIN = 'SUPER_ADMIN';
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';

    // User
    const PERMISSION_MANAGE_USER = 'USER';
    const PERMISSION_MANAGE_ROLE_AND_PERMISSION = 'ROLE_AND_PERMISSION';
    const PERMISSION_MANAGE_PROBLEM = 'PROBLEM';



    const READ = 'read ';
    const CREATE = 'create ';
    const UPDATE = 'update ';
    const DELETE = 'delete ';
    const ANSWERED = 'answered ';


    public static function getCrudKeyValues(): array
    {
        return [
            static::READ,
            static::CREATE,
            static::UPDATE,
            static::DELETE,
        ];
    }

    public static function getRoles(): array
    {
        return [
            static::ROLE_ADMIN,
            static::ROLE_SUPERADMIN,
            static::ROLE_USER,
        ];
    }

    public static function getPermissions($role = null): array
    {
        $permissions = [
            static::PERMISSION_MANAGE_ROLE_AND_PERMISSION => [static::CREATE, static::DELETE, static::UPDATE, static::READ, static::ANSWERED],
            static::PERMISSION_MANAGE_USER => self::getCrudKeyValues(),
            static::PERMISSION_MANAGE_PROBLEM => self::getCrudKeyValues(),
        ];

        switch ($role) {
            case static::ROLE_ADMIN:
                $permissions = collect($permissions)->except([
                    static::PERMISSION_MANAGE_ROLE_AND_PERMISSION
                ])->map(function ($permission) {
                    if ($permission == static::PERMISSION_MANAGE_ROLE_AND_PERMISSION) {
                        return collect($permission)->except([static::UPDATE, static::DELETE, static::CREATE])->toArray();
                    }
                    return $permission;
                })
                    ->toArray();
                break;
            case static::ROLE_USER:
                $permissions = collect($permissions)->except([
                    static::PERMISSION_MANAGE_USER,
                    static::PERMISSION_MANAGE_ROLE_AND_PERMISSION,
                ])->map(function ($permission) {
                    return $permission;
                })->toArray();
                break;
        }
        return $permissions;
    }
}
