<?php

namespace App\Http\Controllers;

use App\Models\VisitSignature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitSignatureController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            VisitSignature::where('visit_id', $request->visit_id)->get()
        );
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'signed_by_name' => 'required|string|max:255',
            'signed_by_role' => 'nullable|string|max:255',
            'signed_by_type' => 'required|in:insumma,client,delegate,contractor',
            'signature_file_path' => 'nullable|string',
            'signed_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        return response()->json(VisitSignature::create($validated), 201);
    }

    public function update(Request $request, VisitSignature $visitSignature): JsonResponse
    {
        $validated = $request->validate([
            'signed_by_name' => 'sometimes|string|max:255',
            'signed_by_role' => 'nullable|string|max:255',
            'signed_by_type' => 'sometimes|in:insumma,client,delegate,contractor',
            'signature_file_path' => 'nullable|string',
            'signed_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $visitSignature->update($validated);

        return response()->json($visitSignature);
    }

    public function destroy(VisitSignature $visitSignature): JsonResponse
    {
        $visitSignature->delete();

        return response()->json(null, 204);
    }
}
