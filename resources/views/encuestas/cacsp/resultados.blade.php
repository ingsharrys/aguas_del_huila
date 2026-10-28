<x-layouts.app :title="__('Resultados CACSP')">
@include('encuestas.partials.estilos')
@php
    // Colores por posición de la opción
    $coloresEscala = ['var(--pos-2)', 'var(--pos-1)', 'var(--neutro)', 'var(--neg-1)', 'var(--neg-2)', 'var(--ns)']; // 5..1 + No sabe
    $coloresSiNo = ['var(--pos-2)', 'var(--surface-2)'];
    $coloresCategorias = ['var(--cat-1)', 'var(--cat-2)', 'var(--cat-3)', 'var(--ns)'];

    $formatoMinutos = function (?int $m) {
        if ($m === null) return '—';
        if ($m < 60) return $m . ' min';
        if ($m < 1440) return round($m / 60, 1) . ' h';
        return round($m / 1440, 1) . ' días';
    };

    $favorableSinNs = function (array $datos) {
        $valoradas = array_diff_key($datos, array_flip(['No sabe']));
        $total = array_sum($valoradas);
        return $total ? (int) round(array_sum(array_slice($valoradas, 0, 2)) / $total * 100) : null;
    };

    $filtros = array_filter(['periodo' => $periodo, 'municipio' => $municipio]);
    $abierta = false;
@endphp

