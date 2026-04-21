<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_media_annotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_media_id')->constrained('visit_media')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->longText('caption')->nullable();
            $table->string('sequence_label')->nullable();
            $table->enum('phase', ['before', 'during', 'after', 'evidence', 'finding', 'training', 'delivery'])->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_media_annotations');
    }
};
