
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
            labels: @json($dailyViews->pluck('day')),
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
            labels: @json($monthlyViews->pluck('month_label')),
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