<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ediciones_pasadas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('convocatoria_id')->constrained('convocatorias')->onDelete('cascade');
            $table->string('nombre_artista');
            $table->string('url_perfil')->nullable();
            $table->integer('año')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ediciones_pasadas');
    }
};