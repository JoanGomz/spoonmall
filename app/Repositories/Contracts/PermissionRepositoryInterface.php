<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface PermissionRepositoryInterface
{
    public function getAllActive();
    public function createPermission(Request $request);
    public function deletePermission($permissionId);
    public function updatePermission($permissionId, Request $request);
}
