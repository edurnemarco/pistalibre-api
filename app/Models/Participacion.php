<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Participacion extends Model
{
    use HasUuids;

    protected $table = 'participaciones';

    protected $fillable = [
        'usuario_id',
        'convocatoria_id',
        'resultado',
        'nombre_proyecto',
        'descripcion_proyecto',
        'imagen_url',
        'año',
    ];

    protected $casts = [
        'año' => 'integer',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class, 'convocatoria_id');
    }
}