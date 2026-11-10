<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            // Nullable: las cotizaciones anteriores quedan "Sin clasificar"
            $table->string('tipo_cotizacion')->nullable()->after('localidad');
            $table->string('otro_especificacion')->nullable()->after('tipo_cotizacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->dropColumn(['tipo_cotizacion', 'otro_especificacion']);
        });
    }
};
