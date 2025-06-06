<?php

namespace App\Services\ProblemService;

use App\Enums\ProblemEnum;
use App\Interfaces\TableActionInterface;
use App\Models\Problem;
use App\Models\User;
use Exception;
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
        if (($data['status']??null) != ProblemEnum::SEND ) {
            $data['answered_by'] = Auth::user()->id;
        }
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
        $problem = $this->find($id);
        Problem::where('id', $id)->delete();
        return $problem;
    }

    public function getTableQuery()
    {
        return Problem::query()->with(['createdBy', 'answeredBy']);
    }
}
