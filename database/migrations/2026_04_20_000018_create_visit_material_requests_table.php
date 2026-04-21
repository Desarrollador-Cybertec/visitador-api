<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_material_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('structure_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('system_id')->nullable()->constrained('systems_catalog')->nullOnDelete();
            $table->string('item_code')->nullable();
            $table->text('description');
            $table->string('unit');
            $table->decimal('requested_quantity', 12, 4);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_material_requests');
    }
};
