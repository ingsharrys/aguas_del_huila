<x-layouts.app :title="__('Crear Usuario')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <h1 class="text-center content-center font-black">Nuevo Usuario</h1>
            
            <a href="{{ route('usuarios.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>
        <form 
            action="{{ route('usuarios.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-5 bg-gray-100 rounded-lg"
        >
            @csrf

            <!-- 🧱 Columna izquierda (70%) -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Título -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Título</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el nombre de la Usuario"
                        required
                    >
                </div>

                <!-- descripcion -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el correo completo de la Usuario..."
                        required
                    >
                </div>

                <!-- contraseña -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Contraseña</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="*******"
                        required
                    >
                </div>

                <!-- contraseña -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirmar Contraseña</label>
                    <input 
                        type="password_confirmation" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="******"
                        required
                    >
                </div>

            </div>

            <!-- 🧱 Columna derecha (30%) -->
            <div class="space-y-6">

                <!-- rol -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Asignar Rol</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($roles as $role)
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="rol" value="{{ $role->name }}" class="rounded">
                                <span class="text-gray-700">{{ ucfirst($role->name) }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Botón -->
                <div class="pt-4">
                    <button 
                        type="submit"
                        class="flex text-center justify-center gap-2 w-full bg-blue-600 text-white font-semibold py-2 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 cursor-pointer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg> Publicar
                    </button>
                </div>
            </div>
        </form>
    </div>

</x-layouts.app>
