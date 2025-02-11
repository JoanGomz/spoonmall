<?php

namespace App\Http\Controllers\Admin\Permissions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Permission;
use App\Models\Permissions\RoleHasPermissions;

use App\Http\Controllers\Controller;

use App\Http\Exceptions\NotFoundException\NotSaveException;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all()->where('status', '=', '1')->sortByDesc('id');
        return view('admin.permissions.index', compact('permissions'));
    }

    public function store(Request $request)
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

            return redirect()->back()->with('success', 'Permiso creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'El permiso no pudo ser creado correctamente. -> ' . $e->getMessage());
        }
    }

    public function destroy($permission)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::where('status', 1)->findOrFail($permission);
            $updated = $permission->update(['status' => 0]);
            if (!$updated) {
                throw new NotSaveException('El permiso no pudo ser actualizado.');
            }

            $roleHasPermission = RoleHasPermissions::where('permission_id', $permission->id)->get();
            if (count($roleHasPermission)) {
                $roleHasPermission->update(['status' => 0]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Permiso eliminado.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'El permiso no pudo ser eliminado correctamente. -> ' . $e->getMessage());
        }
    }

    public function update($permission, Request $request)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::where('status', 1)->findOrFail($permission);
            $permissionSave = $permission->update(['name' => $request->name]);

            if (!$permissionSave) {
                throw new NotSaveException('El permiso no pudo ser actualizado.');
            }

            DB::commit();
            return redirect()->back()->with('success', 'Permiso actualizado.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'El permiso no pudo ser actualizado correctamente. -> ' . $e->getMessage());
        }
    }
}
