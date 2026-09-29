<x-layouts.app :title="__('Comentarios')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex w-full justify-between mb-4">
                <h1 class="text-center content-center font-black text-white">Listado de Comentarios</h1>
            </div>

            <!-- Filtros -->
            <form class="rounded-lg shadow p-5 mb-8">

                <div class="grid grid-cols-2 md:grid-cols-5 gap-5 text-white">

                    <!-- Filtros de persona -->
                    <input 
                        type="text" 
                        name="persona" 
                        value="{{ request('persona') }}" 
                        placeholder="Nombre de la persona..."
                        class="border border-gray-300 rounded-lg p-2"
                    >

                    <input
                        type="text"
                        name="buscar"
                        value="{{ request('buscar') }}"
                        placeholder="Buscar identificación..."
                        class="border border-gray-300 rounded-lg p-2">

                    <!-- Filtros de archivo -->
                    <input 
                        type="text" 
                        name="archivo" 
                        value="{{ request('archivo') }}" 
                        placeholder="Buscar por archivo..."
                        class="border border-gray-300 rounded-lg p-2"
                    >

                    <select
                        name="estado"
                        class="border border-gray-300 rounded-lg p-2">

                        <option value="" class="text-gray-900">Todos</option>

                        <option value="0"
                        class="text-gray-900"
                            @selected(request('estado')==='0')>

                            Pendientes

                        </option>

                        <option value="1"
                        class="text-gray-900"
                            @selected(request('estado')==='1')>

                            Aprobados

                        </option>

                    </select>

                    <button 
                        type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex text-center justify-center gap-2 cursor-pointer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg> Buscar
                    </button>

                </div>

            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-100 text-gray-800">
                        <tr>
                            <th class="px-4 py-2 border">Archivo</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Identificación</th>
                            <th class="px-4 py-2 border">Departamento</th>
                            <th class="px-4 py-2 border">Comentario</th>
                            <th class="px-4 py-2 border">Estado</th>
                            <th class="px-4 py-2 border text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($comentarios as $comentario)
                            <tr class="hover:bg-blue-50 hover:text-gray-900">
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('posts.document', [$comentario->archivo->post->slug, $comentario->archivo->slug]) }}" target="_blank" 
                                    class="hover:text-blue-600 transition">
                                        {{ $comentario->archivo->nombre }}
                                    </a>
                                </td>
                                <td class="px-4 py-2 border">{{ $comentario->nombre }}</td>
                                <td class="px-4 py-2 border">{{ $comentario->identificacion }}</td>
                                <td class="px-4 py-2 border">{{ $comentario->departamento->nombre }}</td>
                                <td class="px-4 py-2 border">{{ Str::limit($comentario->comentario,120) }}</td>
                                <td class="px-4 py-2 border">@if($comentario->aprobado)

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">

                                    Aprobado

                                    </span>

                                    @else

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">

                                    Pendiente

                                    </span>

                                    @endif
                                </td>
                                <td class="px-4 py-2 border text-center flex justify-center gap-2">

                                    @if(strlen(strip_tags($comentario->comentario)) > 120)
                                        <button type="button" class="p-2 text-yellow-500 hover:text-yellow-700 transition cursor-pointer"  title="Ver comentario completo" onclick="abrirComentario(@js($comentario->archivo->nombre), @js($comentario->comentario))">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                        </button>
                                    @endif
                                    
                                    @if(!$comentario->aprobado)

                                    <form action="{{ route('comentarios.aprobar',$comentario) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button 
                                        class="p-2 text-green-500 hover:text-green-700 transition cursor-pointer"
                                        title="Aceptar"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-icon lucide-check"><path d="M20 6 9 17l-5-5"/></svg>
                                    </button>

                                    </form>

                                    @endif
                                    
                                    <form 
                                        action="{{ route('comentarios.destroy', $comentario->id) }}" 
                                        method="POST" 
                                        class="inline-block eliminar-comentario"
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
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500 border">No hay comentarios registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="mt-3">
                {{ $comentarios->links() }}
            </div>
        </div>
    </div>

    <div id="modalComentario" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 p-4" >
        <div class="bg-white rounded-xl shadow-xl w-full max-w-3xl max-h-[90vh] overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h2 id="contenidoTituloComentario" class="text-lg font-semibold text-gray-800"></h2>

                <button type="button" onclick="cerrarComentario()" class="text-gray-500 hover:text-gray-700 text-2xl cursor-pointer">
                    &times;
                </button>
            </div>

            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <div id="contenidoComentario" class="text-gray-700 whitespace-pre-line break-words"></div>
            </div>

            <div class="px-6 py-4 border-t flex justify-end">
                <button type="button" onclick="cerrarComentario()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700 cursor-pointer">
                    Cerrar
                </button>
            </div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.eliminar-comentario').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará la comentario permanentemente",
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

        <script>
            function abrirComentario(archivo, comentario) {

                const modal = document.getElementById('modalComentario');
                const contenido = document.getElementById('contenidoComentario');
                const contenidoTitulo = document.getElementById('contenidoTituloComentario');

                contenido.textContent = comentario;
                contenidoTitulo.textContent = archivo;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function cerrarComentario() {

                const modal = document.getElementById('modalComentario');

                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        </script>
</x-layouts.app>
