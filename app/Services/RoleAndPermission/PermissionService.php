<?php

namespace App\Services\RoleAndPermission;


use Illuminate\Support\Facades\Auth;

class PermissionService
{
    public function isHasPermission($permission,  $crudKey){
        return !blank(Auth::user()->getPermissionsViaRoles()
            ->where('name', $crudKey . $permission));
    }
}
