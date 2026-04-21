<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\VisitCommitment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitCommitmentController extends Controller
{
    public function index(Visit $visit, Request $request): JsonResponse
    {
        return response()->json(
            VisitCommitment::with(['structure', 'responsibleUser'])
                ->where('visit_id', $visit->id)
                ->when($request->status, fn($q) => $q->where('status', $request->status))
                ->get()
        );
    }

    public function store(Request $request, Visit $visit): JsonResponse
    {
        $validated = $request->validate([
            'structure_id' => 'nullable|exists:structures,id',
            'description' => 'required|string',
            'responsible_type' => 'required|in:insumma,client,contractor,shared',
            'responsible_user_id' => 'nullable|exists:users,id',
            'responsible_name' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:open,in_progress,completed,cancelled',
            'completion_notes' => 'nullable|string',
        ]);

        $validated['visit_id'] = $visit->id;

        return response()->json(VisitCommitment::create($validated)->load(['structure', 'responsibleUser']), 201);
    }

    public function update(Request $request, VisitCommitment $visitCommitment): JsonResponse
    {
        $validated = $request->validate([
            'structure_id' => 'nullable|exists:structures,id',
            'description' => 'sometimes|string',
            'responsible_type' => 'sometimes|in:insumma,client,contractor,shared',
            'responsible_user_id' => 'nullable|exists:users,id',
            'responsible_name' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:open,in_progress,completed,cancelled',
            'completion_notes' => 'nullable|string',
        ]);

        $visitCommitment->update($validated);

        return response()->json($visitCommitment->load(['structure', 'responsibleUser']));
    }

    public function destroy(VisitCommitment $visitCommitment): JsonResponse
    {
        $visitCommitment->delete();

        return response()->json(null, 204);
    }
}
