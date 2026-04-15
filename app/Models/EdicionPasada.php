<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EdicionPasada extends Model
{
    use HasUuids;

    protected $table = 'ediciones_pasadas';

    protected $fillable = [
        'convocatoria_id',
        'nombre_artista',
        'url_perfil',
        'año',
    ];

    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class, 'convocatoria_id');
    }
}