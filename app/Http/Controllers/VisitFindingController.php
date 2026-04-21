<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\VisitFinding;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitFindingController extends Controller
{
    public function index(Visit $visit): JsonResponse
    {
        return response()->json(
            VisitFinding::with('structure')
                ->where('visit_id', $visit->id)
                ->orderBy('sort_order')
                ->get()
        );
    }

    public function store(Request $request, Visit $visit): JsonResponse
    {
        $validated = $request->validate([
            'structure_id' => 'nullable|exists:structures,id',
            'section' => 'nullable|string|max:255',
            'category' => 'required|in:civil,metallic,electrical,mechanical,operational,commercial,quality,safety,other',
            'severity' => 'nullable|in:low,medium,high,critical',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'recommendation' => 'nullable|string',
            'is_blocking' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['visit_id'] = $visit->id;

        return response()->json(VisitFinding::create($validated)->load('structure'), 201);
    }

    public function update(Request $request, VisitFinding $visitFinding): JsonResponse
    {
        $validated = $request->validate([
            'structure_id' => 'nullable|exists:structures,id',
            'section' => 'nullable|string|max:255',
            'category' => 'sometimes|in:civil,metallic,electrical,mechanical,operational,commercial,quality,safety,other',
            'severity' => 'nullable|in:low,medium,high,critical',
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'recommendation' => 'nullable|string',
            'is_blocking' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $visitFinding->update($validated);

        return response()->json($visitFinding->load('structure'));
    }

    public function destroy(VisitFinding $visitFinding): JsonResponse
    {
        $visitFinding->delete();

        return response()->json(null, 204);
    }
}
