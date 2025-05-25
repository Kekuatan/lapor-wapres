<?php

namespace App\Services\UserService;

use App\Enums\RoleAndPermissionEnum;
use App\Interfaces\TableActionInterface;
use App\Services\RoleAndPermission\PermissionService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Nette\Schema\ValidationException;


class UserTableActionService implements TableActionInterface
{
    private UserService $userService;
    private $validationMessage;
    private PermissionService $permissionService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->permissionService = new PermissionService();
        $this->validationMessage = __('app.validation' );
    }


    public function get()
    {
        return $this->userService->get();
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $isPermitted = $this->permissionService->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: RoleAndPermissionEnum::CREATE);
            if (!$isPermitted){
                throw new Exception(__('app.response.error.permission_denied'));
            }

            $data = Validator::make($data, [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'roles' => 'array|required'
            ], $this->validationMessage
            )->validate();

            $user = $this->userService->store($data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $user, 'message' => __( 'app.response.success.store')];
    }

    public function update(string $id, array $data)
    {
        try {
            $isPermitted = $this->permissionService->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: RoleAndPermissionEnum::UPDATE);
            if (!$isPermitted){
                throw new Exception(__('app.response.error.permission_denied'));
            }
            $data = Validator::make($data, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'string|nullable',
                'roles' => 'array|required',
                $this->validationMessage
            ])->validate();
            DB::beginTransaction();
            $user = $this->userService->update($id, $data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $user, 'message' => __( 'app.response.success.update')];
    }

    public function find($id)
    {

        try {
            Validator::make(['id' => $id], [
                'id' => 'required|numeric',
            ], $this->validationMessage)->validate();
            $user = $this->userService->find($id);
        } catch (Exception $exception) {
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
        }
        return $user;

    }

    public function getTableQuery()
    {
        return $this->userService->getTableQuery();
    }

    public function delete($id)
    {
        try {
            $isPermitted = $this->permissionService->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_USER, crudKey: RoleAndPermissionEnum::DELETE);
            Validator::make(['id' => $id], [
                'id' => 'required|numeric',
            ], $this->validationMessage)->validate();
            if (!$isPermitted){
                throw new Exception(__('app.response.error.permission_denied'));
            }
            DB::beginTransaction();
            $user = $this->userService->find($id);
            $this->userService->delete($id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $user, 'message' => __( 'app.response.success.delete')];
    }
}
