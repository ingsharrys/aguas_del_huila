{{-- Pregunta con escala ordenada (de mejor a peor): barra apilada al 100 % + leyenda con cantidades --}}
@php
    $total = array_sum($datos);
    $favorable = $total ? round(array_sum(array_slice($datos, 0, max(1, intdiv(count($datos), 2)))) / $total * 100) : null;
@endphp
<div class="enc-tarjeta">
    <div class="enc-tarjeta-cab">
        <div>
            <h3>{{ $titulo }}</h3>
            <p class="enc-nota">{{ number_format($total, 0, ',', '.') }} {{ $total === 1 ? 'respuesta' : 'respuestas' }}</p>
        </div>
        @if(!is_null($favorable))
            <div style="text-align: right">
                <p class="enc-kpi-valor" style="font-size: 22px; margin: 0">{{ $favorable }}%</p>
                <p class="enc-nota">favorable</p>
            </div>
        @endif
    </div>

    @if($total === 0)
        <p class="enc-vacio">Sin respuestas en este período.</p>
    @else
        <div class="enc-apilada" role="img" aria-label="{{ $titulo }}: {{ collect($datos)->map(fn ($v, $k) => "$k $v")->implode(', ') }}">
            @foreach($datos as $opcion => $cantidad)
                @if($cantidad > 0)
                    <div style="flex: {{ $cantidad }}; background: {{ $colores[$loop->index] ?? 'var(--neutro)' }}"
                         data-tip="<b>{{ e($opcion) }}</b>{{ $cantidad }} {{ $cantidad === 1 ? 'respuesta' : 'respuestas' }} · {{ round($cantidad / $total * 100) }}%"></div>
                @endif
            @endforeach
        </div>
    @endif

    <ul class="enc-leyenda">
        @foreach($datos as $opcion => $cantidad)
            <li>
                <i style="background: {{ $colores[$loop->index] ?? 'var(--neutro)' }}"></i>
                <span>{{ $opcion }}</span>
                <b>{{ $cantidad }}</b>
                <small>{{ $total ? round($cantidad / $total * 100) : 0 }}%</small>
            </li>
        @endforeach
    </ul>
</div>
