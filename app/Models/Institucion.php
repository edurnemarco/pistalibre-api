<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Institucion extends Model
{
    use HasUuids;

    protected $table = 'instituciones';

    protected $fillable = [
        'usuario_id',
        'nombre',
        'descripcion',
        'linea_curatorial',
        'ciudad',
        'region',
        'pais',
        'web',
        'origen',
        'verificada',
    ];

    protected $casts = [
        'verificada' => 'boolean',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function convocatorias()
    {
        return $this->hasMany(Convocatoria::class, 'institucion_id');
    }
}