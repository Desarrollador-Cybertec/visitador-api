<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Visit::with(['visitType', 'client', 'farm', 'creator'])
            ->when($request->client_id, fn($q) => $q->where('client_id', $request->client_id))
            ->when($request->farm_id, fn($q) => $q->where('farm_id', $request->farm_id))
            ->when($request->visit_type_id, fn($q) => $q->where('visit_type_id', $request->visit_type_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->assigned_to, function ($q) use ($request) {
                $value = $request->assigned_to === 'me'
                    ? $request->user()->id
                    : $request->assigned_to;
                $q->where('assigned_to', $value);
            })
            ->latest()
            ->paginate($request->per_page ?? 20);

        return response()->json($query);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'farm_id' => 'required|exists:farms,id',
            'visit_type_id' => 'required|exists:visit_types,id',
            'assigned_to' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'status' => 'nullable|in:draft,scheduled,in_progress,completed,signed,closed,cancelled',
            'started_at' => 'nullable|date',
            'ended_at' => 'nullable|date',
            'report_date' => 'nullable|date',
            'city' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'context' => 'nullable|string',
            'development' => 'nullable|string',
            'general_observations' => 'nullable|string',
            'conclusions' => 'nullable|string',
            'internal_notes' => 'nullable|string',
            'source' => 'nullable|in:native,migrated_report_and_run,imported_pdf',
            'external_reference' => 'nullable|string|max:255',
        ]);

        $validated['created_by'] = $request->user()->id;

        $visit = Visit::create($validated);

        return response()->json($visit->load(['visitType', 'client', 'farm', 'creator']), 201);
    }

    public function show(Visit $visit): JsonResponse
    {
        return response()->json($visit->load([
            'visitType',
            'client',
            'farm',
            'creator',
            'assignee',
            'structures.structure',
            'participants',
            'signatures',
            'findings',
            'commitments',
            'media.annotations',
            'systemReviews.system',
            'measurements',
            'materialRequests',
        ]));
    }

    public function update(Request $request, Visit $visit): JsonResponse
    {
        $validated = $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
            'title' => 'sometimes|string|max:255',
            'subject' => 'nullable|string|max:255',
            'status' => 'nullable|in:draft,scheduled,in_progress,completed,signed,closed,cancelled',
            'started_at' => 'nullable|date',
            'ended_at' => 'nullable|date',
            'report_date' => 'nullable|date',
            'city' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'context' => 'nullable|string',
            'development' => 'nullable|string',
            'general_observations' => 'nullable|string',
            'conclusions' => 'nullable|string',
            'internal_notes' => 'nullable|string',
        ]);

        $visit->update($validated);

        return response()->json($visit->load(['visitType', 'client', 'farm']));
    }

    public function destroy(Visit $visit): JsonResponse
    {
        $visit->delete();

        return response()->json(null, 204);
    }
}
