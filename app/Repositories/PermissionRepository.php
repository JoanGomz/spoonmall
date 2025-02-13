<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\Permissions\RoleHasPermissions;
use App\Http\Exceptions\NotFoundException\NotSaveException;
use App\Repositories\Contracts\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAllActive()
    {
        return Permission::where('status', '=', '1')->orderByDesc('id')->get();
    }

    public function createPermission(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|unique:permissions,name'
            ], [
                'name.required' => 'El campo nombre es obligatorio.',
                'name.unique' => 'El permiso enviado ya existe.'
            ]);

            Permission::create(['name' => $request->name]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new NotSaveException('El permiso no pudo ser creado correctamente. -> ' . $e->getMessage());
        }
    }

    public function deletePermission($permissionId)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::where('status', 1)->findOrFail($permissionId);
            $updated = $permission->update(['status' => 0]);
            if (!$updated) {
                throw new NotSaveException('El permiso no pudo ser actualizado.');
            }

            $roleHasPermission = RoleHasPermissions::where('permission_id', $permission->id)->get();
            if ($roleHasPermission->count()) {
                foreach ($roleHasPermission as $rolePermission) {
                    $rolePermission->update(['status' => 0]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new NotSaveException('El permiso no pudo ser eliminado correctamente. -> ' . $e->getMessage());
        }
    }

    public function updatePermission($permissionId, Request $request)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::where('status', 1)->findOrFail($permissionId);
            $updated = $permission->update(['name' => $request->name]);

            if (!$updated) {
                throw new NotSaveException('El permiso no pudo ser actualizado.');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new NotSaveException('El permiso no pudo ser actualizado correctamente. -> ' . $e->getMessage());
        }
    }
}
