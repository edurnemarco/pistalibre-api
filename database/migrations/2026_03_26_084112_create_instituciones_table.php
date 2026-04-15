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
        Schema::create('instituciones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('id')->on('users')->nullOnDelete();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->text('linea_curatorial')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('region')->nullable();
            $table->string('pais')->default('ES');
            $table->string('web')->nullable();
            $table->enum('origen', ['scraping', 'registro'])->default('registro');
            $table->boolean('verificada')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituciones');
    }
};
