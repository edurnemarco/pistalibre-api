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
        'convocatoria_nombre',
        'institucion_nombre',
        'resultado',
        'lugar',
        'nombre_proyecto',
        'descripcion_proyecto',
        'imagen_url',
        'imagenes',
        'enlaces',
        'año',
    ];

    protected $casts = [
    'imagenes' => 'array',
    'enlaces' => 'array',
];

    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}