<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFarmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'transformator_capacity_kva' => ['nullable', 'integer', 'min:0'],
            'access_ways' => ['nullable', 'string', 'max:500'],
            'observations' => ['nullable', 'string', 'max:5000'],
            'farm_voltage' => ['nullable', Rule::in(['110V', '220V'])],
            'farm_electric_current' => ['nullable', Rule::in(['monophase', 'biphase', 'triphase'])],
            'have_own_transformator' => ['nullable', 'boolean'],
            'is_transformator_feeds_other_installations' => ['nullable', 'boolean'],
            'distance_to_neighbor_boundary_m' => ['nullable', 'numeric', 'min:0'],
            'transformator_are_feeding_installations' => ['nullable', 'string', 'max:500'],
            'neighboring_properties_notes' => ['nullable', 'string', 'max:500'],
            'have_easy_access_for_trailer' => ['nullable', 'boolean'],
            'staff_availability' => ['nullable', 'boolean'],
            'has_storage_warehouse' => ['nullable', 'boolean'],
            'how_many_warehouses' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
