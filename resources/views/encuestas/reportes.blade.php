<x-layouts.app :title="__('Generar Reporte de Comunicaciones')">
    <style>
        @media print {
            /* Configuración de la hoja en formato horizontal (Landscape) */
            @page {
                size: letter landscape; /* Cambia 'letter' por 'A4 landscape' si usas tamaño A4 */
                margin: 1cm;
            }

            /* Oculta el resto del sitio web */
            body * {
                visibility: hidden;
            }

            /* Forzar fondo blanco absoluto en el documento */
            html, body {
                background-color: #ffffff !important;
                background: #ffffff !important;
            }

            /* Muestra únicamente el reporte */
            #reporte-container, #reporte-container * {
                visibility: visible;
                padding: 5px;
            }

            /* Ajusta el contenedor para aprovechar todo el ancho horizontal */
            #reporte-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none !important;
                border: none !important;
            }

            /* Mantener los colores exactos de fondo y texto */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            /* Evita que una tabla o sección se corte de forma fea entre hojas */
            .break-inside-avoid {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex flex-wrap w-full justify-between mb-4 gap-4">
                <h1 class="text-center content-center font-black text-white">Generar Reporte de Comunicaciones</h1>
            </div>

            <!-- Filtros -->
            <form action="{{ route('dashboard.comunicaciones.reportes') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-100 px-4 py-2 rounded-md">
                <input type="hidden" name="filtrar" value="1">

                <!-- Radicador -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Radicador</label>
                    <select name="radicador_id" class="w-full border border-gray-300 rounded-lg p-2.5 text-black bg-white">
                        @foreach ($editores as $editor)
                            <option value="{{ $editor->name }}" {{ request('radicador_id') == $editor->id ? 'selected' : '' }}>
                                {{ $editor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Fecha Inicial -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="fecha_inicio">Fecha Inicial</label>
                    <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="w-full border border-gray-300 rounded-lg p-2.5 text-black bg-white">
                </div>

                <!-- Fecha Final -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="fecha_fin">Fecha Final</label>
                    <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="w-full border border-gray-300 rounded-lg p-2.5 text-black bg-white">
                </div>

                <!-- Dependencias (Padres) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Dependencia</label>
                    <select name="dependencia_id" class="w-full border border-gray-300 rounded-lg p-2.5 text-black bg-white">
                        <option value="">Todas las dependencias</option>
                        @foreach ($dependencias as $dep)
                            <option value="{{ $dep->id }}" {{ request('dependencia_id') == $dep->id ? 'selected' : '' }}>
                                {{ $dep->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Grupos (Hijos) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Grupo</label>
                    <select name="grupo_id" class="w-full border border-gray-300 rounded-lg p-2.5 text-black bg-white">
                        <option value="">Todos los grupos</option>
                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}" {{ request('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                {{ $grupo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones de Acción -->
                <div class="md:col-span-3 flex justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('dashboard.comunicaciones.reportes') }}" class="px-4 py-2.5 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                        Limpiar Filtros
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition cursor-pointer">
                        Generar Vista Previa
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto mt-5">
                @if(request()->has('filtrar'))
                    <div class="flex flex-wrap justify-between items-center mb-4 print:hidden">
                        <h3 class="text-lg font-bold text-white">Vista Previa del Reporte</h3>
                        <button onclick="window.print()" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            Descargar / Imprimir PDF
                        </button>
                    </div>

                    <!-- CONTENEDOR DEL REPORTE (PDF / PRINT) -->
                    <div id="reporte-container" class="bg-white p-8 rounded-xl shadow-lg border border-gray-200 print:shadow-none print:border-none print:p-0">
                        
                        <!-- Encabezado del Reporte -->
                        <div class="flex justify-between items-center border-b pb-4 mb-6">
                            <div class="w-1/4">
                                <img src="{{ asset('storage/img/logo/logo-aguas-2026.jpg') }}" alt="Logo Aguas del Huila" class="h-24 object-contain">
                            </div>
                            <div class="w-2/4 text-center">
                                <h1 class="text-xl font-bold text-gray-900 uppercase">Aguas Del Huila S.A. E.S.P.</h1>
                                <h2 class="text-md font-semibold text-gray-700 mt-1">REPORTE COMUNICACIONES DE ENTRADA</h2>
                            </div>
                            <div class="w-1/4 text-right text-xs text-gray-600 space-y-1">
                                <p><strong>Generado:</strong> {{ now()->format('d/m/Y h:i A') }}</p>
                                <p><strong>Radicador:</strong> {{ $radicador }}</p>
                                <p><strong>Desde:</strong> {{ request('fecha_inicio') ?? 'Inicio' }}</p>
                                <p><strong>Hasta:</strong> {{ request('fecha_fin') ?? 'Actualidad' }}</p>
                            </div>
                        </div>

                        <!-- Tablas agrupadas Por Área -->
                        @forelse($reportes as $areaNombre => $items)
                            <div class="mb-8">
                                <h3 class="bg-gray-800 text-white font-bold px-4 py-1.5 text-sm uppercase rounded-t">
                                    Área: {{ $areaNombre ?: 'Sin Área Asignada' }}
                                </h3>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-xs text-left border-collapse border border-gray-300">
                                        <thead>
                                            <tr class="bg-gray-100 text-gray-800 border-b border-gray-300">
                                                <th class="p-2 border border-gray-300">Código Radicado</th>
                                                <th class="p-2 border border-gray-300">Estado</th>
                                                <th class="p-2 border border-gray-300">Tipo Respuesta</th>
                                                <th class="p-2 border border-gray-300">Fecha Ingreso</th>
                                                <th class="p-2 border border-gray-300">Fecha Respuesta</th>
                                                <th class="p-2 border border-gray-300">Asunto</th>
                                                <th class="p-2 border border-gray-300">Asignado A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $item)
                                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                                    <td class="p-2 border border-gray-300 font-semibold text-blue-700">{{ $item->codigo_radicado }}</td>
                                                    <td class="p-2 border border-gray-300">
                                                        @php
                                                            $badgeClasses = match($item->estado) {
                                                                'Respondida' => 'bg-green-100 text-green-800',
                                                                'Asignada'   => 'bg-blue-100 text-blue-800',
                                                                'Cancelada'  => 'bg-red-100 text-red-800',
                                                                default      => 'bg-amber-100 text-amber-800',
                                                            };
                                                        @endphp

                                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $badgeClasses }}">
                                                            {{ $item->estado }}
                                                        </span>
                                                    </td>
                                                    <td class="p-2 border border-gray-300 text-black">{{ $item->tipo_respuesta }}</td>
                                                    <td class="p-2 border border-gray-300 text-black">{{ $item->created_at ? $item->created_at->format('d/m/Y') : 'N/A' }}</td>
                                                    <td class="p-2 border border-gray-300 text-black">{{ $item->fecha_respuesta ? \Carbon\Carbon::parse($item->fecha_respuesta)->format('d/m/Y') : 'Pendiente' }}</td>
                                                    <td class="p-2 border border-gray-300 text-black">{{ $item->asunto }}</td>
                                                    <td class="p-2 border border-gray-300 text-black">{{ $item->usuario->name ?? 'No Asignado' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                No se encontraron comunicaciones que coincidan con los criterios de búsqueda seleccionados.
                            </div>
                        @endforelse

                    </div>
                @endif
            </div>

        </div>
    </div>

</x-layouts.app>
