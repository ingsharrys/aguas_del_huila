<x-layouts.app :title="__('Cuestionario CACSP')">
@include('encuestas.partials.estilos')
@php
    $generales = [
        'Fecha de la encuesta' => optional($cuestionario->fecha_encuesta)->format('d/m/Y'),
        'Municipio' => $municipio,
        'Ubicación' => ucfirst(strtolower((string) $cuestionario->ubicacion)),
        'Estrato' => $cuestionario->estrato,
        'Sector' => ucfirst(strtolower((string) $cuestionario->sector)),
        'Código suscriptor' => $respuestas['a_codigo_suscriptor'] ?? null,
        'Nombre' => $cuestionario->nombre,
        'Número de cédula' => $respuestas['P1_cedula'] ?? null,
        'Edad' => $cuestionario->edad,
        'Sexo' => ['MASCULINO' => 'Masculino', 'FEMENINO' => 'Femenino', 'PREFIERO_NO_DECIR' => 'Prefiere no responder'][$cuestionario->sexo] ?? '',
        'Dirección' => $cuestionario->direccion,
        'Barrio' => $cuestionario->barrio,
        'Teléfono' => $cuestionario->telefono === '9999999' ? 'No tiene' : $cuestionario->telefono,
    ];
@endphp
<div class="enc">
    <div class="enc-cabecera">
        <div>
            <p class="enc-subtitulo" style="margin: 0 0 4px"><a href="{{ route('dashboard.encuestas.cacsp.listado') }}" style="color: inherit">Respuestas CACSP</a> / #{{ $cuestionario->id }}</p>
            <h1 class="enc-titulo">{{ $cuestionario->nombre }}</h1>
            <p class="enc-subtitulo">{{ $municipio }} · {{ optional($cuestionario->fecha_encuesta)->format('d/m/Y') }}</p>
        </div>
        @role('Administrador|Editor')
            <form method="POST" action="{{ route('dashboard.encuestas.cacsp.eliminar', $cuestionario->id) }}" onsubmit="return confirm('¿Eliminar este cuestionario y todas sus respuestas? Esta acción no se puede deshacer.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="enc-boton" style="color: #e66767">Eliminar</button>
            </form>
        @endrole
    </div>

    <div class="enc-tarjeta">
        <h3 style="margin-bottom: 12px">Datos generales</h3>
        <table class="enc-tabla">
            @foreach($generales as $etiqueta => $valor)
                <tr><th style="width: 34%">{{ $etiqueta }}</th><td style="color: var(--texto)">{{ $valor ?: '—' }}</td></tr>
            @endforeach
        </table>
    </div>

    <div class="enc-tarjeta">
        <h3 style="margin-bottom: 12px">Respuestas</h3>
        <table class="enc-tabla">
            @foreach($preguntas as $clave => $pregunta)
                @continue(array_key_exists($clave, \App\Support\CuestionarioCacsp::DATOS_GENERALES) || in_array($clave, ['a_codigo_suscriptor', 'P1_cedula'], true))
                @if($pregunta['tipo'] === 'matriz')
                    @php $filasConRespuesta = collect($pregunta['filas'])->filter(fn ($f, $k) => isset($respuestas["$clave.$k"])); @endphp
                    @continue($filasConRespuesta->isEmpty())
                    <tr><th colspan="2" style="color: var(--texto); padding-top: 16px">{{ $pregunta['titulo'] }}</th></tr>
                    @foreach($filasConRespuesta as $f => $fila)
                        <tr><td style="padding-left: 24px">{{ $fila['texto'] }}</td><td style="color: var(--texto)">{{ \App\Http\Controllers\CacspAdminController::etiqueta($preguntas, "$clave.$f", $respuestas["$clave.$f"]) }}</td></tr>
                    @endforeach
                @else
                    @continue(!isset($respuestas[$clave]))
                    <tr><td style="width: 55%">{{ $pregunta['titulo'] }}</td><td style="color: var(--texto)">{{ \App\Http\Controllers\CacspAdminController::etiqueta($preguntas, $clave, $respuestas[$clave]) }}</td></tr>
                @endif
            @endforeach
        </table>
    </div>
</div>
</x-layouts.app>
