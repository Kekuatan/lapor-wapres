<?php

namespace App\Services\UserService;

use App\Interfaces\TableActionInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UserTableActionService implements TableActionInterface
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }


    public function get()
    {
        return $this->userService->get();
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $user = $this->userService->store($data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $user, 'message' => 'Create success'];
    }

    public function update(string $id, array $data)
    {
        try {
            DB::beginTransaction();
            $user = $this->userService->update($id, $data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $user, 'message' => 'Update success'];
    }

    public function find($id)
    {
        try {
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
            DB::beginTransaction();
            $user = $this->userService->find($id);
            $this->userService->delete($id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $user, 'message' => 'Delete success'];
    }
}
