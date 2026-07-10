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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->string ('nombre');
            $table->string ('empresa')->nullable();
            $table->string ('correo');
            $table->string ('telefono',10);
            $table->string ('asunto');
            $table->text ('mensaje');

            $table->enum('estado',[
                'pendiente',
                'en_proceso',
                'respondida'
            ])->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};

