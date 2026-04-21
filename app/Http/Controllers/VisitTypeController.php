<?php

namespace App\Http\Controllers;

use App\Models\VisitType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitTypeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(VisitType::where('is_active', true)->get());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:visit_types,code',
            'name' => 'required|string|max:255',
            'category' => 'required|in:report,service,inspection,project_followup',
            'template_key' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        return response()->json(VisitType::create($validated), 201);
    }

    public function show(VisitType $visitType): JsonResponse
    {
        return response()->json($visitType->load('formTemplates', 'reportTemplates'));
    }

    public function update(Request $request, VisitType $visitType): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|in:report,service,inspection,project_followup',
            'template_key' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $visitType->update($validated);

        return response()->json($visitType);
    }

    public function destroy(VisitType $visitType): JsonResponse
    {
        $visitType->delete();

        return response()->json(null, 204);
    }
}