<div class="enc">
    <div class="enc-cabecera">
        <div>
            <h1 class="enc-titulo">Encuestas</h1>
            <p class="enc-subtitulo">Resultados del cuestionario CACSP · {{ number_format($total, 0, ',', '.') }} {{ $total === 1 ? 'encuesta' : 'encuestas' }}</p>
        </div>
        <div class="enc-acciones">
            <a class="enc-boton" href="{{ route('cuestionario.cacsp') }}" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                Ver formulario
            </a>
            <a class="enc-boton" href="{{ route('dashboard.encuestas.cacsp.exportar', $filtros) }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
                Exportar CSV
            </a>
            <a class="enc-boton primario" href="{{ route('dashboard.encuestas.cacsp.listado', $filtros) }}">Ver respuestas</a>
        </div>
    </div>

    @include('encuestas.partials.tabs', ['activa' => 'cacsp', 'conteos' => ['cacsp' => $total]])

    {{-- Filtros --}}
    <form method="GET" class="enc-filtros">
        <nav class="enc-segmento" aria-label="Período">
            @foreach($periodos as $valor => $etiqueta)
                <a href="{{ route('dashboard.encuestas.cacsp', array_filter(['periodo' => $valor, 'municipio' => $municipio])) }}" @if($periodo === (string) $valor) aria-current="page" @endif>{{ $etiqueta }}</a>
            @endforeach
        </nav>
        <input type="hidden" name="periodo" value="{{ $periodo }}">
        <select name="municipio" onchange="this.form.submit()" aria-label="Municipio">
            <option value="">Todos los municipios</option>
            @foreach($municipios as $id => $nombre)
                <option value="{{ $id }}" @selected($municipio == $id)>{{ $nombre }}</option>
            @endforeach
        </select>
    </form>

    @if($total === 0)
        <div class="enc-tarjeta">
            <p class="enc-vacio">Todavía no hay cuestionarios en este período o municipio. Cuando se diligencien, los resultados aparecerán aquí.</p>
        </div>
    @else
        {{-- Indicadores --}}
        <div class="enc-grid" style="grid-template-columns: repeat(auto-fit, minmax(190px, 1fr))">
            <div class="enc-tarjeta">
                <p class="enc-kpi-etiqueta">Encuestas realizadas</p>
                <p class="enc-kpi-valor">{{ number_format($total, 0, ',', '.') }}</p>
                <div class="enc-kpi-pie"><span>{{ $periodo === 'todo' ? 'Todo el histórico' : 'Últimos ' . $periodos[$periodo] }}</span></div>
            </div>
            @foreach($kpis as $etiqueta => $valor)
                <div class="enc-tarjeta">
                    <p class="enc-kpi-etiqueta">{{ $etiqueta }}</p>
                    <p class="enc-kpi-valor">{{ is_null($valor) ? '—' : $valor . '%' }}</p>
                    <div class="enc-medidor" role="img" aria-label="{{ $etiqueta }}: {{ $valor ?? 0 }}%"><span style="width: {{ $valor ?? 0 }}%"></span></div>
                    <div class="enc-kpi-pie"><span>Muy buena o buena (sin "no sabe")</span></div>
                </div>
            @endforeach
        </div>

        {{-- Perfil de los encuestados --}}
        <section class="enc-seccion">
            <div class="enc-seccion-cab"><h2>Perfil de los encuestados</h2></div>
            <div class="enc-grid">
                @include('encuestas.partials.categorias', ['titulo' => 'Municipio', 'datos' => $generales['municipio']])
                @include('encuestas.partials.categorias', ['titulo' => 'Ubicación', 'datos' => $generales['ubicacion']])
                @include('encuestas.partials.categorias', ['titulo' => 'Estrato', 'datos' => $generales['estrato'], 'ordenar' => false])
                @include('encuestas.partials.categorias', ['titulo' => 'Sector', 'datos' => $generales['sector']])
                @include('encuestas.partials.categorias', ['titulo' => 'Sexo', 'datos' => $generales['sexo']])
            </div>
        </section>

        {{-- Preguntas, en el orden y las secciones del cuestionario --}}
        @foreach($preguntas as $clave => $pregunta)
            @continue(!array_key_exists($clave, $resultados))
            @php $datos = $resultados[$clave]; $tipo = $pregunta['tipo']; @endphp

            @if(isset($pregunta['seccion']))
                @if($abierta)
                        </div>
                    </section>
                @endif
                @php $abierta = true; @endphp
                <section class="enc-seccion">
                    <div class="enc-seccion-cab"><h2>{{ $pregunta['seccion'] }}</h2></div>
                    <div class="enc-grid-2">
            @endif

            @if($tipo === 'matriz')
                @php
                    $opciones = array_values($pregunta['opciones']);
                    $esSiNo = $opciones === ['Sí', 'No'];
                @endphp
                @include('encuestas.partials.matriz', [
                    'titulo' => $pregunta['titulo'],
                    'filas' => $datos,
                    'modo' => !empty($pregunta['escala']) ? 'escala' : ($esSiNo ? 'sino' : 'ninguno'),
                    'colores' => $esSiNo ? $coloresSiNo : (!empty($pregunta['escala']) || $clave === 'P38' ? $coloresEscala : $coloresCategorias),
                ])

            @elseif(in_array($tipo, ['radio', 'select']))
                @if(array_keys($datos) === ['Sí', 'No'])
                    @include('encuestas.partials.sino', ['titulo' => $pregunta['titulo'], 'datos' => ['Si' => $datos['Sí'], 'No' => $datos['No']]])
                @elseif(!empty($pregunta['escala']))
                    @include('encuestas.partials.escala', ['titulo' => $pregunta['titulo'], 'datos' => $datos, 'colores' => $coloresEscala, 'favorable' => $favorableSinNs($datos)])
                @else
                    @include('encuestas.partials.categorias', ['titulo' => $pregunta['titulo'], 'datos' => $datos])
                @endif

            @elseif($tipo === 'checkbox')
                @include('encuestas.partials.categorias', ['titulo' => $pregunta['titulo'], 'datos' => $datos])

            @elseif($tipo === 'duracion')
                <div class="enc-tarjeta">
                    <div class="enc-tarjeta-cab">
                        <div>
                            <h3>{{ $pregunta['titulo'] }}</h3>
                            <p class="enc-nota">{{ $datos['total'] }} {{ $datos['total'] === 1 ? 'respuesta' : 'respuestas' }}</p>
                        </div>
                        <div style="text-align: right">
                            <p class="enc-kpi-valor" style="font-size: 22px; margin: 0">{{ $formatoMinutos($datos['mediana']) }}</p>
                            <p class="enc-nota">mediana</p>
                        </div>
                    </div>
                    @if($datos['total'])
                        @php $maximo = max($datos['rangos']) ?: 1; @endphp
                        <div class="enc-barras">
                            @foreach($datos['rangos'] as $rango => $cantidad)
                                <div class="enc-barra-fila" data-tip="<b>{{ $rango }}</b>{{ $cantidad }} · {{ round($cantidad / $datos['total'] * 100) }}%">
                                    <div class="enc-barra-texto"><span>{{ $rango }}</span><span><b>{{ $cantidad }}</b> · {{ round($cantidad / $datos['total'] * 100) }}%</span></div>
                                    <div class="enc-barra-pista"><span style="width: {{ round($cantidad / $maximo * 100, 1) }}%"></span></div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="enc-vacio">Sin respuestas en este período.</p>
                    @endif
                </div>

            @else
                {{-- Respuestas abiertas --}}
                <div class="enc-tarjeta">
                    <div class="enc-tarjeta-cab">
                        <div>
                            <h3>{{ $pregunta['titulo'] }}</h3>
                            <p class="enc-nota">{{ $datos['total'] }} {{ $datos['total'] === 1 ? 'respuesta' : 'respuestas' }}@if($datos['no_sabe']) · {{ $datos['no_sabe'] }} no sabe / no responde @endif</p>
                        </div>
                    </div>
                    @forelse($datos['ultimas'] as $texto)
                        @if($loop->first)<ul class="enc-comentarios">@endif
                            <li><p>{{ \Illuminate\Support\Str::limit($texto, 240) }}</p></li>
                        @if($loop->last)</ul>@endif
                    @empty
                        <p class="enc-vacio">Sin respuestas en este período.</p>
                    @endforelse
                </div>
            @endif
        @endforeach

        @if($abierta)
                </div>
            </section>
        @endif
    @endif

    <div class="enc-tooltip" id="enc-tooltip" role="tooltip"></div>
</div>

<script>
    (function () {
        const tooltip = document.getElementById('enc-tooltip');
        document.querySelectorAll('.enc [data-tip]').forEach(el => {
            el.addEventListener('mousemove', e => {
                tooltip.innerHTML = el.dataset.tip;
                tooltip.style.opacity = 1;
                tooltip.style.left = Math.min(e.clientX + 14, window.innerWidth - tooltip.offsetWidth - 8) + 'px';
                tooltip.style.top = (e.clientY + 14) + 'px';
            });
            el.addEventListener('mouseleave', () => tooltip.style.opacity = 0);
        });
    })();
</script>
</x-layouts.app>
