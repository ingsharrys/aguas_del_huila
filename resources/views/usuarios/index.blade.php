<x-layouts.app :title="__('Usuarios')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex w-full justify-between mb-4">
                <h1 class="text-center content-center font-black text-white">Listado de Usuarios</h1>
                
                <a href="{{ route('usuarios.create') }}" class="flex w-56 px-4 py-2 border-green-700 rounded-lg text-white bg-green-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg> Agregar Usuario</a>
            </div>

            <!-- Formulario de Filtros -->
            <form method="GET" action="{{ route('usuarios.index') }}" class="mb-6 bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                    
                    <!-- Nombre -->
                    <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre..." class="border border-gray-300 rounded-lg p-2.5 w-full text-gray-700">
                    
                    <!-- Correo -->
                    <input type="text" name="buscar_correo" value="{{ request('buscar_correo') }}" placeholder="Buscar por correo..." class="border border-gray-300 rounded-lg p-2.5 w-full text-gray-700">
                    
                    <!-- Área -->
                    <select name="area_id" class="border border-gray-300 rounded-lg p-2.5 w-full text-gray-700 bg-white">
                        <option value="">Todas las Áreas</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>{{ $area->nombre }}</option>
                        @endforeach
                    </select>
                    
                    <!-- Cargo -->
                    <select name="cargo_id" class="border border-gray-300 rounded-lg p-2.5 w-full text-gray-700 bg-white">
                        <option value="">Todos los Cargos</option>
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo->id }}" {{ request('cargo_id') == $cargo->id ? 'selected' : '' }}>{{ $cargo->nombre }}</option>
                        @endforeach
                    </select>

                    <!-- Jefe -->
                    <select name="es_jefe" class="border border-gray-300 rounded-lg p-2.5 w-full text-gray-700 bg-white">
                        <option value="">¿Es Jefe? (Todos)</option>
                        <option value="1" {{ request('es_jefe') === '1' ? 'selected' : '' }}>Sí, es Jefe</option>
                        <option value="0" {{ request('es_jefe') === '0' ? 'selected' : '' }}>No</option>
                    </select>

                    <!-- Vinculación -->
                    <select name="tipo_vinculacion" class="border border-gray-300 rounded-lg p-2.5 w-full text-gray-700 bg-white">
                        <option value="">Tipo de Vinculación (Todas)</option>
                        <option value="Contratista" {{ request('tipo_vinculacion') == 'Contratista' ? 'selected' : '' }}>Contratista</option>
                        <option value="Periodo Fijo / Libre Nombramiento" {{ request('tipo_vinculacion') == 'Periodo Fijo / Libre Nombramiento' ? 'selected' : '' }}>Periodo Fijo / Libre Nombramiento</option>
                        <option value="Planta" {{ request('tipo_vinculacion') == 'Planta' ? 'selected' : '' }}>Planta</option>
                    </select>

                    <!-- Estado -->
                    <select name="estado" class="border border-gray-300 rounded-lg p-2.5 w-full text-gray-700 bg-white">
                        <option value="">Cualquier Estado</option>
                        <option value="Activado" {{ request('estado') == 'Activado' ? 'selected' : '' }}>Activado</option>
                        <option value="Desactivado" {{ request('estado') == 'Desactivado' ? 'selected' : '' }}>Desactivado</option>
                    </select>
                    
                    <!-- Botones de Acción -->
                    <div class="flex gap-2 items-center">
                        <a href="{{ route('usuarios.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 w-full text-center font-semibold transition">Limpiar</a>
                        
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2.5 rounded-lg hover:bg-blue-700 w-full flex items-center justify-center gap-2 font-semibold transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg> Buscar
                        </button>
                    </div>
                </div>
            </form>

            <!-- Tabla de Resultados -->
            <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
                <table class="min-w-full text-sm text-left whitespace-nowrap">
                    <thead class="bg-gray-100 text-gray-800">
                        <tr>
                            <th class="px-4 py-3 border-b border-gray-200">Nombre</th>
                            <th class="px-4 py-3 border-b border-gray-200">Correo</th>
                            <th class="px-4 py-3 border-b border-gray-200">Rol</th>
                            <th class="px-4 py-3 border-b border-gray-200">Área</th>
                            <th class="px-4 py-3 border-b border-gray-200">Cargo</th>
                            <th class="px-4 py-3 border-b border-gray-200">Vinculación</th>
                            <th class="px-4 py-3 border-b border-gray-200">Término</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-center">Estado</th>
                            <th class="px-4 py-3 border-b border-gray-200 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 bg-white">
                        @forelse($usuarios as $usuario)
                            <tr class="hover:bg-blue-50 transition border-b border-gray-100">
                                <td class="px-4 py-3">{{ $usuario->name }}</td>
                                <td class="px-4 py-3">{{ $usuario->email }}</td>
                                <td class="px-4 py-3 font-semibold">{{ $usuario->roles->pluck('name')->first() ?? 'Sin rol' }}</td>
                                
                                <td class="px-4 py-3">
                                    {{ $usuario->area->nombre ?? 'Sin área' }}
                                    @if($usuario->es_jefe)
                                        <span class="ml-1 px-1.5 py-0.5 text-[10px] bg-amber-100 text-amber-800 font-bold rounded">JEFE</span>
                                    @endif
                                </td>
                                
                                <td class="px-4 py-3">{{ $usuario->cargo->nombre ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $usuario->tipo_vinculacion ?? 'N/A' }}</td>
                                
                                <td class="px-4 py-3 text-gray-500">
                                    {{ $usuario->fecha_terminacion ? \Carbon\Carbon::parse($usuario->fecha_terminacion)->format('d/m/Y') : 'Indefinido' }}
                                </td>
                                
                                <td class="px-4 py-3 text-center">
                                    <span class="px-2.5 py-1 rounded-md text-[11px] font-bold {{ $usuario->estado == 'Activado' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ strtoupper($usuario->estado) }}
                                    </span>
                                </td>
                                
                                <td class="px-4 py-3 text-center flex justify-center gap-2">
                                    @if($usuario->id != 1 || auth()->user()->area_id == 22)
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded transition" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                        </a>
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-600 hover:text-red-800 hover:bg-red-100 rounded transition cursor-pointer" title="Eliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                            </button>
                                        </form>
                                    @else
                                        <a href="#" class="p-1.5 text-gray-400 cursor-not-allowed" title="No modificable">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-8 text-center text-gray-500">No se encontraron usuarios que coincidan con los filtros.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.eliminar-usuario').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará la usuario permanentemente",
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
