<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\NuevoRecursoRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NuevoRecursoController extends Controller
{
    private $repository;

    public function __construct(NuevoRecursoRepositoryInterface
    $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResponse
    {
        $recursos = $this->repository->all();
        return response()->json($recursos);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            // Tus reglas de validación 
        ]);

        $recurso = $this->repository->create($data);
        return response()->json($recurso, 201);
    }

    public function show($id): JsonResponse
    {
        $recurso = $this->repository->findOrFail($id);
        return response()->json($recurso);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->validate([
            // Tus reglas de validación 
        ]);

        $recurso = $this->repository->update($id, $data);
        return response()->json($recurso);
    }

    public function destroy($id): JsonResponse
    {
        $this->repository->delete($id);
        return response()->json(null, 204);
    }
}
