<x-layouts.app :title="__('Respuestas de la PQR')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex w-full justify-between mb-4">
                <h1 class="text-center content-center font-black text-white">Historial de respuestas asociadas a la solicitud</h1>
                
                <a href="{{ route('dashboard.comunicaciones.pqrsdf') }}" class="flex w-48 px-4 py-2 border-blue-700 rounded-lg text-white bg-blue-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-undo2-icon lucide-undo-2"><path d="M9 14 4 9l5-5"/><path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5a5.5 5.5 0 0 1-5.5 5.5H11"/></svg> Volver</a>
            </div>

            <!-- Información de la PQR -->

            <div class="mb-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

                <div class="mb-5 border-b border-gray-200 pb-4">

                    <h2 class="text-lg font-semibold text-gray-800">
                        Información de la solicitud
                    </h2>

                </div>


                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">

                    <div>

                        <p class="text-xs font-medium uppercase text-gray-500">
                            Código de radicado
                        </p>

                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $pqrsdf->codigo_radicado }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase text-gray-500">
                            Tipo de PQRSF
                        </p>

                        <p class="mt-1 text-gray-800">
                            {{ $pqrsdf->tipo_pqrsf }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase text-gray-500">
                            Estado
                        </p>

                        <span class="mt-1 inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            {{ $pqrsdf->estado }}
                        </span>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase text-gray-500">
                            Asunto
                        </p>

                        <p class="mt-1 text-gray-800">
                            {{ $pqrsdf->asunto }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs font-medium uppercase text-gray-500">
                            Fecha de Creación
                        </p>

                        <p class="mt-1 text-gray-800">
                            {{ $pqrsdf->created_at->format('d/m/Y H:i') }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs font-medium uppercase text-gray-500">
                            Fecha limite de respuesta
                        </p>

                        <p class="mt-1 text-gray-800">
                            {{ $pqrsdf->fecha_limite_respuesta }}
                        </p>

                    </div>

                </div>

            </div>


            <!-- Respuestas -->

            <div class="mb-4 flex items-center justify-between">

                <div>

                    <h2 class="text-xl font-semibold text-white">
                        Historial de respuestas
                    </h2>

                    <p class="text-sm text-gray-200">
                        {{ $pqrsdf->respuestas->count() }}
                        {{ $pqrsdf->respuestas->count() == 1 ? 'respuesta registrada' : 'respuestas registradas' }}
                    </p>

                </div>

            </div>


            @forelse($pqrsdf->respuestas as $respuesta)

                <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                    <!-- Cabecera -->

                    <div class="flex flex-col gap-3 border-b border-gray-200 bg-gray-50 px-6 py-4 md:flex-row md:items-left md:justify-between">

                        <div>

                            <h3 class="font-semibold text-gray-800">
                                {{ $respuesta->titulo_respuesta }}
                            </h3>

                            <p class="mt-1 text-xs text-gray-500">
                                Respuesta #{{ $loop->iteration }}
                            </p>

                        </div>


                        <div class="text-sm text-gray-500">

                            {{ $respuesta->created_at->format('d/m/Y H:i') }}

                        </div>

                    </div>


                    <!-- Información -->

                    <div class="grid grid-cols-1 gap-5 border-b border-gray-200 px-6 py-5 md:grid-cols-3">

                        <div>

                            <p class="text-xs font-medium uppercase text-gray-500">
                                Respondió
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">
                                {{ $respuesta->usuario->name ?? 'Usuario no disponible' }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs font-medium uppercase text-gray-500">
                                Área
                            </p>

                            <p class="mt-1 text-sm text-gray-800">
                                {{ $respuesta->usuario->area->nombre ?? 'Área no asignada' }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs font-medium uppercase text-gray-500">
                                Tipo de respuesta
                            </p>

                            <p class="mt-1 text-sm text-gray-800">
                                {{ $pqrsdf->tipo_respuesta }}
                            </p>

                        </div>

                    </div>


                    <!-- Datos de envío -->

                    @if($pqrsdf->tipo_respuesta == 'Correo Electrónico')

                        <div class="border-b border-gray-200 px-6 py-5">

                            <p class="text-xs font-medium uppercase text-gray-500">
                                Correo de envío
                            </p>

                            <p class="mt-1 text-sm text-gray-800">
                                {{ $respuesta->correo ?? $pqrsdf->correo_electronico }}
                            </p>

                        </div>

                    @elseif(in_array($pqrsdf->tipo_respuesta, ['Físico / Mensajería', 'Correo Certificado']))

                        <div class="grid grid-cols-1 gap-5 border-b border-gray-200 px-6 py-5 md:grid-cols-3">

                            <div>

                                <p class="text-xs font-medium uppercase text-gray-500">
                                    Dirección
                                </p>

                                <p class="mt-1 text-sm text-gray-800">
                                    {{ $respuesta->direccion }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs font-medium uppercase text-gray-500">
                                    Empresa de encomiendas
                                </p>

                                <p class="mt-1 text-sm text-gray-800">
                                    {{ $respuesta->empresa_encomienda }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs font-medium uppercase text-gray-500">
                                    Número de guía
                                </p>

                                <p class="mt-1 text-sm text-gray-800">
                                    {{ $respuesta->numero_guia }}
                                </p>

                            </div>

                        </div>

                    @endif


                    <!-- Texto -->

                    <div class="px-6 py-6">

                        <p class="mb-3 text-xs font-medium uppercase text-gray-500">
                            Respuesta
                        </p>

                        <div class="prose max-w-none text-sm leading-7 text-gray-700">

                            {!! nl2br($respuesta->texto_respuesta) !!}

                        </div>

                    </div>


                    <!-- Documentos -->

                    @if($respuesta->documentos->count())

                        <div class="border-t border-gray-200 bg-gray-50 px-6 py-5">

                            <p class="mb-3 text-xs font-medium uppercase text-gray-500">
                                Documentos adjuntos
                            </p>


                            <div class="space-y-2">

                                @foreach($respuesta->documentos as $documento)

                                    <a
                                        href="{{ asset('storage/' . $documento->ruta) }}"
                                        target="_blank"
                                        class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-3 hover:border-blue-300 hover:bg-blue-50 transition"
                                    >

                                        <div class="flex min-w-0 items-center gap-3">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="20"
                                                height="20"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="shrink-0 text-blue-500"
                                            >
                                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                                                <path d="M14 2v6h6"/>
                                                <path d="M10 13h4"/>
                                                <path d="M10 17h4"/>
                                            </svg>


                                            <div class="min-w-0">

                                                <p class="truncate text-sm font-medium text-gray-700">
                                                    {{ $documento->nombre_original }}
                                                </p>

                                                <p class="text-xs text-gray-400">
                                                    {{ strtoupper($documento->extension) }}
                                                    -
                                                    {{ number_format($documento->tamano / 1024, 2) }} KB
                                                </p>

                                            </div>

                                        </div>


                                        <span class="text-xs font-medium text-blue-600">
                                            Ver
                                        </span>

                                    </a>

                                @endforeach

                            </div>

                        </div>

                    @endif

                    <!-- Correcciones -->
                    @if(!$respuesta->estado)
                        <div class="grid grid-cols-1 gap-5 border-t px-6 py-5 md:grid-cols-3 border-green-700">

                            <div>

                                <p class="text-xs font-medium uppercase text-gray-500">
                                    Revisó
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-800">
                                    {{ $respuesta->revisor->name ?? 'Usuario no disponible' }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs font-medium uppercase text-gray-500">
                                    Fecha de Revisión
                                </p>

                                <p class="mt-1 text-sm text-gray-800">
                                    {{ $respuesta->fecha_revision ? \Carbon\Carbon::parse($respuesta->fecha_revision)->format('d/m/Y h:i A') : 'Sin Fecha' }}
                                </p>

                            </div>


                            <div class="col-span-2">

                                <p class="text-xs font-medium uppercase text-gray-500">
                                    Observaciones
                                </p>

                                <p class="mt-1 text-sm text-gray-800">
                                    {{ $respuesta->observaciones ?? 'Sin Observaciones' }}
                                </p>

                            </div>

                        </div>
                    @elseif($respuesta->estado == 1)
                        @if(auth()->user()->hasAnyRole(['Administrador', 'Editor']) || auth()->user()->es_jefe)
                            <div class="bg-white p-5 rounded-lg shadow border-t border-green-700 mb-6 relative">
                                <!-- 🎯 ACCIONES DEL JEFE (Solo visible si está en Revisión/Pendiente y el usuario es Jefe) -->
                                <div class="mt-6 pt-4 border-t flex gap-3">
                                    <!-- Botón Aprobar -->
                                    <form action="{{ route('dashboard.comunicaciones.pqrsdf.respuestas.aprobar', $respuesta->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                            Aprobar Respuesta
                                        </button>
                                    </form>

                                    <!-- Botón Abrir Modal Devolver -->
                                    <button type="button" onclick="document.getElementById('modalDevolver-{{ $respuesta->id }}').classList.remove('hidden')" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 14 6-6"/><path d="M4 14v4a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-4"/><path d="M9 9l3-3 3 3"/></svg>
                                        Devolver para Corrección
                                    </button>
                                </div>

                                <!-- MODAL DEVOLVER RESPUESTA -->
                                <div id="modalDevolver-{{ $respuesta->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4">
                                    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 relative">
                                        <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4">Devolver Respuesta a Funcionario</h3>

                                        <form action="{{ route('dashboard.comunicaciones.pqrsdf.respuestas.devolver', $respuesta->id) }}" method="POST">
                                            @csrf
                                            
                                            <div class="mb-4">
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Motivo / Correcciones a realizar <span class="text-red-500">*</span></label>
                                                <textarea 
                                                    name="observaciones_revision" 
                                                    rows="4" 
                                                    class="w-full border rounded-lg p-3 text-black text-sm focus:ring-blue-500 focus:border-blue-500" 
                                                    placeholder="Especifique qué debe corregir el funcionario..."
                                                    required
                                                ></textarea>
                                            </div>

                                            <div class="flex justify-end gap-3 pt-3 border-t">
                                                <button type="button" onclick="document.getElementById('modalDevolver-{{ $respuesta->id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition cursor-pointer">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold transition cursor-pointer">
                                                    Confirmar Devolución
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="grid grid-cols-1 gap-5 border-t border-green-700 px-6 py-5 md:grid-cols-3">

                            <div>

                                <p class="text-xs font-medium uppercase text-gray-500">
                                    Aprobó
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-800">
                                    {{ $respuesta->revisor->name ?? 'Usuario no disponible' }}
                                </p>

                            </div>


                            <div>

                                <p class="text-xs font-medium uppercase text-gray-500">
                                    Fecha de Revisión
                                </p>

                                <p class="mt-1 text-sm text-gray-800">
                                    {{ $respuesta->fecha_revision ? \Carbon\Carbon::parse($respuesta->fecha_revision)->format('d/m/Y h:i A') : 'Sin Fecha' }}
                                </p>

                            </div>

                        </div>
                    @endif

                </div>

            @empty

                <div class="rounded-xl border border-gray-200 bg-white p-10 text-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="40"
                        height="40"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="mx-auto mb-3 text-gray-400"
                    >
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>

                    <p class="font-medium text-gray-700">
                        No hay respuestas registradas
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Esta PQR todavía no tiene respuestas.
                    </p>

                </div>

            @endforelse

        </div>
    </div>


</x-layouts.app>
