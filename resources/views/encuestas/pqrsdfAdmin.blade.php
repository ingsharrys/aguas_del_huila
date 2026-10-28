<x-layouts.app :title="__('Administración de PQRSDF')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex flex-wrap w-full justify-between mb-4 gap-4">
                <h1 class="text-center content-center font-black text-white">Listado de encuestas de PQRSDF</h1>

                <a href="{{ route('dashboard.comunicaciones.pqrsdf.exportar', request()->query()) }}" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-700 transition"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" > <path d="M12 3v12"/> <path d="m7 10 5 5 5-5"/> <path d="M5 21h14"/></svg> Descargar Excel</a>
                
                <a href="{{ route('pqr') }}" class="flex w-48 px-4 py-2 border-green-700 rounded-lg text-white bg-green-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg> Agregar PQRSDF</a>
            </div>

            <!-- Estadísticos -->
            @role('Extranet')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-blue-600">
                    <p class="text-sm font-medium text-gray-500">
                        Bandeja de entrada
                    </p>

                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ $estadisticas['total'] }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-green-500">
                    <p class="text-sm font-medium text-gray-500">
                        Respondidas
                    </p>

                    <p class="text-3xl font-bold text-green-600 mt-1">
                        {{ $estadisticas['respondidas'] }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-orange-500">
                    <p class="text-sm font-medium text-gray-500">
                        Por responder
                    </p>

                    <p class="text-3xl font-bold text-orange-600 mt-1">
                        {{ $estadisticas['por_responder'] }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-orange-500">
                    <p class="text-sm font-medium text-gray-500">
                        En Revisión
                    </p>

                    <p class="text-3xl font-bold text-orange-600 mt-1">
                        {{ $estadisticas['revision'] }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-orange-500">
                    <p class="text-sm font-medium text-gray-500">
                        Por Corregir
                    </p>

                    <p class="text-3xl font-bold text-orange-600 mt-1">
                        {{ $estadisticas['corregir'] }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-purple-500">
                    <p class="text-sm font-medium text-gray-500">
                        Próximas a vencer
                    </p>

                    <p class="text-3xl font-bold text-purple-600 mt-1">
                        {{ $estadisticas['proximas_vencer'] }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-red-500">
                    <p class="text-sm font-medium text-gray-500">
                        Vencidas
                    </p>

                    <p class="text-3xl font-bold text-red-600 mt-1">
                        {{ $estadisticas['vencidas'] }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-red-500">
                    <p class="text-sm font-medium text-gray-500">
                        Canceladas
                    </p>

                    <p class="text-3xl font-bold text-red-600 mt-1">
                        {{ $estadisticas['canceladas'] }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-cyan-500">
                    <p class="text-sm font-medium text-gray-500">
                        Porcentaje de respuesta
                    </p>

                    <p class="text-3xl font-bold text-cyan-600 mt-1">
                        {{ $estadisticas['porcentaje_respuesta'] }}%
                    </p>
                </div>

            </div>
            @endrole

            <!-- Contenedor de Filtros -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
                <form method="GET" action="{{ route('dashboard.comunicaciones.pqrsdf') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4 items-end mb-6">
                    
                    @role('Administrador|Editor')
                    <div class="flex flex-col space-y-1">
                        <label for="area" class="text-sm font-medium text-gray-700">Área</label>
                        <select name="area" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors">
                            <option value="">Todas las áreas</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>
                                    {{ ucfirst($area->nombre) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endrole

                    <div class="flex flex-col space-y-1">
                        <label for="estado" class="text-sm font-medium text-gray-700">Estado</label>
                        <select name="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors">
                            <option value="">Todos los estados</option>
                            <option value="Radicada" {{ request('estado') == 'Radicada' ? 'selected' : '' }}>Radicada</option>
                            <option value="Asignada" {{ request('estado') == 'Asignada' ? 'selected' : '' }}>Asignada</option>
                            <option value="Respondida" {{ request('estado') == 'Respondida' ? 'selected' : '' }}>Respondida</option>
                            <option value="Revisión" {{ request('estado') == 'Revisión' ? 'selected' : '' }}>En Revisión</option>
                            <option value="Corregir" {{ request('estado') == 'Corregir' ? 'selected' : '' }}>Por Corregir</option>
                            <option value="Cancelada" {{ request('estado') == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>

                    <!-- Filtro de Vencimiento -->
                    <div class="flex flex-col space-y-1">
                        <label for="vencimiento" class="text-sm font-medium text-gray-700">Vencimiento</label>
                        <select name="vencimiento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors">
                            <option value="">Cualquier fecha</option>
                            <option value="proximas" {{ request('vencimiento') == 'proximas' ? 'selected' : '' }}>Próximas a vencer</option>
                            <option value="vencidas" {{ request('vencimiento') == 'vencidas' ? 'selected' : '' }}>Ya vencidas</option>
                        </select>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label for="codigo_radicado" class="text-sm font-medium text-gray-700">Código Radicado</label>
                        <input type="text" name="codigo_radicado" value="{{ request('codigo_radicado') }}" placeholder="Ej: PQRSDF2026000001" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors">
                    </div>

                    <div class="flex flex-col space-y-1" title="Filtrar por fecha de Ingreso de la PQR">
                        <label for="fecha_inicio" class="text-sm font-medium text-gray-700">Ingreso Desde</label>
                        <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors">
                    </div>

                    <div class="flex flex-col space-y-1" title="Filtrar por fecha de Ingreso de la PQR">
                        <label for="fecha_fin" class="text-sm font-medium text-gray-700">Ingreso Hasta</label>
                        <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors">
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex gap-2 items-center">
                        <a href="{{ route('dashboard.comunicaciones.pqrsdf') }}" class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 w-full text-center font-semibold transition">Limpiar</a>
                        
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-4 py-2.5 transition-colors shadow-sm focus:ring-4 focus:ring-blue-300 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg> 
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contenedor de la Tabla -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200 tracking-wider">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold">ID</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Área</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Encargado</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Solicitante</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Tipo</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Estado</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Radicado</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Fechas</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center sm:sticky sm:right-0 sm:z-10 sm:bg-gray-50">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($pqrsdf as $pqr)
                                <tr class="hover:bg-blue-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">#{{ $pqr->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded-md text-xs font-medium border border-gray-200">
                                            {{ $pqr->area->nombre ?? 'No asignada' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded-md text-xs font-medium border border-gray-200">
                                            {{ $pqr->usuario->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">
                                            @if($pqr->identificado_anonimo == 'identificado')
                                                {{ $pqr->nombre_usuario }} {{ $pqr->apellido_usuario }} 
                                            @else
                                                <span class="italic text-gray-500">Anónimo</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $pqr->tipo_pqrsf }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-semibold text-gray-700">{{ $pqr->estado }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-500">
                                        {{ $pqr->codigo_radicado }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col space-y-1">
                                            <span class="text-xs text-black" title="Fecha de recibida">
                                                <svg class="inline w-3 h-3 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                                {{ \Carbon\Carbon::parse($pqr->created_at)->format('d/m/Y') }}
                                            </span>
                                            
                                            @if (!$pqr->fecha_limite_respuesta)
                                                <span class="text-xs text-gray-400">Sin límite establecido</span>
                                            @elseif ($pqr->estado === 'Respondida')
                                                <span class="text-xs text-green-600 font-medium">✓ {{ \Carbon\Carbon::parse($pqr->fecha_limite_respuesta)->format('d/m/Y') }}</span>
                                            @elseif (now()->diffInDays($pqr->fecha_limite_respuesta, false) < 3)
                                                <span class="text-xs text-red-600 font-medium">⚠ {{ \Carbon\Carbon::parse($pqr->fecha_limite_respuesta)->format('d/m/Y') }}</span>
                                            @elseif (now()->diffInDays($pqr->fecha_limite_respuesta, false) < 7)
                                                <span class="text-xs text-yellow-600 font-medium">⚠ {{ \Carbon\Carbon::parse($pqr->fecha_limite_respuesta)->format('d/m/Y') }}</span>
                                            @else
                                                <span class="text-xs text-gray-600">Límite: {{ \Carbon\Carbon::parse($pqr->fecha_limite_respuesta)->format('d/m/Y') }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap sm:sticky sm:right-0 sm:bg-white sm:shadow-md sm:z-10">
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('dashboard.comunicaciones.pqrsdf.show', $pqr->id) }}" 
                                            class="p-1.5 text-yellow-500 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors" 
                                            title="Ver Detalle" data-id="{{ $pqr->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                            </a>
                                            
                                            @if($pqr->estado == 'Respondida' || $pqr->estado == 'Revisión' || $pqr->estado == 'Corregir')
                                                <a href="{{ route('dashboard.comunicaciones.pqrsdf.respuestas', $pqr->id) }}" 
                                                class="p-1.5 text-blue-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors" 
                                                title="Ver Respuestas">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 14a2 2 0 0 0 2-2V8h-2"/><path d="M22 17a2 2 0 0 1-2 2H6.828a2 2 0 0 0-1.414.586l-2.202 2.202A.71.71 0 0 1 2 21.286V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2z"/><path d="M8 14a2 2 0 0 0 2-2V8H8"/></svg>
                                                </a>
                                            @endif
                                            
                                            @role('Administrador')
                                            <form action="{{ route('dashboard.comunicaciones.pqrsdf.destroy', $pqr->id) }}" method="POST" class="inline-block eliminar-pqrsdf">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-1.5 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" 
                                                        title="Eliminar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                </button>
                                            </form>
                                            @endrole
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-gray-400"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
                                            <p class="text-base font-medium text-gray-600">No hay PQRSDF registradas</p>
                                            <p class="text-sm">Ajusta los filtros o espera a que ingresen nuevas solicitudes.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Paginación --}}
            <div class="mt-3">
                {{ $pqrsdf->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.eliminar-pqrsdf').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará el PQRSDF permanentemente",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
        </script>

</x-layouts.app>
