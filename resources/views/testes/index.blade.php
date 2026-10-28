<x-layouts.app :title="__('Administración de Tests de Conocimiento')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex flex-wrap w-full justify-between mb-4 gap-4">
                <h1 class="text-center content-center font-black text-white">Listado de tests</h1>
                <div class="flex flex-wrap justify-end mb-4 gap-4">
                    <a href="{{ route('test.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left preview-icon"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
                    <a href="{{ route('testes.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white bg-green-600 hover:bg-green-700 transition-colors shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg> Nuevo Test </a>
                </div>
            </div>

            <!-- Contenedor de Filtros -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
                <form method="GET" action="{{ route('testes.index') }}" class="grid grid-cols-1 sm:grid-cols-5 gap-4 items-end mb-6">

                    <div class="flex flex-col space-y-1">
                        <label for="nombre" class="text-sm font-medium text-gray-700">Buscar test</label>
                        <input type="text" name="nombre" id="nombre" value="{{ request('nombre') }}" placeholder="Buscar por nombre..." class="w-full text-black px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label for="estado" class="text-sm font-medium text-gray-700">Estado</label>
                        <select name="estado" id="estado" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm text-black">
                            <option value="">Todos</option> <option value="Activo" {{ request('estado') === 'Activo' ? 'selected' : '' }}> Activos </option>
                            <option value="Inactivo" {{ request('estado') === 'Inactivo' ? 'selected' : '' }}> Inactivos </option>
                        </select>
                    </div>

                    <div class="flex flex-col space-y-1" title="Filtrar por fecha de Ingreso de la PQR">
                        <label for="fecha_inicio" class="text-sm font-medium text-gray-700">Ingreso Desde</label>
                        <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors">
                    </div>

                    <div class="flex flex-col space-y-1" title="Filtrar por fecha de Ingreso de la PQR">
                        <label for="fecha_fin" class="text-sm font-medium text-gray-700">Ingreso Hasta</label>
                        <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition-colors">
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex gap-2 items-center">
                        <a href="{{ route('testes.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 w-full text-center font-semibold transition">Limpiar</a>
                        
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
                                <th scope="col" class="px-6 py-4 font-semibold">Test</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Preguntas</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Intentos</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Promedio</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Estado</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Fechas</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center sm:sticky sm:right-0 sm:z-10 sm:bg-gray-50">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($tests as $test)
                                <tr class="hover:bg-blue-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded-md text-xs font-medium border border-gray-200">
                                            {{ $test->nombre }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded-md text-xs font-medium border border-gray-200">
                                            {{ $test->preguntas_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $test->intentos_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-semibold text-gray-700">
                                            @if ($test->intentos_count > 0)
                                            <span class="font-bold @if ($test->intentos_avg_porcentaje >= 80) text-green-600 @elseif ($test->intentos_avg_porcentaje >= 60) text-yellow-600 @else text-red-600 @endif">
                                                {{ number_format($test->intentos_avg_porcentaje, 2) }}% 
                                            </span> 
                                            @else 
                                            <span class="text-gray-400"> Sin resultados </span> 
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-500">
                                        @if ($test->estado === 'Activo')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span> Activo
                                            </span> 
                                        @else 
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span> Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-500">
                                        {{ $test->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap sm:sticky sm:right-0 sm:bg-white sm:shadow-md sm:z-10">
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('test.publico', $test->slug) }}" 
                                            class="p-1.5 text-yellow-500 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors" 
                                            title="Ver Test" data-id="{{ $test->id }}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                            </a>
                                            
                                            <a href="{{ route('testes.edit', $test->id) }}"
                                            class="p-1.5 text-green-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors" 
                                            title="Editar Test" data-id="{{ $test->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen preview-icon"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                            </a>
                                            
                                            <a href="{{ route('testes.preguntas.index', $test->id) }}"
                                            class="p-1.5 text-blue-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
                                            title="Ver Preguntas" data-id="{{ $test->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-question-mark preview-icon"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
                                            </a>
                                            
                                            <a href="{{ route('testes.participantes.index', $test->id) }}"
                                            class="p-1.5 text-slate-500 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-colors" 
                                            title="Ver Participantes" data-id="{{ $test->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-group preview-icon"><path d="M17 21a5 5 0 00-10 0"/><path d="M22 10.5a3.5 3.5 0 00-5.507-2.868"/><path d="M7.507 7.632A3.5 3.5 0 002 10.5"/><circle cx="12" cy="13" r="3"/><circle cx="18.5" cy="4.5" r="2.5"/><circle cx="5.5" cy="4.5" r="2.5"/></svg>
                                            </a>

                                            <form action="{{ route('testes.destroy', $test->id) }}" method="POST" class="inline-block eliminar-test">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-1.5 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" 
                                                        title="Eliminar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-gray-400"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
                                            <p class="text-base font-medium text-gray-600">No hay Tests registradas</p>
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
                {{ $tests->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.eliminar-test').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará el Test permanentemente",
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
