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
        Schema::create('participaciones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users')->cascadeOnDelete();
            $table->uuid('convocatoria_id');
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias')->cascadeOnDelete();
            $table->enum('resultado', ['seleccionado', 'finalista', 'no_seleccionado', 'pendiente'])->default('pendiente');
            $table->string('nombre_proyecto')->nullable();
            $table->text('descripcion_proyecto')->nullable();
            $table->string('imagen_url')->nullable();
            $table->integer('año')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participaciones');
    }
};
