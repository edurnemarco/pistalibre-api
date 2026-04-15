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
        Schema::create('alertas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users')->cascadeOnDelete();
            $table->uuid('convocatoria_id');
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias')->cascadeOnDelete();
            $table->integer('dias_antes')->default(7);
            $table->boolean('notificado_email')->default(false);
            $table->timestamp('email_enviado_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};
