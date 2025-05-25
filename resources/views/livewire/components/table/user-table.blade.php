@php
    $isPermitted = true;
        if (!(new \App\Services\RoleAndPermission\PermissionService())->isHasPermission(permission: \App\Enums\RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: \App\Enums\RoleAndPermissionEnum::READ)) {
           $isPermitted = false;
        }
@endphp

<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 antialiased">

    <div
        class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-12">
        {{ $this->table }}
    </div>
</div>
