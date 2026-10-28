{{-- Pregunta de Sí/No: porcentaje de "Sí" como indicador --}}
@php
    $si = (int) ($datos['Si'] ?? 0);
    $no = (int) ($datos['No'] ?? 0);
    $total = $si + $no;
    $porcentaje = $total ? round($si / $total * 100) : null;
@endphp
<div class="enc-tarjeta">
    <div class="enc-tarjeta-cab">
        <div>
            <h3>{{ $titulo }}</h3>
            <p class="enc-nota">{{ number_format($total, 0, ',', '.') }} {{ $total === 1 ? 'respuesta' : 'respuestas' }}</p>
        </div>
    </div>

    @if($total === 0)
        <p class="enc-vacio">Sin respuestas en este período.</p>
    @else
        <div class="enc-sino">
            <div class="enc-anillo" style="--p: {{ $porcentaje }}" role="img" aria-label="{{ $porcentaje }}% respondió Sí">
                <span>{{ $porcentaje }}%</span>
            </div>
            <ul class="enc-leyenda" style="margin: 0; flex: 1">
                <li><i style="background: var(--pos-2)"></i><span>Sí</span><b>{{ $si }}</b><small>{{ $porcentaje }}%</small></li>
                <li><i style="background: var(--surface-2); outline: 1px solid var(--borde)"></i><span>No</span><b>{{ $no }}</b><small>{{ 100 - $porcentaje }}%</small></li>
            </ul>
        </div>
    @endif
</div>
