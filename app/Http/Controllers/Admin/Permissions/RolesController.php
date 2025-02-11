<?php

namespace App\Http\Controllers\Admin\Permissions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Permissions\RoleHasPermissions;

use App\Http\Controllers\Controller;

use App\Http\Exceptions\NotFoundException\NotSaveException;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $role = Role::all()->where('status', '=', '1')->sortByDesc('id');
        return view('admin.permissions.index', compact('role'));
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

            Role::create(['name' => $request->name]);
            DB::commit();

            return redirect()->back()->with('success', 'Permiso creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'El permiso no pudo ser creado correctamente. -> ' . $e->getMessage());
        }
    }

    public function destroy($roleId)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('status', 1)->findOrFail($roleId);
            $updated = $role->update(['status' => 0]);
            if (!$updated) {
                throw new NotSaveException('El permiso no pudo ser actualizado.');
            }

            $roleHasPermission = RoleHasPermissions::where('role_id', $role->id)->get();
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

    public function update($role, Request $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('status', 1)->findOrFail($role);
            $roleSave = $role->update(['name' => $request->name]);

            if (!$roleSave) {
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
