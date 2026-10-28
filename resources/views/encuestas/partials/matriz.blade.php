{{-- Pregunta con varias filas (aspectos): una barra apilada por fila, valor resumen a la derecha y una sola leyenda --}}
@php
    // $modo: 'escala' (% Muy bueno + Bueno sin "No sabe"), 'sino' (% Sí) o 'ninguno'
    $modo ??= 'escala';
    $opcionesEtiquetas = array_keys(reset($filas)['datos'] ?? []);
    $totalPregunta = collect($filas)->map(fn ($f) => array_sum($f['datos']))->max() ?? 0;
@endphp
<div class="enc-tarjeta">
    <div class="enc-tarjeta-cab">
        <div>
            <h3>{{ $titulo }}</h3>
            <p class="enc-nota">{{ number_format($totalPregunta, 0, ',', '.') }} {{ $totalPregunta === 1 ? 'respuesta' : 'respuestas' }}
                @if($modo === 'escala') · % muy bueno o bueno @elseif($modo === 'sino') · % que respondió Sí @endif</p>
        </div>
    </div>

    @if($totalPregunta === 0)
        <p class="enc-vacio">Sin respuestas en este período.</p>
    @else
        @foreach($filas as $fila)
            @php
                $datos = $fila['datos'];
                $total = array_sum($datos);
                $valoradas = $modo === 'escala' ? array_diff_key($datos, array_flip(['No sabe'])) : $datos;
                $base = array_sum($valoradas);
                $resumen = match ($modo) {
                    'escala' => $base ? round(array_sum(array_slice($valoradas, 0, 2)) / $base * 100) . '%' : '—',
                    'sino'   => $total ? round(($datos['Sí'] ?? 0) / $total * 100) . '%' : '—',
                    default  => '',
                };
            @endphp
            <div class="enc-matriz-fila">
                <span>{{ $fila['texto'] }}</span>
                @if($total)
                    <div class="enc-apilada" role="img" aria-label="{{ $fila['texto'] }}: {{ collect($datos)->filter()->map(fn ($v, $k) => "$k $v")->implode(', ') }}">
                        @foreach($datos as $opcion => $cantidad)
                            @if($cantidad > 0)
                                <div style="flex: {{ $cantidad }}; background: {{ $colores[$loop->index] ?? 'var(--neutro)' }}"
                                     data-tip="<b>{{ e($opcion) }}</b>{{ $cantidad }} · {{ round($cantidad / $total * 100) }}%"></div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="enc-apilada" style="background: var(--surface-2)"></div>
                @endif
                <b>{{ $resumen }}</b>
            </div>
        @endforeach

        <div class="enc-leyenda-linea">
            @foreach($opcionesEtiquetas as $i => $etiqueta)
                <span><i style="background: {{ $colores[$i] ?? 'var(--neutro)' }}"></i>{{ $etiqueta }}</span>
            @endforeach
        </div>
    @endif
</div>
