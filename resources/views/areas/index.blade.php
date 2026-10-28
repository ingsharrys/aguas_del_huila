<x-layouts.app :title="__('Áreas')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">
            <div class="flex w-full justify-between mb-4">
                <h1 class="content-center font-black text-white text-2xl">Listado de Áreas</h1>
                <div class="flex gap-4">
                    <a href="{{ route('usuarios.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
                    <a href="{{ route('areas.create') }}" class="flex px-4 py-2 border-green-700 rounded-lg text-white bg-green-600 items-center justify-center gap-2 hover:bg-green-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg> 
                        Agregar Área
                    </a>
                </div>
            </div>

            <!-- Filtros -->
            <form method="GET" action="{{ route('areas.index') }}" class="mb-6 bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre..." class="border border-gray-300 rounded-lg p-2.5 w-full text-gray-700">
                    
                    <select name="estado" class="border border-gray-300 rounded-lg p-2.5 w-full text-gray-700 bg-white">
                        <option value="">Cualquier Estado</option>
                        <option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    
                    <div class="flex gap-2 items-center">
                        <a href="{{ route('areas.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 w-full text-center font-semibold transition">Limpiar</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2.5 rounded-lg hover:bg-blue-700 w-full flex items-center justify-center gap-2 font-semibold transition">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>

            <!-- Tabla -->
            <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
                <table class="min-w-full text-sm text-left whitespace-nowrap">
                    <thead class="bg-gray-100 text-gray-800">
                        <tr>
                            <th class="px-4 py-3 border-b border-gray-200">Nombre del Área</th>
                            <th class="px-4 py-3 border-b border-gray-200">Área Padre</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-center">Estado</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 bg-white">
                        @forelse($areas as $area)
                            <tr class="hover:bg-blue-50 transition border-b border-gray-100">
                                <td class="px-4 py-3 font-semibold">{{ $area->nombre }}</td>
                                <td class="px-4 py-3">{{ $area->parent->nombre ?? 'Principal' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="px-2.5 py-1 rounded-md text-[11px] font-bold {{ $area->estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $area->estado ? 'ACTIVO' : 'INACTIVO' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center flex justify-center gap-2">
                                    <a href="{{ route('areas.edit', $area) }}" class="p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded transition" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                    </a>
                                    <form action="{{ route('areas.destroy', $area) }}" method="POST" class="inline-block eliminar-registro">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 hover:text-red-800 hover:bg-red-100 rounded transition cursor-pointer" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-8 text-center text-gray-500">No hay áreas registradas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $areas->links() }}</div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.eliminar-registro').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer",
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