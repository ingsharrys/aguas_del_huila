<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles; // Implementar roles
use App\Models\Area;
use App\Models\Cargo;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles;

    protected $fillable = [
        'name',
        'nombres',
        'apellidos',
        'numero_identificacion',
        'username',
        'email',
        'password',
        'area_id',
        'es_jefe',
        'cargo_id',
        'tipo_vinculacion',
        'fecha_terminacion',
        'estado',
    ];

    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'es_jefe'           => 'boolean',
            'fecha_terminacion' => 'date',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // Relación con Área
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    // Relación con Cargo
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    /**
     * Evalúa si el usuario está activo verificando tanto el estado manual
     * como si la fecha de terminación ya venció.
     */
    public function getEstaActivoAttribute(): bool
    {
        if ($this->estado === 'Desactivado') {
            return false;
        }

        if ($this->fecha_terminacion && $this->fecha_terminacion->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Validar el estado del usuario
     */
    public function estaActivo(): bool
    {
        // Si el usuario está desactivado manualmente,
        // no puede iniciar sesión.
        if ($this->estado === 'Desactivado') {
            return false;
        }

        // Si no tiene fecha de terminación,
        // puede iniciar sesión.
        if (is_null($this->fecha_terminacion)) {
            return true;
        }

        // La fecha de terminación de HOY todavía permite el acceso.
        // Se bloquea a partir del día siguiente.
        return $this->fecha_terminacion >= now()->toDateString();
    }
}