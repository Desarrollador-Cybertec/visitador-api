<?php

namespace App\Http\Controllers;

use App\Models\FormTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FormTemplateController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            FormTemplate::with(['visitType', 'sections.fields'])
                ->when($request->visit_type_id, fn($q) => $q->where('visit_type_id', $request->visit_type_id))
                ->when($request->active_only, fn($q) => $q->where('is_active', true))
                ->get()
        );
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'visit_type_id' => 'required|exists:visit_types,id',
            'name' => 'required|string|max:255',
            'version' => 'nullable|string|max:20',
            'schema_json' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        return response()->json(FormTemplate::create($validated)->load(['visitType', 'sections.fields']), 201);
    }

    public function show(FormTemplate $formTemplate): JsonResponse
    {
        return response()->json($formTemplate->load(['visitType', 'sections.fields']));
    }

    public function update(Request $request, FormTemplate $formTemplate): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'version' => 'nullable|string|max:20',
            'schema_json' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $formTemplate->update($validated);

        return response()->json($formTemplate->load(['visitType', 'sections.fields']));
    }

    public function destroy(FormTemplate $formTemplate): JsonResponse
    {
        $formTemplate->delete();

        return response()->json(null, 204);
    }
}
