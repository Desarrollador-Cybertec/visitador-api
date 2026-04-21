<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('category', ['report', 'service', 'inspection', 'project_followup']);
            $table->string('template_key')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('visit_types')->insert([
            ['code' => 'visita_inicial',       'name' => 'Visita Inicial',              'category' => 'inspection',       'template_key' => 'visita_inicial',       'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'diagnostico',          'name' => 'Diagnóstico',                 'category' => 'inspection',       'template_key' => 'diagnostico',          'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'visita_obra',          'name' => 'Visita de Obra',              'category' => 'inspection',       'template_key' => 'visita_obra',          'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'mantenimiento',        'name' => 'Mantenimiento',               'category' => 'service',          'template_key' => 'mantenimiento',        'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'garantia',             'name' => 'Garantía',                    'category' => 'service',          'template_key' => 'garantia',             'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'avance_obra',          'name' => 'Avance de Obra',              'category' => 'project_followup', 'template_key' => 'avance_obra',          'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'tecnico_comercial',    'name' => 'Reporte Técnico-Comercial',   'category' => 'report',           'template_key' => 'tecnico_comercial',    'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'servicio',             'name' => 'Servicio',                    'category' => 'service',          'template_key' => 'servicio',             'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'seguimiento',          'name' => 'Seguimiento',                 'category' => 'report',           'template_key' => 'seguimiento',          'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'bitacora_fotografica', 'name' => 'Bitácora Fotográfica',        'category' => 'report',           'template_key' => 'bitacora_fotografica', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_types');
    }
};
