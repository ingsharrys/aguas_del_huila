<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Cartelera Virtual</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Cartelera Virtual</h2>
                <p class="text-lg">
                    <a href="/" class="hover:text-[#00C81F]">Inicio</a> /
                    <a href="{{ route('participa') }}" class="hover:text-[#00C81F]">Participa</a> /
                    <a href="{{ route('pqr') }}" class="hover:text-[#00C81F]">PQRSDF</a> /
                    <span class="font-bold">Cartelera Virtual</span>
                </p>
            </div>
        </div>
        
        <div class="px-2 lg:px-32 py-10">
            <div class="max-w-7xl mx-auto">

                <div class="text-center">
                    <p class="text-black font-medium text-2xl mb-2">
                        ¿Cómo consultar la respuesta a su solicitud PQRSDF?
                    </p>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded-r-lg max-w-3xl mx-auto text-left">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-800">
                                <strong>Publicación de respuestas:</strong> Una vez resuelta su solicitud (PQRSDF), la respuesta estará disponible en la Cartelera Virtual durante <strong>5 días hábiles</strong>. Tras este periodo, podrá consultar la respuesta a su solicitud PQRSDF a través del módulo <a href="{{ route('pqr') }}" class="text-green-700 font-semibold hover:underline">de búsqueda</a>.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <form action="{{ route('carteleravirtual') }}" method="GET"
                        class="mx-auto flex w-full max-w-2xl flex-col gap-3 sm:flex-row">

                        <div class="relative flex-1">
                            <input
                                type="text"
                                name="codigo_radicado"
                                value="{{ $codigo }}"
                                placeholder="Ingrese el código de radicado"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 pr-10 focus:border-[#0047DC] text-black focus:outline-none focus:ring-2 focus:ring-blue-100"
                                aria-label="Buscar por código de radicado"
                            >

                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m21 21-4.35-4.35m1.85-5.15a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                </svg>
                            </span>
                        </div>

                        <button
                            type="submit"
                            class="rounded-lg bg-[#0047DC] px-6 py-3 font-semibold text-white transition hover:bg-blue-800 cursor-pointer">
                            Buscar
                        </button>

                        @if ($codigo !== '')
                            <a
                                href="{{ route('carteleravirtual') }}"
                                class="rounded-lg border border-gray-300 px-6 py-3 text-center font-semibold text-gray-700 transition hover:bg-gray-100">
                                Limpiar
                            </a>
                        @endif
                    </form>
                </div>

                @if ($pqrs->isEmpty())
                    <div class="rounded-xl border border-blue-200 bg-blue-50 p-6 text-center">
                        @if ($codigo !== '')
                            <p class="font-semibold text-gray-800">
                                No se encontraron resultados para el código
                                "{{ $codigo }}".
                            </p>
                            <p class="mt-2 text-sm text-gray-600">
                                Verifique el código de radicado o intente nuevamente.
                            </p>
                        @else
                            <p class="text-gray-700">
                                Actualmente no hay solicitudes disponibles en la Cartelera Virtual.
                            </p>
                        @endif
                    </div>
                @else
                    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="bg-[#0047DC] text-white uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-4">Código de radicado</th>
                                    <th class="px-6 py-4">Tipo de solicitud</th>
                                    <th class="px-6 py-4">Fecha de radicación</th>
                                    <th class="px-6 py-4">Fecha de respuesta</th>
                                    <th class="px-6 py-4">Estado</th>
                                    <th class="px-6 py-4 text-center">Acción</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($pqrs as $item)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-semibold text-[#0047DC]">
                                            {{ $item->codigo_radicado }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $item->tipo_pqrsf ?? 'Sin Tipo' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $item->created_at?->format('d/m/Y') ?? 'No disponible' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $item->fecha_respuesta ?? 'Sin respuesta' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            @if ($item->estado === 'Respondida')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span> Respondida
                                                </span> 
                                            @elseif ($item->estado === 'Radicada')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-1.5"></span> Radicada
                                                </span> 
                                            @elseif ($item->estado === 'Asignada')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5"></span> Asignada
                                                </span> 
                                            @elseif ($item->estado === 'Revisión')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500 mr-1.5"></span> En Revisión
                                                </span> 
                                            @elseif ($item->estado === 'Cancelada')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span> Cancelada
                                                </span> 
                                            @else 
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span> Pendiente
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <button
                                                type="button"
                                                data-url="{{ route('carteleravirtual.respuesta', ['codigo' => $item->codigo_radicado]) }}"
                                                onclick="consultarRespuesta(this.dataset.url)"
                                                class="inline-block rounded-lg bg-[#0047DC] px-4 py-2 font-semibold text-white transition hover:bg-blue-800 cursor-pointer">
                                                Consultar respuesta
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $pqrs->links() }}
                    </div>
                @endif

            </div>
        </div>

        <!-- Modal para mostrar la respuesta de la PQR -->
        <div id="modalRespuesta"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4">

            <div class="w-full max-w-3xl max-h-[90vh] overflow-y-auto rounded-2xl bg-white shadow-2xl">

                <div class="flex items-center justify-between border-b p-5">
                    <h2 class="text-xl font-bold text-[#0047DC]">
                        Respuesta de la PQRSDF
                    </h2>

                    <button type="button"
                            onclick="cerrarModalRespuesta()"
                            class="text-3xl text-gray-500 hover:text-gray-800"
                            aria-label="Cerrar modal">
                        &times;
                    </button>
                </div>

                <div class="p-6">
                    
                    <div id="respuestaEstado" class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5 rounded-lg border p-4" role="status" aria-live="polite">
                        <div class="flex flex-wrap gap-2">
                            <p class="text-sm text-gray-500">Código de radicado: </p>
                            <p id="respuestaCodigo" class="font-bold text-[#0047DC]"></p>
                        </div>

                        <p id="respuestaEstadoTitulo" class="font-semibold"></p>
                        <p id="respuestaEstadoMensaje" class="text-sm"></p>
                    </div>

                    <div id="contenidoRespuesta" class="hidden">
                        <h3 id="respuestaTitulo"
                            class="mb-3 text-md sm:text-xl font-semibold text-gray-800"></h3>

                        <div id="respuestaTexto" class="mb-6 max-h-[300px] overflow-y-auto whitespace-normal break-words rounded-lg border border-gray-200 bg-gray-50 p-4 text-gray-700"></div>

                        <div id="respuestaDocumentos" class="hidden border-t pt-5">
                            <h3 class="mb-3 font-semibold text-gray-800">
                                Documentos adjuntos
                            </h3>

                            <ul id="listaDocumentos" class="space-y-3"></ul>
                        </div>

                        <p id="respuestaCargando" class="hidden text-center text-gray-500">
                            Cargando respuesta...
                        </p>

                        <p id="respuestaError" class="hidden rounded-lg bg-red-50 p-4 text-red-700"></p>
                    </div>
                </div>

                <div class="flex justify-end border-t p-5">
                    <button type="button"
                            onclick="cerrarModalRespuesta()"
                            class="rounded-lg bg-[#0047DC] px-5 py-2 font-semibold text-white hover:bg-blue-800 cursor-pointer">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>

        @include('partials.footer')

        <!-- Modal de respuesta -->
        <script>
            const modalRespuesta = document.getElementById('modalRespuesta');

            function cerrarModalRespuesta() {
                modalRespuesta.classList.add('hidden');
                modalRespuesta.classList.remove('flex');
            }

            async function consultarRespuesta(url) {
                const codigo = document.getElementById('respuestaCodigo');
                const estado = document.getElementById('respuestaEstado');
                const estadoTitulo = document.getElementById('respuestaEstadoTitulo');
                const estadoMensaje = document.getElementById('respuestaEstadoMensaje');
                const contenido = document.getElementById('contenidoRespuesta');
                const titulo = document.getElementById('respuestaTitulo');
                const texto = document.getElementById('respuestaTexto');
                const documentos = document.getElementById('respuestaDocumentos');
                const lista = document.getElementById('listaDocumentos');
                const cargando = document.getElementById('respuestaCargando');
                const error = document.getElementById('respuestaError');

                codigo.textContent = '';
                estadoTitulo.textContent = '';
                estadoMensaje.textContent = '';
                titulo.textContent = '';
                texto.replaceChildren();
                lista.replaceChildren();

                estado.classList.add('hidden');
                contenido.classList.add('hidden');
                documentos.classList.add('hidden');
                error.classList.add('hidden');
                cargando.classList.remove('hidden');

                modalRespuesta.classList.remove('hidden');
                modalRespuesta.classList.add('flex');

                try {
                    const response = await fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(
                            data.message || 'No fue posible consultar la solicitud.'
                        );
                    }

                    codigo.textContent = data.codigo_radicado || '';

                    if (data.disponible !== true) {
                        estado.classList.remove('hidden');
                        estadoTitulo.textContent = 'Estado: ' + (data.estado || 'Pendiente');
                        estadoMensaje.textContent = data.mensaje || 'Su solicitud se encuentra pendiente de gestión.';

                        estado.classList.remove(
                            'border-green-200',
                            'bg-green-50',
                            'text-green-800'
                        );
                        estado.classList.add(
                            'border-blue-200',
                            'bg-blue-50',
                            'text-blue-800'
                        );

                        return;
                    }

                    estado.classList.remove('hidden');
                    estado.classList.remove(
                        'border-blue-200',
                        'bg-blue-50',
                        'text-blue-800'
                    );
                    estado.classList.add(
                        'border-green-200',
                        'bg-green-50',
                        'text-green-800'
                    );

                    estadoTitulo.textContent = 'Estado: Respondida';
                    estadoMensaje.textContent = 'La respuesta a su solicitud está disponible.';

                    titulo.textContent = data.titulo || 'Respuesta a la solicitud';

                    // El contenido contiene HTML; debe sanitizarse en el servidor
                    // antes de insertarlo si no se garantiza que sea confiable.
                    texto.innerHTML = data.texto || 'No hay texto disponible.';

                    if (Array.isArray(data.documentos) && data.documentos.length > 0) {
                        data.documentos.forEach(documento => {
                            const li = document.createElement('li');
                            li.className = 'flex items-center justify-between gap-4 rounded-lg border p-3';

                            const nombre = document.createElement('span');
                            nombre.className = 'break-all text-sm text-gray-700';
                            nombre.textContent = documento.nombre_original || 'Documento adjunto';

                            const enlace = document.createElement('a');
                            enlace.href = "{{ asset('storage/') }}" + "/" + documento.ruta;
                            enlace.target = '_blank';
                            enlace.rel = 'noopener noreferrer';
                            enlace.textContent = 'Ver documento';
                            enlace.className = 'shrink-0 text-sm font-semibold text-[#0047DC] hover:underline';

                            li.append(nombre, enlace);
                            lista.appendChild(li);
                        });

                        documentos.classList.remove('hidden');
                    }

                    contenido.classList.remove('hidden');

                } catch (e) {
                    error.textContent = e.message || 'Ocurrió un error al consultar la solicitud.';
                    error.classList.remove('hidden');
                } finally {
                    cargando.classList.add('hidden');
                }
            }

            modalRespuesta.addEventListener('click', function (event) {
                if (event.target === modalRespuesta) {
                    cerrarModalRespuesta();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    cerrarModalRespuesta();
                }
            });
        </script>

    </body>
</html>
