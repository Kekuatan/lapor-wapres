<?php

namespace App\Livewire\Components\Layout;

//use App\Enums\Livewires\SideNavEnum;
use App\Enums\RoleAndPermissionEnum;
use App\Services\RoleANdPermission\PermissionService;
use Filament\Forms\Get;
use Livewire\Component;

class SideNav extends Component
{

    public $selected = 'home';
    public $selectedSubMenu;

    public $menus = [];

    public function mount()
    {
        $this->menus = [
            [
                'label' => __('app.home'),
                'id' => 'home',
                'icon' => 'fas fa-tachometer-alt', // Dashboard icon
                'url' => route('dashboard'),
                'is_has_permission' => true,
            ],
            [
                'label' => __( 'app.user'),
                'id' => 'user',
                'icon' => 'fas fa-tachometer-alt', // Dashboard icon
                'url' => route('user'),
                'is_has_permission' =>  (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: RoleAndPermissionEnum::READ),
            ],

            [
                'label' => __('app.role-and-permission'),
                'id' => 'role-and-permission',
                'icon' => 'fas fa-user-shield', // User shield icon
                'url' => route('role-and-permission'),
                'is_has_permission' => (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_ROLE_AND_PERMISSION, crudKey: RoleAndPermissionEnum::READ),
            ],

            [
                'label' => __('app.problem'),
                'id' => 'problem',
                'icon' => 'fas fa-tachometer-alt', // Dashboard icon
                'url' => route('problem'),
                'is_has_permission' =>  (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_PROBLEM, crudKey: RoleAndPermissionEnum::READ),
            ],
        ];


        $this->menus = collect($this->menus)
            ->map(function ($data) {
                if ($data['sub_menus'] ?? false) {
                    $data['sub_menus'] = collect($data['sub_menus'])->where('is_has_permission', true)->toArray();
                    $data['is_has_permission'] = !blank($data['sub_menus']);
                }

                return $data;
            })->where('is_has_permission', true);

        $this->setListActive();
    }

    private function setListActive()
    {
//        $id = last(request()->segments());
        $segments = request()->segments();
        $selectedMenu = null;
        $this->selectedSubMenu = null;
        foreach ($this->menus as $menu) {
            $contain = collect($segments)->contains($menu['id']);
            if ($contain) {
                $selectedMenu = $menu;
                $this->selected = $contain ? $menu['id'] : null;

                foreach ($menu['sub_menus'] ?? [] as $subMenu) {
                    $contain = collect($segments)->contains($subMenu['id']);
                    if ($contain) {
                        $this->selectedSubMenu = $contain ? $subMenu['id'] : null;
                    }
                }
            }
        }
        if (!blank($selectedMenu)) {
            if (!blank($selectedMenu['sub_menus'] ?? []) && blank($this->selectedSubMenu)) {
                $this->selected = null;
            }
        }
    }

    public function setSelected($id)
    {
        if (!blank($id)) {
            $menu = collect($this->menus)->where('id', $id)->first();
            if ($menu['sub_menus'] ?? false) {
                $this->selected = $this->selected == $id ? null : $id;
            } else {
                $this->selected = $id;
                $this->selectedSubMenu = null;
            }
        }

    }

    public function setSelectedSubMenu($parentId, $id)
    {
        $this->selected = $parentId;
        $this->selectedSubMenu = $id;
    }

    public function render()
    {
        return view('livewire.components.layout.side-nav');
    }
}
