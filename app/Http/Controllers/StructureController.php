<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Structure::with(['parent', 'children'])
            ->when($request->farm_id, fn($q) => $q->where('farm_id', $request->farm_id))
            ->when($request->structure_type, fn($q) => $q->where('structure_type', $request->structure_type))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->parent_only, fn($q) => $q->whereNull('parent_structure_id'))
            ->orderBy('sort_order')
            ->orderBy('name');

        return response()->json($query->get());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'parent_structure_id' => 'nullable|exists:structures,id',
            'structure_type' => 'required|string|max:100',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'status' => 'nullable|in:active,inactive,under_construction,retired',
            'description' => 'nullable|string',
            'dimensions_json' => 'nullable|array',
            'technical_attributes_json' => 'nullable|array',
            'observations' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $structure = Structure::create($validated);

        return response()->json($structure->load(['parent', 'children']), 201);
    }

    public function show(Structure $structure): JsonResponse
    {
        return response()->json($structure->load(['farm', 'parent', 'children']));
    }

    public function update(Request $request, Structure $structure): JsonResponse
    {
        $validated = $request->validate([
            'farm_id' => 'sometimes|exists:farms,id',
            'parent_structure_id' => 'nullable|exists:structures,id',
            'structure_type' => 'sometimes|string|max:100',
            'name' => 'sometimes|string|max:255',
            'code' => 'nullable|string|max:100',
            'status' => 'nullable|in:active,inactive,under_construction,retired',
            'description' => 'nullable|string',
            'dimensions_json' => 'nullable|array',
            'technical_attributes_json' => 'nullable|array',
            'observations' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $structure->update($validated);

        return response()->json($structure->load(['parent', 'children']));
    }

    public function destroy(Structure $structure): JsonResponse
    {
        $structure->delete();

        return response()->json(null, 204);
    }
}
