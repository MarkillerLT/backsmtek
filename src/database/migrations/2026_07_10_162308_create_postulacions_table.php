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
        Schema::create('postulaciones', function (Blueprint $table) {
        $table->id();

        $table->string('nombre');
        $table->string('correo');
        $table->string('telefono', 20);
        $table->string('puesto')->nullable();
        $table->text('mensaje')->nullable();

        $table->string('cv');

        $table->enum('estado', [
            'recibido',
            'en_revision',
            'entrevista',
            'aceptado',
            'rechazado',
        ])->default('recibido');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulaciones');
    }
};
