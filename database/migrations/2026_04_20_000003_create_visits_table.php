<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('farm_id')->constrained()->cascadeOnDelete();
            $table->foreignId('visit_type_id')->constrained();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('subject')->nullable();
            $table->enum('status', ['draft', 'scheduled', 'in_progress', 'completed', 'signed', 'closed', 'cancelled'])->default('draft');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->date('report_date')->nullable();
            $table->string('city')->nullable();
            $table->string('department')->nullable();
            $table->longText('context')->nullable();
            $table->longText('development')->nullable();
            $table->longText('general_observations')->nullable();
            $table->longText('conclusions')->nullable();
            $table->longText('internal_notes')->nullable();
            $table->enum('source', ['native', 'migrated_report_and_run', 'imported_pdf'])->default('native');
            $table->string('external_reference')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
