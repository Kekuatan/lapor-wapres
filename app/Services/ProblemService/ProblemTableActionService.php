<?php

namespace App\Services\ProblemService;

use App\Enums\ProblemEnum;
use App\Enums\RoleAndPermissionEnum;
use App\Interfaces\TableActionInterface;
use App\Models\Problem;
use App\Services\RoleAndPermission\PermissionService;
use App\Services\UserService\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;

class ProblemTableActionService implements TableActionInterface
{

    private ProblemService $problemService;
    private PermissionService $permissionService;
    private $validationMessage;

    public function __construct()
    {
        $this->problemService = new ProblemService();
        $this->permissionService = new PermissionService();
        $this->validationMessage = __('app.validation');
    }


    public function get()
    {
        return $this->problemService->get();
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $isPermitted = $this->permissionService->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_PROBLEM, crudKey: RoleAndPermissionEnum::CREATE);
            if (!$isPermitted) {
                throw new Exception(__('app.response.error.permission_denied'));
            }
            $data = Validator::make($data, [
                'problem' => 'required|string',
            ], $this->validationMessage)->validate();

            $problem = $this->problemService->store($data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $problem, 'message' => __('app.response.success.store')];
    }

    public function update(string $id, array $data)
    {
        try {
            DB::beginTransaction();
            $isPermitted = $this->permissionService->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_PROBLEM, crudKey: RoleAndPermissionEnum::UPDATE);
            if (!$isPermitted) {
                throw new Exception(__('app.response.error.permission_denied'));
            }
//            dd('aaa', $data);
            $data = Validator::make($data, [
                'problem' => 'string|required',
                'note' => [
                    'string',
                    'nullable',
                    Rule::requiredIf(function () use ($data) {
                        return  ($data['status'] != ProblemEnum::SEND && $data['status'] != ProblemEnum::PROCESS);
                    }),
                ],
                'status' => 'string|required',
            ], $this->validationMessage)->validate();

            $problem = $this->problemService->update($id, $data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $problem, 'message' => __('app.response.success.update')];
    }

    public function find($id)
    {
        try {
            Validator::make(['id' => $id], [
                'id' => 'required|numeric',
            ], $this->validationMessage)->validate();

            $problem = $this->problemService->find($id);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage() . ' ' . $exception->getLine());
        }
        return $problem;

    }

    public function getTableQuery()
    {
        return $this->problemService->getTableQuery();
    }

    public function delete($id)
    {
        try {
            $isPermitted = $this->permissionService->isHasPermission(permission: RoleAndPermissionEnum::PERMISSION_MANAGE_PROBLEM, crudKey: RoleAndPermissionEnum::DELETE);
            if (!$isPermitted) {
                throw new Exception(__('app.response.error.permission_denied'));
            }
            Validator::make(['id' => $id], [
                'id' => 'required|numeric',
            ], $this->validationMessage)->validate();
            DB::beginTransaction();
            $problem = Problem::query()->where('status', ProblemEnum::SEND)->where('id', $id)->first();
            if(!$problem) {
                throw new Exception(__('app.response.error.problem_already_processed'));
            }
            $problem = $this->problemService->delete($id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $problem, 'message' => __('app.response.success.delete')];
    }
}
