<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Fuente extends Model
{
    use HasUuids;

    protected $table = 'fuentes';

    protected $fillable = [
        'nombre',
        'url',
        'tipo',
        'activa',
        'ultimo_scraping',
    ];

    protected $casts = [
        'activa' => 'boolean',
        'ultimo_scraping' => 'datetime',
    ];

    // Relaciones
    public function convocatorias()
    {
        return $this->hasMany(Convocatoria::class, 'fuente_id');
    }
}