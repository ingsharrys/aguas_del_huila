<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionSmtp extends Model
{
    protected $table = 'configuracion_smtp';

    protected $fillable = [
        'activo',
        'host',
        'puerto',
        'cifrado',
        'usuario',
        'password',
        'timeout',
        'remitente_correo',
        'remitente_nombre',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'activo'   => 'boolean',
            'puerto'   => 'integer',
            'timeout'  => 'integer',
            'password' => 'encrypted',
        ];
    }

    public static function actual(): ?self
    {
        return static::query()->first();
    }
}
