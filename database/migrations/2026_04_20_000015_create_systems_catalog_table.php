<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('systems_catalog', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('category')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('systems_catalog')->insert([
            ['code' => 'falso_techo',      'name' => 'Falso Techo',          'category' => 'estructura',   'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'comedero',         'name' => 'Comedero',             'category' => 'alimentacion', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'bebedero',         'name' => 'Bebedero',             'category' => 'alimentacion', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'cortina_lateral',  'name' => 'Cortina Lateral',      'category' => 'estructura',   'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'alimentacion',     'name' => 'Sistema Alimentación', 'category' => 'alimentacion', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'panel_humedo',     'name' => 'Panel Húmedo',         'category' => 'climatizacion','is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'extractor',        'name' => 'Extractor',            'category' => 'climatizacion','is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'malla',            'name' => 'Malla',                'category' => 'estructura',   'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'calefaccion',      'name' => 'Calefacción',          'category' => 'climatizacion','is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'sistema_electrico','name' => 'Sistema Eléctrico',    'category' => 'electrico',    'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('systems_catalog');
    }
};
