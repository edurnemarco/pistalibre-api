<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasUuids, Notifiable, HasApiTokens;

    // Decirle a Laravel que el ID es UUID, no autoincrement
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    protected $table = 'users';

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'tipo',
        'ciudad',
        'region',
        'pais',
        'bio',
        'avatar_url',
        'web',
        'redes',
        'activo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'redes' => 'array',
        'activo' => 'boolean',
    ];

    // Relaciones
    public function institucion()
    {
        return $this->hasOne(Institucion::class, 'usuario_id');
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'usuario_id');
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'usuario_id');
    }

    public function participaciones()
    {
        return $this->hasMany(Participacion::class, 'usuario_id');
    }
}