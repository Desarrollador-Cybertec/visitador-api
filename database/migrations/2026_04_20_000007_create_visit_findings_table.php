<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_findings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('structure_id')->nullable()->constrained()->nullOnDelete();
            $table->string('section')->nullable();
            $table->enum('category', ['civil', 'metallic', 'electrical', 'mechanical', 'operational', 'commercial', 'quality', 'safety', 'other'])->default('other');
            $table->enum('severity', ['low', 'medium', 'high', 'critical'])->nullable();
            $table->string('title');
            $table->text('description');
            $table->text('recommendation')->nullable();
            $table->boolean('is_blocking')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_findings');
    }
};
