<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\VisitMaterialRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitMaterialRequestController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = VisitMaterialRequest::with(['structure', 'system']);

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->visit_id);
        }

        return response()->json($query->get());
    }

    public function store(Request $request, Visit $visit): JsonResponse
    {
        $validated = $request->validate([
            'structure_id' => 'nullable|exists:structures,id',
            'system_id' => 'nullable|exists:systems_catalog,id',
            'item_code' => 'nullable|string|max:100',
            'description' => 'required|string',
            'unit' => 'required|string|max:50',
            'requested_quantity' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $validated['visit_id'] = $visit->id;

        return response()->json(VisitMaterialRequest::create($validated)->load(['structure', 'system']), 201);
    }

    public function update(Request $request, VisitMaterialRequest $visitMaterialRequest): JsonResponse
    {
        $validated = $request->validate([
            'structure_id' => 'nullable|exists:structures,id',
            'system_id' => 'nullable|exists:systems_catalog,id',
            'item_code' => 'nullable|string|max:100',
            'description' => 'sometimes|string',
            'unit' => 'sometimes|string|max:50',
            'requested_quantity' => 'sometimes|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $visitMaterialRequest->update($validated);

        return response()->json($visitMaterialRequest->load(['structure', 'system']));
    }

    public function destroy(VisitMaterialRequest $visitMaterialRequest): JsonResponse
    {
        $visitMaterialRequest->delete();

        return response()->json(null, 204);
    }
}
