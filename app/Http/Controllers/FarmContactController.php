<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFarmContactRequest;
use App\Http\Requests\UpdateFarmContactRequest;
use App\Http\Resources\FarmContactResource;
use App\Models\FarmContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FarmContactController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $contacts = FarmContact::with('farm')
            ->when($request->farm_id, fn($q) => $q->where('farm_id', $request->farm_id))
            ->paginate(15);

        return FarmContactResource::collection($contacts)->response();
    }

    public function store(StoreFarmContactRequest $request): JsonResponse
    {
        $contact = FarmContact::create($request->validated());

        return (new FarmContactResource($contact))
            ->response()
            ->setStatusCode(201);
    }

    public function show(FarmContact $farmContact): FarmContactResource
    {
        return new FarmContactResource($farmContact->load('farm'));
    }

    public function update(UpdateFarmContactRequest $request, FarmContact $farmContact): FarmContactResource
    {
        $farmContact->update($request->validated());

        return new FarmContactResource($farmContact);
    }

    public function destroy(FarmContact $farmContact): JsonResponse
    {
        $farmContact->delete();

        return response()->json(null, 204);
    }
}
