<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\VisitMeasurement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitMeasurementController extends Controller
{
    public function index(Visit $visit): JsonResponse
    {
        return response()->json(
            VisitMeasurement::with('structure')
                ->where('visit_id', $visit->id)
                ->get()
        );
    }

    public function store(Request $request, Visit $visit): JsonResponse
    {
        $validated = $request->validate([
            'structure_id' => 'nullable|exists:structures,id',
            'measurement_type' => 'required|string|max:100',
            'label' => 'required|string|max:255',
            'value' => 'required|numeric',
            'unit' => 'required|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $validated['visit_id'] = $visit->id;

        return response()->json(VisitMeasurement::create($validated)->load('structure'), 201);
    }

    public function update(Request $request, VisitMeasurement $visitMeasurement): JsonResponse
    {
        $validated = $request->validate([
            'structure_id' => 'nullable|exists:structures,id',
            'measurement_type' => 'sometimes|string|max:100',
            'label' => 'sometimes|string|max:255',
            'value' => 'sometimes|numeric',
            'unit' => 'sometimes|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $visitMeasurement->update($validated);

        return response()->json($visitMeasurement->load('structure'));
    }

    public function destroy(VisitMeasurement $visitMeasurement): JsonResponse
    {
        $visitMeasurement->delete();

        return response()->json(null, 204);
    }
}
