<?php

namespace App\Services\UserService;

use App\Interfaces\TableActionInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements TableActionInterface
{
    public function get()
    {
        return User::where('id', '!=', Auth::user()->id)->get();
    }

    public function store(array $data)
    {
        $user = User::create($data);
        $user->syncRoles($data['roles']);
        return $user;
    }

    public function update(string $id, array $data)
    {
        $updateData = collect($data)
            ->except(['roles'])
            ->toArray();

        if (!blank($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        } else {
            $updateData = collect($updateData)->except('password')->toArray();
        }
        User::where('id', $id)->update($updateData);
        $user = $this->find($id);
        $user->syncRoles($data['roles']);

        return $user;
    }

    public function find($id)
    {
        return User::where('id', $id)->first();
    }

    public function delete($id)
    {
        return User::where('id', $id)->delete();
    }

    public function getTableQuery()
    {
        return User::query()->whereNot('is_admin', 1)->with(['roles']);
    }
}
