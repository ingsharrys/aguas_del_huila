<?php

namespace App\Exports;

// use App\Models\Area;
use App\Models\EncuestaPqrsdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;

class PqrsdfExport implements FromQuery, WithHeadings, WithMapping
{
    protected Request $request;

    protected $usuario;

    public function __construct(Request $request, $usuario)
    {
        $this->request = $request;
        $this->usuario = $usuario;
    }


    /**
     * Consulta que alimentará el Excel
     */
    public function query(): Builder
    {
        $query = EncuestaPqrsdf::query();

        /*
        |--------------------------------------------------------------------------
        | Restricción por usuario
        |--------------------------------------------------------------------------
        */

        if (
            !$this->usuario->hasRole('Administrador') &&
            $this->usuario->area?->nombre !== 'TIC'
        ) {

            $query->where(
                'user_id',
                $this->usuario->id
            );

        } else {

            /*
            |--------------------------------------------------------------------------
            | Filtro por área
            |--------------------------------------------------------------------------
            */

            if ($this->request->filled('area')) {

                $query->where(
                    'area_id',
                    $this->request->area
                );

            }
        }


        /*
        |--------------------------------------------------------------------------
        | Estado
        |--------------------------------------------------------------------------
        */

        if ($this->request->filled('estado')) {

            $query->where(
                'estado',
                $this->request->estado
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Código de radicado
        |--------------------------------------------------------------------------
        */

        if ($this->request->filled('codigo_radicado')) {

            $query->where(
                'codigo_radicado',
                'like',
                '%' . $this->request->codigo_radicado . '%'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Fechas
        |--------------------------------------------------------------------------
        */

        if (
            $this->request->filled('fecha_inicio') &&
            $this->request->filled('fecha_fin')
        ) {

            $query->whereBetween('created_at', [
                $this->request->fecha_inicio . ' 00:00:00',
                $this->request->fecha_fin . ' 23:59:59'
            ]);

        } elseif ($this->request->filled('fecha_inicio')) {

            $query->whereDate(
                'created_at',
                '>=',
                $this->request->fecha_inicio
            );

        } elseif ($this->request->filled('fecha_fin')) {

            $query->whereDate(
                'created_at',
                '<=',
                $this->request->fecha_fin
            );

        }


        return $query
            ->with([
                'area',
                'usuario'
            ])
            ->orderByDesc('created_at');
    }


    /**
     * Encabezados del Excel
     */
    public function headings(): array
    {
        return [
            'ID',
            'Código de radicado',
            'Fecha de registro',
            'Tipo de PQRSF',
            'Tipo de respuesta',
            'Nombre',
            'Apellido',
            'Correo electrónico',
            'Área',
            'Usuario asignado',
            'Estado',
            'Asunto',
            'Fecha de respuesta',
        ];
    }


    /**
     * Datos de cada fila
     */
    public function map($pqrsdf): array
    {
        return [
            $pqrsdf->id,

            $pqrsdf->codigo_radicado,

            $pqrsdf->created_at ? $pqrsdf->created_at->format('d/m/Y H:i:s') : '',

            $pqrsdf->tipo_pqrsf,

            $pqrsdf->tipo_respuesta,

            $pqrsdf->nombre_usuario ?? 'Anónimo',

            $pqrsdf->apellido_usuario ?? 'Anónimo',

            $pqrsdf->correo_electronico ?? 'Anónimo',

            $pqrsdf->area?->nombre ?? 'Sin asignar',

            $pqrsdf->usuario?->name ?? 'Sin asignar',

            $pqrsdf->estado,

            $pqrsdf->asunto,

            $pqrsdf->fecha_respuesta
                ? \Carbon\Carbon::parse(
                    $pqrsdf->fecha_respuesta
                )->format('d/m/Y H:i:s')
                : '',
        ];
    }
}