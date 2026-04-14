<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFarmGeorreferenceRequest;
use App\Http\Requests\UpdateFarmGeorreferenceRequest;
use App\Http\Resources\FarmGeorreferenceResource;
use App\Models\FarmGeorreference;
use Illuminate\Http\JsonResponse;

class FarmGeorreferenceController extends Controller
{
    public function index(): JsonResponse
    {
        $georreferences = FarmGeorreference::with('farm')->paginate(15);

        return FarmGeorreferenceResource::collection($georreferences)->response();
    }

    public function store(StoreFarmGeorreferenceRequest $request): JsonResponse
    {
        $georreference = FarmGeorreference::create($request->validated());

        return (new FarmGeorreferenceResource($georreference))
            ->response()
            ->setStatusCode(201);
    }

    public function show(FarmGeorreference $farmGeorreference): FarmGeorreferenceResource
    {
        return new FarmGeorreferenceResource($farmGeorreference->load('farm'));
    }

    public function update(UpdateFarmGeorreferenceRequest $request, FarmGeorreference $farmGeorreference): FarmGeorreferenceResource
    {
        $farmGeorreference->update($request->validated());

        return new FarmGeorreferenceResource($farmGeorreference);
    }

    public function destroy(FarmGeorreference $farmGeorreference): JsonResponse
    {
        $farmGeorreference->delete();

        return response()->json(null, 204);
    }
}
