<?php

namespace App\Http\Controllers;

use App\Models\VisitStructure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitStructureController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = VisitStructure::with(['structure'])
            ->when($request->visit_id, fn($q) => $q->where('visit_id', $request->visit_id));

        return response()->json($query->get());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'structure_id' => 'required|exists:structures,id',
            'role' => 'nullable|in:primary,secondary,affected,inspected,intervened',
            'notes' => 'nullable|string',
        ]);

        $item = VisitStructure::create($validated);

        return response()->json($item->load('structure'), 201);
    }

    public function update(Request $request, VisitStructure $visitStructure): JsonResponse
    {
        $validated = $request->validate([
            'role' => 'nullable|in:primary,secondary,affected,inspected,intervened',
            'notes' => 'nullable|string',
        ]);

        $visitStructure->update($validated);

        return response()->json($visitStructure->load('structure'));
    }

    public function destroy(VisitStructure $visitStructure): JsonResponse
    {
        $visitStructure->delete();

        return response()->json(null, 204);
    }
}
