{{-- Distribución por categoría: barras horizontales de un solo tono, ordenadas de mayor a menor --}}
@php
    $datos = collect($datos)->sortDesc();
    $total = $datos->sum();
    $maximo = $datos->max() ?: 1;
@endphp
<div class="enc-tarjeta">
    <div class="enc-tarjeta-cab">
        <div>
            <h3>{{ $titulo }}</h3>
            <p class="enc-nota">{{ number_format($total, 0, ',', '.') }} {{ $total === 1 ? 'respuesta' : 'respuestas' }}</p>
        </div>
    </div>

    @if($total === 0)
        <p class="enc-vacio">{{ $vacio ?? 'Sin respuestas en este período.' }}</p>
    @else
        <div class="enc-barras">
            @foreach($datos as $opcion => $cantidad)
                <div class="enc-barra-fila" data-tip="<b>{{ e($opcion) }}</b>{{ $cantidad }} {{ $cantidad === 1 ? 'respuesta' : 'respuestas' }} · {{ round($cantidad / $total * 100) }}%">
                    <div class="enc-barra-texto">
                        <span>{{ $opcion }}</span>
                        <span><b>{{ $cantidad }}</b> · {{ round($cantidad / $total * 100) }}%</span>
                    </div>
                    <div class="enc-barra-pista"><span style="width: {{ round($cantidad / $maximo * 100, 1) }}%"></span></div>
                </div>
            @endforeach
        </div>
    @endif
</div>
