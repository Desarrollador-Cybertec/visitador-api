<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->string('nombre');
            $table->unsignedInteger('transformator_capacity_kva')->nullable();
            $table->string('access_ways')->nullable();
            $table->text('observations')->nullable();
            $table->enum('farm_voltage', ['110V', '220V'])->nullable();
            $table->enum('farm_electric_current', ['monophase', 'biphase', 'triphase'])->nullable();
            $table->boolean('have_own_transformator')->default(false);
            $table->boolean('is_transformator_feeds_other_installations')->default(false);
            $table->decimal('distance_to_neighbor_boundary_m', 10, 2)->nullable();
            $table->string('transformator_are_feeding_installations')->nullable();
            $table->string('neighboring_properties_notes')->nullable();
            $table->boolean('have_easy_access_for_trailer')->default(false);
            $table->boolean('staff_availability')->default(false);
            $table->boolean('has_storage_warehouse')->default(false);
            $table->unsignedInteger('how_many_warehouses')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farms');
    }
};
