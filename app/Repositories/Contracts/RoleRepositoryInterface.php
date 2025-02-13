<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface RoleRepositoryInterface
{
    public function getAllActive();
    public function createRole(Request $request);
    public function deleteRole($roleId);
    public function updateRole($roleId, Request $request);
}
