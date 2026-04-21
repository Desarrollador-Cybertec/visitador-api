<?php

namespace App\Http\Controllers;

use App\Models\VisitParticipant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitParticipantController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            VisitParticipant::with(['farmContact', 'user'])
                ->where('visit_id', $request->visit_id)
                ->get()
        );
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'farm_contact_id' => 'nullable|exists:farm_contacts,id',
            'user_id' => 'nullable|exists:users,id',
            'participant_type' => 'required|in:internal,client,contractor,other',
            'name' => 'required|string|max:255',
            'role_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        return response()->json(VisitParticipant::create($validated), 201);
    }

    public function update(Request $request, VisitParticipant $visitParticipant): JsonResponse
    {
        $validated = $request->validate([
            'participant_type' => 'sometimes|in:internal,client,contractor,other',
            'name' => 'sometimes|string|max:255',
            'role_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        $visitParticipant->update($validated);

        return response()->json($visitParticipant);
    }

    public function destroy(VisitParticipant $visitParticipant): JsonResponse
    {
        $visitParticipant->delete();

        return response()->json(null, 204);
    }
}
