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
        Schema::create('convocatorias', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['convocatoria', 'concurso', 'residencia', 'beca']);
            $table->json('disciplinas')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->decimal('dotacion', 10, 2)->nullable();
            $table->string('ciudad')->nullable();
            $table->string('region')->nullable();
            $table->string('pais')->default('ES');
            $table->text('url_original')->nullable();
            $table->enum('estado', ['pendiente', 'publicada', 'rechazada', 'archivada'])->default('pendiente');
            $table->enum('origen', ['scraping', 'institucion', 'manual'])->default('scraping');
            $table->uuid('institucion_id')->nullable();
            $table->foreign('institucion_id')->references('id')->on('instituciones')->nullOnDelete();
            $table->uuid('fuente_id')->nullable();
            $table->foreign('fuente_id')->references('id')->on('fuentes')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convocatorias');
    }
};
