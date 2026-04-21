<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farms', function (Blueprint $table) {
            $table->unsignedInteger('total_galpones')->nullable()->after('has_storage_warehouse');
            $table->unsignedInteger('galpones_a_cotizar')->nullable()->after('total_galpones');
        });
    }

    public function down(): void
    {
        Schema::table('farms', function (Blueprint $table) {
            $table->dropColumn(['total_galpones', 'galpones_a_cotizar']);
        });
    }
};
