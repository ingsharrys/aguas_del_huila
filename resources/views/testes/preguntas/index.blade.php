<x-layouts.app :title="__('Administración de Preguntas del Test')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex flex-wrap w-full justify-between mb-4 gap-4">
                <h1 class="text-center content-center font-black text-white">Listado de preguntas</h1>
                <div class="flex flex-wrap justify-end mb-4 gap-4">
                    <a href="{{ route('testes.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left preview-icon"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
                    <a href="{{ route('testes.preguntas.create', $teste->id) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white bg-green-600 hover:bg-green-700 transition-colors shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg> Nueva Pregunta </a>
                </div>
            </div>

            <!-- informacion del pregunta -->
             <div class="bg-white rounded-xl shadow-lg p-5 mb-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-medium"> Test </p>
                        <h2 class="text-lg font-bold text-gray-800 mt-1"> {{ $teste->nombre }} </h2> 
                        @if ($teste->descripcion) 
                            <p class="text-sm text-gray-500 mt-1"> {{ $teste->descripcion }} </p> 
                        @endif 
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-center">
                            <p class="text-xs text-gray-500"> Preguntas </p>
                            <p class="text-xl font-bold text-gray-800"> {{ $teste->preguntas()->count() }} </p>
                        </div>
                        <div class="h-8 w-px bg-gray-200"></div>
                        <div class="text-center"> 
                            <p class="text-xs text-gray-500"> Estado </p> 
                            @if ($teste->estado === 'Activo')
                                <span class="inline-flex items-center px-2.5 py-1 mt-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span> Activo
                                </span> 
                            @else 
                                <span class="inline-flex items-center px-2.5 py-1 mt-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span> Inactivo
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenedor de Filtros -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
                <form method="GET" action="{{ route('testes.preguntas.index', $teste->id) }}" class="grid grid-cols-1 sm:grid-cols-5 gap-4 items-end mb-6">

                    <div class="flex flex-col space-y-1">
                        <label for="nombre" class="text-sm font-medium text-gray-700">Buscar pregunta</label>
                        <input type="text" name="nombre" id="nombre" value="{{ request('nombre') }}" placeholder="Buscar por nombre..." class="w-full text-black px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label for="estado" class="text-sm font-medium text-gray-700">Estado</label>
                        <select name="estado" id="estado" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm text-black">
                            <option value="">Todos</option> <option value="Activo" {{ request('estado') === 'Activo' ? 'selected' : '' }}> Activos </option>
                            <option value="Inactivo" {{ request('estado') === 'Inactivo' ? 'selected' : '' }}> Inactivos </option>
                        </select>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex gap-2 items-center">
                        <a href="{{ route('testes.preguntas.index', $teste->id) }}" class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 w-full text-center font-semibold transition">Limpiar</a>
                        
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-4 py-2.5 transition-colors shadow-sm focus:ring-4 focus:ring-blue-300 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg> 
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Mensajes -->
            @if (session('success'))

                <div class="mb-5 flex items-center gap-3 p-4 rounded-lg
                            bg-green-50 border border-green-200 text-green-800">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M20 6 9 17l-5-5"/></svg>

                    <span class="text-sm">
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            @if (session('error'))

                <div class="mb-5 flex items-center gap-3 p-4 rounded-lg
                            bg-red-50 border border-red-200 text-red-800">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"/> <line x1="12" x2="12" y1="8" y2="12"/> <line x1="12" x2="12.01" y1="16" y2="16"/></svg>

                    <span class="text-sm">
                        {{ session('error') }}
                    </span>

                </div>

            @endif

            <!-- Contenedor de la Tabla -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200 tracking-wider">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold">Orden</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Pregunta</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Estado</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center sm:sticky sm:right-0 sm:z-10 sm:bg-gray-50">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($preguntas as $pregunta)
                                <tr class="hover:bg-blue-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $pregunta->orden }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded-md text-xs font-medium border border-gray-200">
                                            {{ $pregunta->pregunta }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-500">
                                        @if ($pregunta->estado === 'Activo')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span> Activo
                                            </span> 
                                        @else 
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span> Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap sm:sticky sm:right-0 sm:bg-white sm:shadow-md sm:z-10">
                                        <div class="flex items-center justify-center gap-1">
                                            
                                            <a href="{{ route('testes.preguntas.edit',['teste' => $teste->id,'pregunta' => $pregunta->id]) }}"
                                            class="p-1.5 text-green-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors" 
                                            title="Editar Pregunta" data-id="{{ $pregunta->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen preview-icon"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                            </a>

                                            <form action="{{ route('testes.preguntas.destroy',['teste' => $teste->id,'pregunta' => $pregunta->id]) }}" method="POST" class="inline-block eliminar-pregunta">
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

                                    <td colspan="4" class="px-6 py-12 text-center">

                                        <div class="flex flex-col items-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300 mb-3"> <circle cx="12" cy="12" r="10"/> <path d="M9.09 9a3 3 0 1 1 5.83 1c0 2-3 3-3 3"/> <path d="M12 17h.01"/>

                                            </svg>

                                            <p class="text-gray-500 font-medium">
                                                Este pregunta todavía no tiene preguntas.
                                            </p>

                                            <a href="{{ route('testes.preguntas.create',$teste->id) }}" class="mt-3 inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-colors">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M12 5v14"/> <path d="M5 12h14"/></svg>

                                                Agregar primera pregunta

                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Paginación --}}
            @if ($preguntas->hasPages())

                <div class="mt-6">
                    {{ $preguntas->links() }}
                </div>

            @endif
        </div>
    </div>

    <script>
        document.querySelectorAll('.eliminar-pregunta').forEach(form => {
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
