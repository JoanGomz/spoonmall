<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all();
    public function find($id);
    public function findOrFail($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function paginate($perPage);
    public function where($column, $value);
    public function with($relations);
    public function findWhere(array $criteria);
}