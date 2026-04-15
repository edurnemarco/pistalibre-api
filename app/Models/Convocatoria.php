<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Convocatoria extends Model
{
    use HasUuids;

    protected $table = 'convocatorias';

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'disciplinas',
        'fecha_inicio',
        'fecha_limite',
        'dotacion',
        'beneficios',
        'duracion',
        'requisitos',
        'ciudad',
        'region',
        'pais',
        'url_original',
        'estado',
        'origen',
        'institucion_id',
        'fuente_id',
    ];

    protected $casts = [
        'disciplinas' => 'array',
        'beneficios' => 'array',
        'fecha_inicio' => 'date',
        'fecha_limite' => 'date',
        'dotacion' => 'decimal:2',
    ];

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_id');
    }

    public function fuente()
    {
        return $this->belongsTo(Fuente::class, 'fuente_id');
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'convocatoria_id');
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'convocatoria_id');
    }

    public function participaciones()
    {
        return $this->hasMany(Participacion::class, 'convocatoria_id');
    }

    public function edicionesPasadas()
    {
        return $this->hasMany(EdicionPasada::class, 'convocatoria_id');
    }
}