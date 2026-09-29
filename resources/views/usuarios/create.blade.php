<x-layouts.app :title="__('Crear Usuario')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <h1 class="text-center content-center font-black text-white">Nuevo Usuario</h1>
            
            <a href="{{ route('usuarios.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>
        <form 
    action="{{ route('usuarios.store') }}" 
    method="POST" 
    enctype="multipart/form-data"
    class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-5 bg-gray-100 rounded-lg"
>
    @csrf

    <!-- 🧱 Columna izquierda (Campos de identificación y acceso) -->
    <div class="lg:col-span-2 space-y-6">

        <!-- Nombres y Apellidos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="nombres" class="block text-sm font-semibold text-gray-700 mb-1">Nombres <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="nombres" 
                    id="nombres"
                    value="{{ old('nombres') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 text-gray-900"
                    placeholder="Escribe los nombres"
                    required
                >
                @error('nombres') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="apellidos" class="block text-sm font-semibold text-gray-700 mb-1">Apellidos <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="apellidos" 
                    id="apellidos"
                    value="{{ old('apellidos') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 text-gray-900"
                    placeholder="Escribe los apellidos"
                    required
                >
                @error('apellidos') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Documento e Identificador de Usuario -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="numero_identificacion" class="block text-sm font-semibold text-gray-700 mb-1">N° de Identificación <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="numero_identificacion" 
                    id="numero_identificacion"
                    value="{{ old('numero_identificacion') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 text-gray-900"
                    placeholder="Ej. 1075234890"
                    required
                >
                @error('numero_identificacion') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Usuario (Username) <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="username" 
                    id="username"
                    value="{{ old('username') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 text-gray-900"
                    placeholder="Ej. jperez"
                    required
                >
                @error('username') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Correo Electrónico -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico <span class="text-red-500">*</span></label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 text-gray-900"
                placeholder="ejemplo@aguasdelhuila.gov.co"
                required
            >
            @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Contraseñas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Contraseña <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 pr-10 text-gray-900"
                        placeholder="*******"
                        required
                    >
                    <button type="button" onclick="togglePasswordVisibility('password', 'eye-password')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-blue-600 focus:outline-none cursor-pointer">
                        <svg id="eye-password" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirmar Contraseña <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 pr-10 text-gray-900"
                        placeholder="*******"
                        required
                    >
                    <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'eye-password-conf')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-blue-600 focus:outline-none cursor-pointer">
                        <svg id="eye-password-conf" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 🧱 Columna derecha (Organización, Contrato y Rol) -->
    <div class="space-y-6">

        <!-- Área -->
        <div>
            <label for="area_id" class="block text-sm font-semibold text-gray-700 mb-1">Área <span class="text-red-500">*</span></label>
            <select
                name="area_id"
                id="area_id"
                required
                class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-900 bg-white"
            >
                <option value="">Seleccione un área</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                        {{ $area->nombre }}
                    </option>
                @endforeach
            </select>
            @error('area_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- ¿Es Jefe / Líder de Área? -->
        <div class="pt-2">
            <label class="flex items-center space-x-3 cursor-pointer bg-white px-3 py-2.5 border rounded-lg border-gray-300 shadow-sm">
                <input 
                    type="checkbox" 
                    name="es_jefe" 
                    id="es_jefe" 
                    value="1" 
                    {{ old('es_jefe') ? 'checked' : '' }}
                    class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                >
                <span class="text-sm font-semibold text-gray-700">¿Jefe / Encargado del Área?</span>
            </label>
            @error('es_jefe') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Cargo -->
        <div>
            <label for="cargo_id" class="block text-sm font-semibold text-gray-700 mb-1">Cargo <span class="text-red-500">*</span></label>
            <select
                name="cargo_id"
                id="cargo_id"
                required
                class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-900 bg-white"
            >
                <option value="">Seleccione un cargo</option>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo->id }}" {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
            @error('cargo_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Tipo de Vinculación -->
        <div>
            <label for="tipo_vinculacion" class="block text-sm font-semibold text-gray-700 mb-1">Tipo de Vinculación <span class="text-red-500">*</span></label>
            <select
                name="tipo_vinculacion"
                id="tipo_vinculacion"
                onchange="toggleFechaTerminacion()"
                required
                class="w-full border border-gray-300 rounded-lg p-2.5 text-gray-900 bg-white"
            >
                <option value="">Seleccione opción</option>
                <option value="Contratista" {{ old('tipo_vinculacion') == 'Contratista' ? 'selected' : '' }}>Contratista</option>
                <option value="Periodo Fijo / Libre Nombramiento" {{ old('tipo_vinculacion') == 'Periodo Fijo / Libre Nombramiento' ? 'selected' : '' }}>Periodo Fijo / Libre Nombramiento</option>
                <option value="Planta" {{ old('tipo_vinculacion') == 'Planta' ? 'selected' : '' }}>Planta</option>
            </select>
            @error('tipo_vinculacion') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Fecha de Terminación (Condicional) -->
        <div id="container_fecha_terminacion" class="hidden">
            <label for="fecha_terminacion" class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Terminación <span class="text-red-500">*</span></label>
            <input 
                type="date" 
                name="fecha_terminacion" 
                id="fecha_terminacion"
                value="{{ old('fecha_terminacion') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 text-gray-900"
            >
            @error('fecha_terminacion') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Asignar Rol -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Asignar Rol <span class="text-red-500">*</span></label>
            <div class="flex flex-wrap gap-3 pt-1">
                @foreach ($roles as $role)
                    <label class="flex items-center space-x-2 bg-white px-3 py-1.5 border rounded-lg cursor-pointer">
                        <input type="radio" name="rol" value="{{ $role->name }}" {{ old('rol') == $role->name ? 'checked' : '' }} required class="rounded">
                        <span class="text-sm text-gray-700">{{ ucfirst($role->name) }}</span>
                    </label>
                @endforeach
            </div>
            @error('rol') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Botón Guardar -->
        <div class="pt-4">
            <button 
                type="submit"
                class="flex text-center justify-center gap-2 w-full bg-blue-600 text-white font-semibold py-2.5 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 cursor-pointer transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg> Guardar Usuario
            </button>
        </div>
    </div>
</form>
    </div>

    <script>
        function toggleFechaTerminacion() {
            const tipoVinculacion = document.getElementById('tipo_vinculacion').value;
            const container = document.getElementById('container_fecha_terminacion');
            const inputFecha = document.getElementById('fecha_terminacion');

            if (tipoVinculacion === 'Contratista' || tipoVinculacion === 'Periodo Fijo / Libre Nombramiento') {
                container.classList.remove('hidden');
                inputFecha.required = true;
            } else {
                container.classList.add('hidden');
                inputFecha.required = false;
                inputFecha.value = ''; // Limpia el valor en caso de ser Planta
            }
        }

        // Ejecutar al cargar la página para mantener selecciones previas o datos en edición
        document.addEventListener('DOMContentLoaded', toggleFechaTerminacion);
    </script>

    <!-- Script para alternar la visibilidad y el icono -->
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            // Icono de "Ojo abierto"
            const eyeOpen = '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>';
            // Icono de "Ojo cerrado" (Ocultar)
            const eyeClosed = '<path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/>';

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = eyeClosed;
            } else {
                input.type = 'password';
                icon.innerHTML = eyeOpen;
            }
        }
    </script>

</x-layouts.app>
