<x-layouts.app :title="__('Administración de Participantes')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex flex-wrap w-full justify-between mb-4 gap-4">
                <h1 class="text-center content-center font-black text-white">Listado de participantes</h1>
                <a href="{{ route('testes.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left preview-icon"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
            </div>

            <!-- Contenedor de Filtros -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
                <form method="GET" action="{{ route('testes.participantes.index', $teste) }}" class="grid grid-cols-1 sm:grid-cols-5 gap-4 items-end mb-6">

                    <div class="flex flex-col space-y-1">
                        <label for="nombre" class="text-sm font-medium text-gray-700">Nombre del Participante</label>
                        <input type="text" name="nombre" id="nombre" value="{{ request('nombre') }}" placeholder="Buscar por nombre..." class="w-full text-black px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label for="calificacion" class="text-sm font-medium text-gray-700">Calificación</label>
                        <select name="calificacion" id="calificacion"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-black">

                            <option value="">Todos</option>

                            <option value="Aprobados"
                                {{ request('calificacion') === 'Aprobados' ? 'selected' : '' }}>
                                Aprobados
                            </option>

                            <option value="Desaprobados"
                                {{ request('calificacion') === 'Desaprobados' ? 'selected' : '' }}>
                                Desaprobados
                            </option>

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
                        <a href="{{ route('testes.participantes.index', $teste) }}" class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 w-full text-center font-semibold transition">Limpiar</a>
                        
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-4 py-2.5 transition-colors shadow-sm focus:ring-4 focus:ring-blue-300 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg> 
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contenedor de la Tabla -->
             {{-- Mensajes --}}
            @if(session('success'))

                <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">
                    {{ session('success') }}
                </div>

            @endif
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">

                        <thead class="bg-gray-50 border-b border-gray-200">

                            <tr>

                                <th class="px-4 py-3 text-left font-semibold text-gray-700">
                                    Nombre
                                </th>

                                <th class="px-4 py-3 text-left font-semibold text-gray-700">
                                    Municipio
                                </th>

                                <th class="px-4 py-3 text-left font-semibold text-gray-700">
                                    Test
                                </th>

                                <th class="px-4 py-3 text-center font-semibold text-gray-700">
                                    Preguntas
                                </th>

                                <th class="px-4 py-3 text-center font-semibold text-gray-700">
                                    Calificación
                                </th>

                                <th class="px-4 py-3 text-left font-semibold text-gray-700">
                                    Fecha de presentación
                                </th>

                                <th class="px-4 py-3 text-center font-semibold text-gray-700">
                                    Acción
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($participantes as $participante)

                                <tr class="hover:bg-gray-50 transition-colors">

                                    {{-- Nombre --}}
                                    <td class="px-4 py-3 text-gray-800 font-medium">
                                        {{ $participante->nombre }}
                                    </td>

                                    {{-- Municipio --}}
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $participante->municipio->nombre ?? '—' }}
                                    </td>

                                    {{-- Test --}}
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $teste->nombre }}
                                    </td>

                                    {{-- Preguntas --}}
                                    <td class="px-4 py-3 text-center text-gray-700">

                                        <span class="font-semibold">
                                            {{ $participante->respuestas_correctas }}
                                        </span>

                                        <span class="text-gray-400">
                                            /
                                        </span>

                                        <span>
                                            {{ $participante->total_preguntas }}
                                        </span>

                                    </td>

                                    {{-- Calificación --}}
                                    <td class="px-4 py-3 text-center">

                                        <span
                                            class="inline-flex items-center px-2.5 py-1
                                                rounded-full text-xs font-semibold
                                                {{ $participante->porcentaje >= 60
                                                    ? 'bg-green-100 text-green-700'
                                                    : 'bg-yellow-100 text-yellow-700' }}"
                                        >
                                            {{ number_format($participante->porcentaje, 0) }}%
                                        </span>

                                    </td>

                                    {{-- Fecha --}}
                                    <td class="px-4 py-3 text-gray-600 whitespace-nowrap">

                                        {{ $participante->created_at?->format('d/m/Y H:i') }}

                                    </td>

                                    {{-- Acción --}}
                                    <td class="px-4 py-3 text-center">

                                        <form action="{{ route('testes.participantes.destroy', ['teste' => $teste->id,'intento' => $participante->id,]) }}" method="POST" class="inline-block eliminar-test">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-1.5 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" 
                                                    title="Eliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                            </button>
                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="px-6 py-12 text-center text-gray-500"
                                    >
                                        Este test todavía no tiene participantes.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>
            </div>

            {{-- Paginación --}}
            @if($participantes->hasPages())

                <div class="px-4 py-4 border-t border-gray-200">
                    {{ $participantes->links() }}
                </div>

            @endif
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
