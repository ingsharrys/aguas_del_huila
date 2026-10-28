<x-layouts.app :title="__('Respuestas CACSP')">
@include('encuestas.partials.estilos')
@php
    $sexo = ['MASCULINO' => 'M', 'FEMENINO' => 'F', 'PREFIERO_NO_DECIR' => '—'];
    $filtros = array_filter(['periodo' => $periodo, 'municipio' => $municipio, 'buscar' => $buscar]);
@endphp
<div class="enc">
    <div class="enc-cabecera">
        <div>
            <p class="enc-subtitulo" style="margin: 0 0 4px"><a href="{{ route('dashboard.encuestas.cacsp', array_filter(['periodo' => $periodo, 'municipio' => $municipio])) }}" style="color: inherit">Resultados CACSP</a> / Respuestas</p>
            <h1 class="enc-titulo">Respuestas del cuestionario</h1>
            <p class="enc-subtitulo">{{ number_format($cuestionarios->total(), 0, ',', '.') }} cuestionarios</p>
        </div>
        <div class="enc-acciones">
            <a class="enc-boton" href="{{ route('dashboard.encuestas.cacsp.exportar', $filtros) }}">Exportar CSV</a>
        </div>
    </div>

    @if(session('success'))
        <div class="enc-tarjeta" style="border-color: #0ca30c55; color: #8be08b">{{ session('success') }}</div>
    @endif

    <form method="GET" class="enc-filtros">
        <select name="periodo" onchange="this.form.submit()" aria-label="Período">
            @foreach($periodos as $valor => $etiqueta)
                <option value="{{ $valor }}" @selected($periodo === (string) $valor)>{{ $etiqueta }}</option>
            @endforeach
        </select>
        <select name="municipio" onchange="this.form.submit()" aria-label="Municipio">
            <option value="">Todos los municipios</option>
            @foreach($municipios as $id => $nombre)
                <option value="{{ $id }}" @selected($municipio == $id)>{{ $nombre }}</option>
            @endforeach
        </select>
        <input type="search" name="buscar" value="{{ $buscar }}" placeholder="Buscar por nombre, barrio o dirección" style="min-width: 260px">
        <button class="enc-boton" type="submit">Buscar</button>
    </form>

    <div class="enc-tarjeta" style="padding: 0; overflow-x: auto">
        <table class="enc-tabla">
            <thead>
                <tr>
                    <th>Fecha</th><th>Municipio</th><th>Nombre</th><th>Edad</th><th>Sexo</th><th>Estrato</th><th>Ubicación</th><th>Barrio</th><th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($cuestionarios as $c)
                    <tr>
                        <td>{{ optional($c->fecha_encuesta)->format('d/m/Y') }}</td>
                        <td>{{ $c->municipio_nombre ?? '—' }}</td>
                        <td style="color: var(--texto)">{{ $c->nombre }}</td>
                        <td>{{ $c->edad }}</td>
                        <td>{{ $sexo[$c->sexo] ?? '—' }}</td>
                        <td>{{ $c->estrato }}</td>
                        <td>{{ ucfirst(strtolower((string) $c->ubicacion)) }}</td>
                        <td>{{ $c->barrio }}</td>
                        <td><a href="{{ route('dashboard.encuestas.cacsp.ver', $c->id) }}">Ver</a></td>
                    </tr>
                @empty
                    <tr><td colspan="9"><p class="enc-vacio">No hay cuestionarios con estos filtros.</p></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>{{ $cuestionarios->links() }}</div>
</div>
</x-layouts.app>
