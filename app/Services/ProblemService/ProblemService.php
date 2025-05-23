<?php

namespace App\Services\ProblemService;

use App\Interfaces\TableActionInterface;
use App\Models\Problem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProblemService implements TableActionInterface
{
    public function get()
    {
        return Problem::where('id', '!=', Auth::user()->id)->get();
    }

    public function store(array $data)
    {
        $data['created_by'] = Auth::user()->id;
        $problem = Problem::create($data);
        return $problem;
    }

    public function update(string $id, array $data)
    {
        Problem::where('id', $id)->update($data);
        $problem = $this->find($id);

        return $problem;
    }

    public function find($id)
    {
        return Problem::where('id', $id)->first();
    }

    public function delete($id)
    {
        return Problem::where('id', $id)->delete();
    }

    public function getTableQuery()
    {
        return Problem::query()->with(['createdBy', 'answeredBy']);
    }
}
