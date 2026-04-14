<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FarmResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'nombre' => $this->nombre,
            'transformator_capacity_kva' => $this->transformator_capacity_kva,
            'access_ways' => $this->access_ways,
            'observations' => $this->observations,
            'farm_voltage' => $this->farm_voltage,
            'farm_electric_current' => $this->farm_electric_current,
            'have_own_transformator' => $this->have_own_transformator,
            'is_transformator_feeds_other_installations' => $this->is_transformator_feeds_other_installations,
            'distance_to_neighbor_boundary_m' => $this->distance_to_neighbor_boundary_m,
            'transformator_are_feeding_installations' => $this->transformator_are_feeding_installations,
            'neighboring_properties_notes' => $this->neighboring_properties_notes,
            'have_easy_access_for_trailer' => $this->have_easy_access_for_trailer,
            'staff_availability' => $this->staff_availability,
            'has_storage_warehouse' => $this->has_storage_warehouse,
            'how_many_warehouses' => $this->how_many_warehouses,
            'client' => new ClientResource($this->whenLoaded('client')),
            'georreference' => new FarmGeorreferenceResource($this->whenLoaded('georreference')),
            'contacts' => FarmContactResource::collection($this->whenLoaded('contacts')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
