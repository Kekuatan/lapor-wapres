<?php

namespace App\Services\RoleAndPermission;


use Illuminate\Support\Facades\Auth;

class PermissionService
{
    public function get(){}
    public function store(array $data){}
    public function update(string $id, array $data){}
    public function find($id){}

    public function isHasPermission($permission,  $crudKey){
        return !blank(Auth::user()->getPermissionsViaRoles()
            ->where('name', $crudKey . $permission));
    }
}
