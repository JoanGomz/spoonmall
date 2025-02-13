<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\Permissions\RoleHasPermissions;
use App\Http\Exceptions\NotFoundException\NotSaveException;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllActive()
    {
        return Role::where('status', '=', '1')->orderByDesc('id')->get();
    }

    public function createRole(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|unique:roles,name'
            ], [
                'name.required' => 'El campo nombre es obligatorio.',
                'name.unique' => 'El rol enviado ya existe.'
            ]);

            Role::create(['name' => $request->name]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new NotSaveException('El rol no pudo ser creado correctamente. -> ' . $e->getMessage());
        }
    }

    public function deleteRole($roleId)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('status', 1)->findOrFail($roleId);
            $updated = $role->update(['status' => 0]);
            if (!$updated) {
                throw new NotSaveException('El rol no pudo ser actualizado.');
            }

            $roleHasPermissions = RoleHasPermissions::where('role_id', $role->id)->get();
            if ($roleHasPermissions->count()) {
                foreach ($roleHasPermissions as $rolePermission) {
                    $rolePermission->update(['status' => 0]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new NotSaveException('El rol no pudo ser eliminado correctamente. -> ' . $e->getMessage());
        }
    }

    public function updateRole($roleId, Request $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('status', 1)->findOrFail($roleId);
            $updated = $role->update(['name' => $request->name]);

            if (!$updated) {
                throw new NotSaveException('El rol no pudo ser actualizado.');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new NotSaveException('El rol no pudo ser actualizado correctamente. -> ' . $e->getMessage());
        }
    }
}
