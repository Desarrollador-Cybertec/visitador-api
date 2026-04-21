<?php

namespace App\Http\Controllers;

use App\Models\VisitMedia;
use App\Models\VisitMediaAnnotation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitMediaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            VisitMedia::with(['annotations', 'structure', 'uploader'])
                ->where('visit_id', $request->visit_id)
                ->orderBy('sort_order')
                ->get()
        );
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'structure_id' => 'nullable|exists:structures,id',
            'media_type' => 'required|in:image,video,audio,document',
            'storage_disk' => 'nullable|string',
            'bucket' => 'nullable|string',
            'path_original' => 'required|string',
            'path_processed' => 'nullable|string',
            'mime_type' => 'nullable|string',
            'extension' => 'nullable|string',
            'size_bytes' => 'nullable|integer',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'duration_seconds' => 'nullable|integer',
            'checksum' => 'nullable|string',
            'captured_at' => 'nullable|date',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['uploaded_by'] = $request->user()->id;

        return response()->json(VisitMedia::create($validated)->load(['annotations', 'structure']), 201);
    }

    public function show(VisitMedia $visitMedia): JsonResponse
    {
        return response()->json($visitMedia->load(['annotations', 'structure', 'uploader']));
    }

    public function update(Request $request, VisitMedia $visitMedia): JsonResponse
    {
        $validated = $request->validate([
            'structure_id' => 'nullable|exists:structures,id',
            'sort_order' => 'nullable|integer',
            'path_processed' => 'nullable|string',
        ]);

        $visitMedia->update($validated);

        return response()->json($visitMedia->load(['annotations', 'structure']));
    }

    public function destroy(VisitMedia $visitMedia): JsonResponse
    {
        $visitMedia->delete();

        return response()->json(null, 204);
    }

    public function annotate(Request $request, VisitMedia $visitMedia): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
            'sequence_label' => 'nullable|string|max:100',
            'phase' => 'nullable|in:before,during,after,evidence,finding,training,delivery',
        ]);

        $validated['visit_media_id'] = $visitMedia->id;
        $validated['created_by'] = $request->user()->id;

        $annotation = VisitMediaAnnotation::create($validated);

        return response()->json($annotation, 201);
    }
}
