<?php

namespace App\Support;

use Carbon\Carbon;
use Carbon\CarbonInterface;

/**
 * Días hábiles en Colombia: lunes a viernes, sin festivos nacionales (Ley 51 de 1983 - Ley Emiliani).
 * Los plazos de PQRSDF se cuentan en días hábiles (Ley 1755 de 2015).
 */
class DiasHabiles
{
    private static array $cache = [];

    /**
     * Fecha que resulta de sumar N días hábiles (el día de inicio no cuenta).
     */
    public static function sumar(CarbonInterface $desde, int $dias): Carbon
    {
        $fecha = Carbon::parse($desde)->startOfDay();

        while ($dias > 0) {
            $fecha->addDay();
            if (static::esHabil($fecha)) {
                $dias--;
            }
        }

        return $fecha;
    }

    /**
     * Fecha que resulta de restar N días hábiles.
     */
    public static function restar(CarbonInterface $desde, int $dias): Carbon
    {
        $fecha = Carbon::parse($desde)->startOfDay();

        while ($dias > 0) {
            $fecha->subDay();
            if (static::esHabil($fecha)) {
                $dias--;
            }
        }

        return $fecha;
    }

    /**
     * Días hábiles desde hoy (sin contarlo) hasta la fecha. Negativo si ya pasó.
     */
    public static function restantes(CarbonInterface|string|null $fecha, ?CarbonInterface $desde = null): ?int
    {
        if (!$fecha) {
            return null;
        }

        $inicio = Carbon::parse($desde ?? Carbon::today())->startOfDay();
        $fin = Carbon::parse($fecha)->startOfDay();

        if ($fin->equalTo($inicio)) {
            return 0;
        }

        $signo = $fin->greaterThan($inicio) ? 1 : -1;
        [$a, $b] = $signo > 0 ? [$inicio, $fin] : [$fin, $inicio];

        $cuenta = 0;
        for ($d = $a->copy()->addDay(); $d->lessThanOrEqualTo($b); $d->addDay()) {
            if (static::esHabil($d)) {
                $cuenta++;
            }
        }

        return $signo * $cuenta;
    }

    public static function esHabil(CarbonInterface $fecha): bool
    {
        return !$fecha->isWeekend() && !static::esFestivo($fecha);
    }

    public static function esFestivo(CarbonInterface $fecha): bool
    {
        return in_array($fecha->format('Y-m-d'), static::festivos((int) $fecha->format('Y')), true);
    }

    /**
     * Festivos nacionales de Colombia para un año (formato Y-m-d).
     */
    public static function festivos(int $anio): array
    {
        if (isset(static::$cache[$anio])) {
            return static::$cache[$anio];
        }

        $fijo = fn (int $mes, int $dia) => Carbon::create($anio, $mes, $dia);
        // Ley Emiliani: si no cae lunes, se traslada al lunes siguiente
        $lunes = fn (CarbonInterface $f) => $f->isMonday() ? $f : $f->copy()->next(CarbonInterface::MONDAY);

        $pascua = static::domingoDePascua($anio);

        $fechas = [
            $fijo(1, 1),                               // Año Nuevo
            $lunes($fijo(1, 6)),                       // Reyes Magos
            $lunes($fijo(3, 19)),                      // San José
            $pascua->copy()->subDays(3),               // Jueves Santo
            $pascua->copy()->subDays(2),               // Viernes Santo
            $fijo(5, 1),                               // Día del Trabajo
            $lunes($pascua->copy()->addDays(39)),      // Ascensión del Señor
            $lunes($pascua->copy()->addDays(60)),      // Corpus Christi
            $lunes($pascua->copy()->addDays(68)),      // Sagrado Corazón
            $lunes($fijo(6, 29)),                      // San Pedro y San Pablo
            $fijo(7, 20),                              // Independencia
            $fijo(8, 7),                               // Batalla de Boyacá
            $lunes($fijo(8, 15)),                      // Asunción de la Virgen
            $lunes($fijo(10, 12)),                     // Día de la Raza
            $lunes($fijo(11, 1)),                      // Todos los Santos
            $lunes($fijo(11, 11)),                     // Independencia de Cartagena
            $fijo(12, 8),                              // Inmaculada Concepción
            $fijo(12, 25),                             // Navidad
        ];

        return static::$cache[$anio] = collect($fechas)->map(fn ($f) => $f->format('Y-m-d'))->unique()->sort()->values()->all();
    }

    /**
     * Domingo de Pascua (algoritmo de Meeus/Jones/Butcher, calendario gregoriano).
     */
    private static function domingoDePascua(int $anio): Carbon
    {
        $a = $anio % 19;
        $b = intdiv($anio, 100);
        $c = $anio % 100;
        $d = intdiv($b, 4);
        $e = $b % 4;
        $f = intdiv($b + 8, 25);
        $g = intdiv($b - $f + 1, 3);
        $h = (19 * $a + $b - $d - $g + 15) % 30;
        $i = intdiv($c, 4);
        $k = $c % 4;
        $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
        $m = intdiv($a + 11 * $h + 22 * $l, 451);
        $mes = intdiv($h + $l - 7 * $m + 114, 31);
        $dia = (($h + $l - 7 * $m + 114) % 31) + 1;

        return Carbon::create($anio, $mes, $dia)->startOfDay();
    }
}
