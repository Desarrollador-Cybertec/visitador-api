<?php

namespace App\Http\Controllers;

use App\Models\VisitSystemReview;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitSystemReviewController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            VisitSystemReview::with(['system', 'structure'])
                ->where('visit_id', $request->visit_id)
                ->get()
        );
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'structure_id' => 'nullable|exists:structures,id',
            'system_id' => 'required|exists:systems_catalog,id',
            'status' => 'required|in:ok,warning,critical,not_applicable',
            'summary' => 'nullable|string',
            'recommendation' => 'nullable|string',
        ]);

        return response()->json(VisitSystemReview::create($validated)->load(['system', 'structure']), 201);
    }

    public function update(Request $request, VisitSystemReview $visitSystemReview): JsonResponse
    {
        $validated = $request->validate([
            'structure_id' => 'nullable|exists:structures,id',
            'status' => 'sometimes|in:ok,warning,critical,not_applicable',
            'summary' => 'nullable|string',
            'recommendation' => 'nullable|string',
        ]);

        $visitSystemReview->update($validated);

        return response()->json($visitSystemReview->load(['system', 'structure']));
    }

    public function destroy(VisitSystemReview $visitSystemReview): JsonResponse
    {
        $visitSystemReview->delete();

        return response()->json(null, 204);
    }
}
