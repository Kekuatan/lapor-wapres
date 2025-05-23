<?php

namespace App\Services\ProblemService;

use App\Interfaces\TableActionInterface;
use App\Services\UserService\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ProblemTableActionService implements TableActionInterface
{

    private ProblemService $problemService;

    public function __construct()
    {
        $this->problemService = new ProblemService();
    }


    public function get()
    {
        return $this->problemService->get();
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $problem = $this->problemService->store($data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $problem, 'message' => 'Create success'];
    }

    public function update(string $id, array $data)
    {
        try {
            DB::beginTransaction();
            $problem = $this->problemService->update($id, $data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $problem, 'message' => 'Update success'];
    }

    public function find($id)
    {
        try {
            $problem = $this->problemService->find($id);
        } catch (Exception $exception) {
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
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
            DB::beginTransaction();
            $problem = $this->problemService->find($id);
            $this->problemService->delete($id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception( $exception->getMessage() . ' ' . $exception->getLine());
        }
        return ['data' => $problem, 'message' => 'Delete success'];
    }
}
