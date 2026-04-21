<?php

namespace App\Http\Controllers;

use App\Models\SystemsCatalog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SystemsCatalogController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(SystemsCatalog::where('is_active', true)->get());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:systems_catalog,code',
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        return response()->json(SystemsCatalog::create($validated), 201);
    }

    public function show(SystemsCatalog $systemsCatalog): JsonResponse
    {
        return response()->json($systemsCatalog);
    }

    public function update(Request $request, SystemsCatalog $systemsCatalog): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $systemsCatalog->update($validated);

        return response()->json($systemsCatalog);
    }

    public function destroy(SystemsCatalog $systemsCatalog): JsonResponse
    {
        $systemsCatalog->delete();

        return response()->json(null, 204);
    }
}
