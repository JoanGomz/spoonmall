<?php

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->getAllActive();
        return view('admin.permissions.index', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $this->roleRepository->createRole($request);
            return redirect()->back()->with('success', 'Rol creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($roleId)
    {
        try {
            $this->roleRepository->deleteRole($roleId);
            return redirect()->back()->with('success', 'Rol eliminado.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update($roleId, Request $request)
    {
        try {
            $this->roleRepository->updateRole($roleId, $request);
            return redirect()->back()->with('success', 'Rol actualizado.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
