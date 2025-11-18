<x-layouts.app :title="__('Servicios')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex w-full justify-between mb-4">
                <h1 class="text-center content-center font-black">Listado de Servicios</h1>
                
                <a href="{{ route('servicios.create') }}" class="flex w-48 px-4 py-2 border-green-700 rounded-lg text-white bg-green-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg> Agregar Servicio</a>
            </div>

            <!-- Filtros -->
            <form method="GET" action="{{ route('servicios.index') }}" class="flex flex-wrap gap-3 mb-4">
                <!-- Filtros de nombre -->
                <input 
                    type="text" 
                    name="buscar" 
                    value="{{ request('buscar') }}" 
                    placeholder="Buscar por nombre..."
                    class="border border-gray-300 rounded-lg p-2 w-2.5/5"
                >

                <button 
                    type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex w-2/5 sm:w-48 text-center justify-center gap-2 cursor-pointer"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg> Buscar
                </button>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-100 text-gray-800">
                        <tr>
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Título</th>
                            <th class="px-4 py-2 border">Icono</th>
                            <th class="px-4 py-2 border">Imagen</th>
                            <th class="px-4 py-2 border">Fecha</th>
                            <th class="px-4 py-2 border text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($servicios as $servicio)
                            <tr class="hover:bg-blue-50 hover:text-gray-900">
                                <td class="px-4 py-2 border">{{ $servicio->id }}</td>
                                <td class="px-4 py-2 border">{{ $servicio->nombre }}</td>
                                <td class="px-4 py-2 border">{{ $servicio->titulo }}</td>
                                <td class="px-4 py-2 border">
                                    @if($servicio->icono)
                                        <img src="{{ asset('storage/' . $servicio->icono) }}" class="h-10 rounded" alt="imagen">
                                    @else
                                        <span class="text-gray-400 italic">Sin icono</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border">
                                    @if($servicio->imagen_portada)
                                        <img src="{{ asset('storage/' . $servicio->imagen_portada) }}" class="h-10 rounded" alt="imagen">
                                    @else
                                        <span class="text-gray-400 italic">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border">{{ $servicio->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 border text-center flex justify-center gap-2">
                                    <a href="/servicios/{{ $servicio->slug }}/{{ $servicio->id }}" target="_blank"
                                    class="p-2 text-yellow-500 hover:text-yellow-700 transition" 
                                    title="Ver">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                    </a>

                                    <a href="{{ route('servicios.edit', $servicio->id) }}" 
                                    class="p-2 text-green-500 hover:text-green-700 transition" 
                                    title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                    </a>

                                    <form 
                                        action="{{ route('servicios.destroy', $servicio->id) }}" 
                                        method="POST" 
                                        class="inline-block eliminar-servicio"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="p-2 text-red-500 hover:text-red-700 transition cursor-pointer"
                                            title="Eliminar"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500 border">No hay servicios registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="mt-3">
                {{ $servicios->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.eliminar-servicio').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará la servicio permanentemente",
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
