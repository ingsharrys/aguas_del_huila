<x-layouts.app :title="__('Tablero')">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="py-10">
        <h2 class="text-2xl font-bold mb-6">Panel de Administración</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Banners -->
            <a href="{{ route('banners.index') }}" 
            class="p-6 bg-black shadow-lg rounded-xl flex items-center space-x-4 hover:bg-zinc-900 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-icon lucide-image"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                <div>
                    <h3 class="text-lg font-semibold">Banners</h3>
                    <p class="text-gray-500 text-sm">Gestionar imágenes del sitio</p>
                </div>
            </a>

            <!-- Noticias -->
            <a href="{{ route('noticias.index') }}" 
            class="p-6 bg-black shadow-lg rounded-xl flex items-center space-x-4 hover:bg-zinc-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-newspaper-icon lucide-newspaper"><path d="M15 18h-5"/><path d="M18 14h-8"/><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-4 0v-9a2 2 0 0 1 2-2h2"/><rect width="8" height="4" x="10" y="6" rx="1"/></svg>
                <div>
                    <h3 class="text-lg font-semibold">Noticias</h3>
                    <p class="text-gray-500 text-sm">Administrar contenido informativo</p>
                </div>
            </a>

            <!-- Servicios -->
            <a href="{{ route('servicios.index') }}" 
            class="p-6 bg-black shadow-lg rounded-xl flex items-center space-x-4 hover:bg-zinc-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-check-icon lucide-book-check"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/><path d="m9 9.5 2 2 4-4"/></svg>
                <div>
                    <h3 class="text-lg font-semibold">Servicios</h3>
                    <p class="text-gray-500 text-sm">Configurar servicios ofrecidos</p>
                </div>
            </a>

            <!-- Posts -->
            <a href="{{ route('posts.index') }}" 
            class="p-6 bg-black shadow-lg rounded-xl flex items-center space-x-4 hover:bg-zinc-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-closed-icon lucide-folder-closed"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/><path d="M2 10h20"/></svg>
                <div>
                    <h3 class="text-lg font-semibold">Posts</h3>
                    <p class="text-gray-500 text-sm">Publicaciones en el blog</p>
                </div>
            </a>

            <!-- Archivos -->
            <a href="{{ route('archivos.index') }}" 
            class="p-6 bg-black shadow-lg rounded-xl flex items-center space-x-4 hover:bg-zinc-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-icon lucide-file"><path d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z"/><path d="M14 2v5a1 1 0 0 0 1 1h5"/></svg>
                <div>
                    <h3 class="text-lg font-semibold">Archivos</h3>
                    <p class="text-gray-500 text-sm">Documentos y descargas</p>
                </div>
            </a>

            <!-- Categorías -->
            <a href="{{ route('categorias.index') }}" 
            class="p-6 bg-black shadow-lg rounded-xl flex items-center space-x-4 hover:bg-zinc-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-bar-stacked-icon lucide-chart-bar-stacked"><path d="M11 13v4"/><path d="M15 5v4"/><path d="M3 3v16a2 2 0 0 0 2 2h16"/><rect x="7" y="13" width="9" height="4" rx="1"/><rect x="7" y="5" width="12" height="4" rx="1"/></svg>
                <div>
                    <h3 class="text-lg font-semibold">Categorías</h3>
                    <p class="text-gray-500 text-sm">Clasificación de contenidos</p>
                </div>
            </a>

            <!-- Usuarios -->
            <a href="{{ route('usuarios.index') }}" 
            class="p-6 bg-black shadow-lg rounded-xl flex items-center space-x-4 hover:bg-zinc-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
                <div>
                    <h3 class="text-lg font-semibold">Usuarios</h3>
                    <p class="text-gray-500 text-sm">Gestión de cuentas y roles</p>
                </div>
            </a>

        </div>
    </div>

    <div class="py-6">

        <h2 class="text-2xl font-bold mb-6">Panel de Estadísticas</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="p-6 bg-black shadow-lg rounded-xl flex items-center space-x-4 hover:bg-zinc-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                <div>
                    <h3 class="text-lg font-semibold">Total visitas</h3>
                    <p class="text-gray-500 text-sm">{{ $globalCount }}</p>
                </div>
            </div>

            <div class="p-6 bg-black shadow-lg rounded-xl flex items-center space-x-4 hover:bg-zinc-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-route-icon lucide-route"><circle cx="6" cy="19" r="3"/><path d="M9 19h8.5a3.5 3.5 0 0 0 0-7h-11a3.5 3.5 0 0 1 0-7H15"/><circle cx="18" cy="5" r="3"/></svg>
                <div>
                    <h3 class="text-lg font-semibold">Rutas registradas</h3>
                    <p class="text-gray-500 text-sm">{{ $topRoutes->count() }}</p>
                </div>
            </div>

            <div class="p-6 bg-black shadow-lg rounded-xl flex items-center space-x-4 hover:bg-zinc-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock-icon lucide-calendar-clock"><path d="M16 14v2.2l1.6 1"/><path d="M16 2v4"/><path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/><path d="M3 10h5"/><path d="M8 2v4"/><circle cx="16" cy="16" r="6"/></svg>
                <div>
                    <h3 class="text-lg font-semibold">Último registro</h3>
                    <p class="text-gray-500 text-sm">{{ now()->format('d M, Y') }}</p>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <!-- GRÁFICA: VISITAS DIARIAS -->
            <div>
            <h2 class="text-2xl font-semibold mt-8 mb-3">Visitas por Día</h2>
            <canvas id="dailyChart"></canvas>
            </div>

            <!-- GRÁFICA: VISITAS MENSUALES -->
             <div>
            <h2 class="text-2xl font-semibold mt-12 mb-3">Visitas por Mes</h2>
            <canvas id="monthlyChart"></canvas>
            </div>

        </div>

        <div class="grid grid-cols-1">

            <!-- GRÁFICA: RUTAS MÁS VISITADAS -->
            <div>
            <h2 class="text-2xl font-semibold mt-12 mb-3">Rutas más visitadas</h2>
            <canvas id="routesChart"></canvas>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // === GRÁFICA DIARIA ===
        new Chart(document.getElementById('dailyChart'), {
            type: 'line',
            data: {
                labels: @json($dailyViews->pluck('date')),
                datasets: [{
                    label: 'Visitas por día',
                    data: @json($dailyViews->pluck('total')),
                    borderWidth: 2
                }]
            }
        });

        // === GRÁFICA MENSUAL ===
        new Chart(document.getElementById('monthlyChart'), {
            type: 'bar',
            data: {
                labels: @json($monthlyViews->pluck('month')),
                datasets: [{
                    label: 'Visitas por mes',
                    data: @json($monthlyViews->pluck('total')),
                    borderWidth: 1
                }]
            }
        });

        // === TOP RUTAS ===
        new Chart(document.getElementById('routesChart'), {
            type: 'bar',
            data: {
                labels: @json($topRoutes->pluck('route')),
                datasets: [{
                    label: 'Visitas',
                    data: @json($topRoutes->pluck('total')),
                    borderWidth: 1
                }]
            }
        });
    </script>

</x-layouts.app>
