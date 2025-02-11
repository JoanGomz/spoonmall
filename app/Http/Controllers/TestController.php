<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\TestRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    private $testRepository;

    public function __construct(TestRepositoryInterface $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function index(): JsonResponse
    {
        $tests = $this->testRepository->all();
        return response()->json($tests);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $test = $this->testRepository->create($data);
        return response()->json($test, 201);
    }

    public function show($id): JsonResponse
    {
        $test = $this->testRepository->findOrFail($id);
        return response()->json($test);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $test = $this->testRepository->update($id, $data);
        return response()->json($test);
    }

    public function destroy($id): JsonResponse
    {
        $this->testRepository->delete($id);
        return response()->json(null, 204);
    }
}