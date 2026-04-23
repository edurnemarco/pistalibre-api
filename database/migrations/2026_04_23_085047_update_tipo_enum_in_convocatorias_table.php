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
    DB::statement("ALTER TABLE convocatorias DROP CONSTRAINT convocatorias_tipo_check");
    DB::statement("ALTER TABLE convocatorias ADD CONSTRAINT convocatorias_tipo_check CHECK (tipo IN ('convocatoria', 'residencia', 'beca', 'concurso', 'ayuda', 'exposicion', 'premio'))");
}

public function down(): void
{
    DB::statement("ALTER TABLE convocatorias DROP CONSTRAINT convocatorias_tipo_check");
    DB::statement("ALTER TABLE convocatorias ADD CONSTRAINT convocatorias_tipo_check CHECK (tipo IN ('convocatoria', 'residencia', 'beca', 'concurso'))");
}
};
