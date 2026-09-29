<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargos';

    protected $fillable = [
        'nombre',
        'estado',
    ];

    /**
     * Un cargo tiene muchos usuarios asociados.
     */
    public function usuarios()
    {
        return $this->hasMany(User::class, 'cargo_id');
    }
}