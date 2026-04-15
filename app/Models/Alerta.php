<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Alerta extends Model
{
    use HasUuids;

    protected $table = 'alertas';

    protected $fillable = [
        'usuario_id',
        'convocatoria_id',
        'dias_antes',
        'notificado_email',
        'email_enviado_en',
    ];

    protected $casts = [
        'notificado_email' => 'boolean',
        'email_enviado_en' => 'datetime',
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