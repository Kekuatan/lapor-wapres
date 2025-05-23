<?php

namespace App\Interfaces;

interface TableActionInterface
{
    public function get();
    public function store(array $data);
    public function update(string $id, array $data);
    public function find($id);
    public function delete($id);
    public function getTableQuery();
}
