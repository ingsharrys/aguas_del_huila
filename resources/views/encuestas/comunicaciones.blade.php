<x-layouts.app :title="__('Comunicaciones Oficiales')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex flex-wrap w-full justify-between mb-4">
                <h1 class="text-center content-center font-black text-white">Comunicaciones Oficiales</h1>
                <a href="{{ route('dashboard.comunicaciones.reportes') }}" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-700 transition"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notepad-text"><path d="M8 2v4"/><path d="M12 2v4"/><path d="M16 2v4"/><rect width="16" height="18" x="4" y="4" rx="2"/><path d="M8 10h6"/><path d="M8 14h8"/><path d="M8 18h5"/></svg> Reportes</a>
            </div>

            <!-- Estadisticas generales -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white rounded-xl shadow-lg p-6 col-span-3">

                    <div class="flex flex-col md:flex-row justify-between md:items-center border-b-2 border-gray-200 pb-3 mb-6 gap-3">

                        <div class="flex justify-between items-center pb-2 mb-4 w-full">
                            <h2 class="text-xl font-bold text-[#0047DC]">PQRSDF <span class="text-sm text-gray-500 mt-1">- Estado general de las peticiones, quejas, reclamos, sugerencias, denuncias y felicitaciones</span></h2>
                            <a href="{{ route('dashboard.comunicaciones.pqrsdf') }}" class="flex px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 text-center justify-center items-center gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"/> <path d="M12 16v-4"/> <path d="M12 8h.01"/></svg>
                                Ver Detalles

                            </a>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <p class="text-sm text-gray-500">
                                Total de PQRSDF
                            </p>

                            <p class="text-3xl font-bold text-gray-800 mt-1">
                                {{ $estadisticas['pqrsdf']['total'] }}
                            </p>
                        </div>

                        <div class="border border-yellow-200 rounded-lg p-4 bg-yellow-50">
                            <p class="text-sm text-yellow-700">
                                Sin asignar
                            </p>

                            <p class="text-3xl font-bold text-yellow-800 mt-1">
                                {{ $estadisticas['pqrsdf']['sin_asignar'] }}
                            </p>
                        </div>

                        <div class="border border-blue-200 rounded-lg p-4 bg-blue-50">
                            <p class="text-sm text-blue-700">
                                Asignadas sin responder
                            </p>

                            <p class="text-3xl font-bold text-blue-800 mt-1">
                                {{ $estadisticas['pqrsdf']['asignadas'] }}
                            </p>
                        </div>

                        <div class="border border-orange-200 rounded-lg p-4 bg-orange-50">
                            <p class="text-sm text-orange-700">
                                En Revisión
                            </p>

                            <p class="text-3xl font-bold text-orange-800 mt-1">
                                {{ $estadisticas['pqrsdf']['revision'] }}
                            </p>
                        </div>

                        <div class="border border-green-200 rounded-lg p-4 bg-green-50">
                            <p class="text-sm text-green-700">
                                Respondidas
                            </p>

                            <p class="text-3xl font-bold text-green-800 mt-1">
                                {{ $estadisticas['pqrsdf']['respondidas'] }}
                            </p>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mt-4">

                        <div class="border border-orange-200 rounded-lg p-4 bg-orange-50">
                            <p class="text-sm text-orange-700">
                                Total por responder
                            </p>

                            <p class="text-3xl font-bold text-orange-800 mt-1">
                                {{ $estadisticas['pqrsdf']['por_responder'] }}
                            </p>
                        </div>

                        <div class="border border-yellow-200 rounded-lg p-4 bg-yellow-50">
                            <p class="text-sm text-yellow-700">
                                Por Corregir
                            </p>

                            <p class="text-3xl font-bold text-yellow-800 mt-1">
                                {{ $estadisticas['pqrsdf']['corregir'] }}
                            </p>
                        </div>

                        <div class="border border-purple-200 rounded-lg p-4 bg-purple-50">
                            <p class="text-sm text-purple-700">
                                Próximas a vencer
                            </p>

                            <p class="text-3xl font-bold text-purple-800 mt-1">
                                {{ $estadisticas['pqrsdf']['proximas_vencer'] }}
                            </p>

                            <p class="text-xs text-purple-600 mt-1">
                                Próximos 3 días
                            </p>
                        </div>

                        <div class="border border-red-200 rounded-lg p-4 bg-red-50">
                            <p class="text-sm text-red-700">
                                Vencidas
                            </p>

                            <p class="text-3xl font-bold text-red-800 mt-1">
                                {{ $estadisticas['pqrsdf']['vencidas'] }}
                            </p>
                        </div>

                        <div class="border border-indigo-200 rounded-lg p-4 bg-indigo-50">
                            <p class="text-sm text-indigo-700">
                                Porcentaje de respuesta
                            </p>

                            <p class="text-3xl font-bold text-indigo-800 mt-1">
                                {{ $estadisticas['pqrsdf']['pct_respondidas'] }}%
                            </p>
                        </div>

                    </div>

                    <div class="mt-6 border-t-2 border-gray-200 pt-5">

                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            Cumplimiento de tiempos de respuesta
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div class="flex items-center justify-between border border-green-200 bg-green-50 rounded-lg p-4">

                                <div>
                                    <p class="text-sm text-green-700">
                                        Respondidas dentro del plazo
                                    </p>

                                    <p class="text-xs text-green-600 mt-1">
                                        Respuestas realizadas oportunamente
                                    </p>
                                </div>

                                <span class="text-2xl font-bold text-green-800">
                                    {{ $estadisticas['pqrsdf']['respondidasEnPlazo'] }}
                                </span>

                            </div>

                            <div class="flex items-center justify-between border border-red-200 bg-red-50 rounded-lg p-4">

                                <div>
                                    <p class="text-sm text-red-700">
                                        Respondidas fuera del plazo
                                    </p>

                                    <p class="text-xs text-red-600 mt-1">
                                        Respuestas realizadas después de la fecha límite
                                    </p>
                                </div>

                                <span class="text-2xl font-bold text-red-800">
                                    {{ $estadisticas['pqrsdf']['respondidasFueraDePlazo'] }}
                                </span>

                            </div>

                            <div class="flex items-center justify-between border border-red-200 bg-red-50 rounded-lg p-4">

                                <div>
                                    <p class="text-sm text-red-700">
                                        Canceladas
                                    </p>

                                    <p class="text-xs text-red-600 mt-1">
                                        PQRSDF que fueron canceladas
                                    </p>
                                </div>

                                <span class="text-2xl font-bold text-red-800">
                                    {{ $estadisticas['pqrsdf']['canceladas'] }}
                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="mt-6 border-t-2 border-gray-200 pt-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- TABELA 1 -->
                            <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            PQRSDF por área
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Cantidad de PQRSDF asignadas a cada área.
                                        </p>
                                    </div>
                                </div>

                                @if($estadisticas['pqrsdf']['por_area']->count())

                                    <div class="overflow-x-auto">

                                        <table class="w-full text-sm text-left text-gray-600">

                                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                                <tr>
                                                    <th class="px-4 py-3">
                                                        Área
                                                    </th>

                                                    <th class="px-4 py-3 text-center">
                                                        Total
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="divide-y divide-gray-200">

                                                @foreach($estadisticas['pqrsdf']['por_area'] as $estadisticaArea)

                                                    <tr class="border-b hover:bg-gray-50">

                                                        <td class="px-4 py-3 font-medium text-gray-800">
                                                            {{ $estadisticaArea->area?->nombre ?? 'Sin asignar' }}
                                                        </td>

                                                        <td class="px-4 py-3 text-center">

                                                            <span class="inline-flex items-center justify-center min-w-[40px] px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-semibold">
                                                                {{ $estadisticaArea->total }}
                                                            </span>

                                                        </td>

                                                    </tr>

                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                @else

                                    <p class="text-sm text-gray-500">
                                        No hay información disponible por área.
                                    </p>

                                @endif

                            </div>

                            <!-- TABELA 2 -->
                            <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            PQRSDF por usuario
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Cantidad de PQRSDF asignadas a cada funcionario.
                                        </p>
                                    </div>
                                </div>

                                @if($estadisticas['pqrsdf']['por_usuario']->count())

                                    <div class="overflow-x-auto">

                                        <table class="w-full text-sm text-left text-gray-600">

                                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">

                                                <tr>

                                                    <th class="px-4 py-3">
                                                        Usuario
                                                    </th>

                                                    <th class="px-4 py-3">
                                                        Área
                                                    </th>

                                                    <th class="px-4 py-3 text-center">
                                                        Total PQR
                                                    </th>

                                                </tr>

                                            </thead>

                                            <tbody class="divide-y divide-gray-200">

                                                @foreach($estadisticas['pqrsdf']['por_usuario'] as $estadisticaUsuario)

                                                    <tr class="border-b hover:bg-gray-50">

                                                        <td class="px-4 py-3 font-medium text-gray-800">
                                                            {{ $estadisticaUsuario->usuario?->name ?? 'Usuario no disponible' }}
                                                        </td>

                                                        <td class="px-4 py-3 text-gray-600">
                                                            {{ $estadisticaUsuario->usuario?->area?->nombre ?? 'Sin área' }}
                                                        </td>

                                                        <td class="px-4 py-3 text-center">

                                                            <span class="inline-flex items-center justify-center min-w-[40px] px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-semibold">

                                                                {{ $estadisticaUsuario->total }}

                                                            </span>

                                                        </td>

                                                    </tr>

                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                @else

                                    <p class="text-sm text-gray-500">
                                        No hay PQRSDF asignadas a usuarios.
                                    </p>

                                @endif
                            </div>

                            <!-- TABELA 3: Usuários que mais asignaram PQR -->
                            <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            Usuarios con mayor asignaciones
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            Empleados con el mayor número de asignaciones/reasignaciones realizadas.
                                        </p>
                                    </div>
                                </div>

                                @if($asignadores->count())
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-sm text-left text-gray-600">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                                <tr>
                                                    <th class="px-4 py-3">Usuarios</th>
                                                    <th class="px-4 py-3">Área</th>
                                                    <th class="px-4 py-3 text-center">Total Asignadas</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach($asignadores as $item)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-4 py-3 font-medium text-gray-800">
                                                            {{ $item->usuario?->name ?? 'N/A' }}
                                                        </td>
                                                        <td class="px-4 py-3 text-gray-600">
                                                            {{ $item->usuario?->area?->nombre ?? 'Sin Área' }}
                                                        </td>
                                                        <td class="px-4 py-3 text-center">
                                                            <span class="inline-flex items-center justify-center min-w-[40px] px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 font-semibold">
                                                                {{ $item->total }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 py-4">Sin registros.</p>
                                @endif
                            </div>

                            <!-- TABELA 4: Usuários que mais cancelaram PQR -->
                            <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            Usuarios con más cancelaciones
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            Usuarios que realizaron cancelaciones
                                        </p>
                                    </div>
                                </div>

                                @if($canceladores->count())
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-sm text-left text-gray-600">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                                <tr>
                                                    <th class="px-4 py-3">Usuario</th>
                                                    <th class="px-4 py-3">Área</th>
                                                    <th class="px-4 py-3 text-center">Total Canceladas</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach($canceladores as $item)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-4 py-3 font-medium text-gray-800">
                                                            {{ $item->usuarioCancelado?->name ?? 'N/A' }}
                                                        </td>
                                                        <td class="px-4 py-3 text-gray-600">
                                                            {{ $item->usuarioCancelado?->area?->nombre ?? 'Sin Área' }}
                                                        </td>
                                                        <td class="px-4 py-3 text-center">
                                                            <span class="inline-flex items-center justify-center min-w-[40px] px-3 py-1 rounded-full bg-rose-100 text-rose-800 font-semibold">
                                                                {{ $item->total }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 py-4">Sin Registros.</p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="flex justify-center items-center pt-6 mt-6 border-t border-gray-200">

                        <a href="{{ route('pqr') }}" class="flex w-48 px-4 py-2 border-green-700 rounded-lg text-white bg-green-600 hover:bg-green-700 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link-icon lucide-external-link"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg> Ver Formulario</a>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-layouts.app>
