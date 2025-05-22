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
                'label' => 'Dashboard',
                'id' => 'home',
                'icon' => 'fas fa-tachometer-alt', // Dashboard icon
                'url' => route('dashboard'),
                'is_has_permission' => true,
            ],
            [
                'label' => 'User',
                'id' => 'user',
                'icon' => 'fas fa-tachometer-alt', // Dashboard icon
                'url' => route('user'),
                'is_has_permission' =>  (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: RoleAndPermissionEnum::READ),
            ],

            [
                'label' => 'Permission',
                'id' => 'role-and-permission',
                'icon' => 'fas fa-user-shield', // User shield icon
                'url' => route('role-and-permission'),
                'is_has_permission' => (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_ROLE_AND_PERMISSION, crudKey: RoleAndPermissionEnum::READ),
            ],

            [
                'label' => 'Laporkan',
                'id' => 'problem',
                'icon' => 'fas fa-tachometer-alt', // Dashboard icon
                'url' => route('problem'),
                'is_has_permission' =>  (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_PROBLEM, crudKey: RoleAndPermissionEnum::READ),
            ],
//            [
//                'label' => 'Budget Management',
//                'id' => 'budget-management',
//                'icon' => 'fas fa-wallet', // Wallet icon
//                'url' => '',
//                'is_has_permission' => true,
//                'sub_menus' => [
//                    [
//                        'label' => 'Project',
//                        'id' => 'project',
//                        'icon' => 'fas fa-project-diagram', // Project diagram icon
//                        'url' => route('budget-management.project'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Budget',
//                        'id' => 'project-list',
//                        'icon' => 'fas fa-list', // List icon
//                        'url' => route('budget-management.project-list'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Contract',
//                        'id' => 'contract',
//                        'icon' => 'fas fa-file-contract', // Contract icon
//                        'url' => route('budget-management.contract'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Purchase Order',
//                        'id' => 'purchase-order',
//                        'icon' => 'fas fa-shopping-cart', // Shopping cart icon
//                        'url' => route('budget-management.purchase-order'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Payment Request',
//                        'id' => 'budget-request',
//                        'icon' => 'fas fa-credit-card', // Credit card icon
//                        'url' => route('budget-management.budget-request'),
//                        'is_has_permission' => true,
//                    ],
//                ]
//            ],
//            [
//                'label' => 'User Management',
//                'id' => 'user-management',
//                'icon' => 'fas fa-users', // Users icon
//                'url' => '',
//                'is_has_permission' => true,
//                'sub_menus' => [
////                    [
////                        'label' => 'User',
////                        'id' => 'user',
////                        'icon' => 'fas fa-user', // User icon
////                        'url' => route('user-management.user'),
////                        'is_has_permission' => (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: RoleAndPermissionEnum::READ),
////                    ],
//                    [
//                        'label' => 'Permission',
//                        'id' => 'role',
//                        'icon' => 'fas fa-user-shield', // User shield icon
//                        'url' => route('role-and-permission'),
//                        'is_has_permission' => (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_ROLE_AND_PERMISSION, crudKey: RoleAndPermissionEnum::READ),
//                    ]
//                ]
//            ],
//            [
//                'label' => 'Reports',
//                'id' => 'report',
//                'icon' => 'fas fa-chart-line', // Chart line icon
//                'url' => '',
//                'is_has_permission' => function () {
//                    $project =  (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_REPORT_PROJECT, crudKey: RoleAndPermissionEnum::READ);
//                    $contact =  (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_REPORT_VENDOR, crudKey: RoleAndPermissionEnum::READ);
//                    $budgetRequest = (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_REPORT_BUDGET_REQUEST, crudKey: RoleAndPermissionEnum::READ);
//                    return $project || $contact || $budgetRequest;
//                },
//                'sub_menus' => [
//                    [
//                        'label' => 'Project report',
//                        'id' => 'project-report',
//                        'icon' => 'fas fa-project-diagram', // Project diagram icon
//                        'url' => route('report.project'),
//                        'is_has_permission' => (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_REPORT_PROJECT, crudKey: RoleAndPermissionEnum::READ),
//                    ],
//                    [
//                        'label' => 'Vendor report',
//                        'id' => 'contact-report',
//                        'icon' => 'fas fa-handshake', // Handshake icon
//                        'url' => route('report.contact'),
//                        'is_has_permission' => (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_REPORT_VENDOR, crudKey: RoleAndPermissionEnum::READ),
//                    ],
//                    [
//                        'label' => 'Budget request report',
//                        'id' => 'budget-request-report',
//                        'icon' => 'fas fa-file-alt', // File alt icon
//                        'url' => route('report.budget-request-report'),
//                        'is_has_permission' => (new PermissionService())->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_REPORT_BUDGET_REQUEST, crudKey: RoleAndPermissionEnum::READ),
//                    ],
//                ]
//            ],
//            [
//                'label' => 'Settings',
//                'id' => 'setting',
//                'icon' => 'fas fa-cogs', // Cogs icon
//                'url' => '',
//                'is_has_permission' => true,
//                'sub_menus' => [
//                    [
//                        'label' => 'Company',
//                        'id' => 'company',
//                        'icon' => 'fas fa-building', // Building icon
//                        'url' => route('setting.company'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Division',
//                        'id' => 'division',
//                        'icon' => 'fas fa-sitemap', // Sitemap icon
//                        'url' => route('setting.division'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Location',
//                        'id' => 'location',
//                        'icon' => 'fas fa-map-marker-alt', // Map marker icon
//                        'url' => route('setting.location'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Vendor',
//                        'id' => 'contact',
//                        'icon' => 'fas fa-truck', // Truck icon
//                        'url' => route('setting.contact'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Bank',
//                        'id' => 'bank',
//                        'icon' => 'fas fa-university', // University (bank) icon
//                        'url' => route('setting.bank'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Product group',
//                        'id' => 'product-group',
//                        'icon' => 'fas fa-boxes', // Boxes icon
//                        'url' => route('setting.product-group'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Unit',
//                        'id' => 'unit',
//                        'icon' => 'fas fa-ruler', // Ruler icon
//                        'url' => route('setting.unit'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Approval',
//                        'id' => 'approval-list',
//                        'icon' => 'fas fa-check-circle', // Check circle icon
//                        'url' => route('setting.approval-list'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Payment group',
//                        'id' => 'payment-group',
//                        'icon' => 'fas fa-dollar-sign', // Dollar sign icon
//                        'url' => route('setting.payment-group'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Income Tax',
//                        'id' => 'tax-rate',
//                        'icon' => 'fas fa-percent', // Percent icon
//                        'url' => route('setting.tax-rate'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Attachment',
//                        'id' => 'document',
//                        'icon' => 'fas fa-paperclip', // Paperclip icon
//                        'url' => route('setting.document'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Source Code',
//                        'id' => 'department',
//                        'icon' => 'fas fa-code', // Code icon
//                        'url' => route('setting.department'),
//                        'is_has_permission' => true,
//                    ],
//                    [
//                        'label' => 'Contract Retention',
//                        'id' => 'retention',
//                        'icon' => 'fas fa-calendar-alt', // Calendar alt icon
//                        'url' => route('setting.retention'),
//                        'is_has_permission' => true,
//                    ],
//                ]
//            ],
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
