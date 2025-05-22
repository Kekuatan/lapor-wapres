<?php

namespace App\Livewire\Pages;

use App\Enums\RoleAndPermissionEnum;
use App\Services\RoleAndPermission\PermissionService;
use Livewire\Component;

class UserManagement extends Component
{
    public function mount(): void
    {
        if (!(new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: RoleAndPermissionEnum::READ)) {
            $this->redirect('/');
        }
    }
    public function render()
    {
        return view('livewire.pages.user-management');
    }
}
