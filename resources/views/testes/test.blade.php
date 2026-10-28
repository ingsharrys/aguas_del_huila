<x-layouts.app :title="__('Test de Conocimiento')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex flex-wrap w-full justify-between mb-4">
                <h1 class="text-center content-center font-black text-white">Test de Conocimiento</h1>
            </div>

            <!-- Estadisticas generales -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white rounded-xl shadow-lg p-6 col-span-3">

                    <div class="flex flex-col md:flex-row justify-between md:items-center border-b-2 border-gray-200 pb-3 mb-6 gap-3">

                        <div class="flex justify-between items-center pb-2 mb-4 w-full">
                            <h2 class="text-xl font-bold text-[#0047DC]">Test de Conocimiento <span class="text-sm text-gray-500 mt-1">- Estado general de los tests</span></h2>
                            <a href="{{ route('testes.index') }}" class="flex px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 text-center justify-center items-center gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"/> <path d="M12 16v-4"/> <path d="M12 8h.01"/></svg>
                                Ver Detalles

                            </a>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

                        <!-- Total de Tests -->
                        <a href="{{ route('testes.index') }}" class="block border border-gray-200 rounded-lg p-4 bg-gray-50 hover:bg-gray-100 hover:shadow-md transition-all cursor-pointer">
                            <p class="text-sm text-gray-500">
                                Total de Tests
                            </p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">
                                {{ $estadisticas['total_tests'] }}
                            </p>
                        </a>

                        <!-- Tests Activos -->
                        <a href="{{ route('testes.index', ['estado' => 'Activo']) }}" class="block border border-yellow-200 rounded-lg p-4 bg-yellow-50 hover:bg-yellow-100 hover:shadow-md transition-all cursor-pointer">
                            <p class="text-sm text-yellow-700">
                                Tests Activos
                            </p>
                            <p class="text-3xl font-bold text-yellow-800 mt-1">
                                {{ $estadisticas['tests_activos'] }}
                            </p>
                        </a>

                        <!-- Total de Respuestas -->
                        <a href="{{ route('testes.index') }}" class="block border border-blue-200 rounded-lg p-4 bg-blue-50 hover:bg-blue-100 hover:shadow-md transition-all cursor-pointer">
                            <p class="text-sm text-blue-700">
                                Total de Respuestas
                            </p>
                            <p class="text-3xl font-bold text-blue-800 mt-1">
                                {{ $estadisticas['total_intentos'] }}
                            </p>
                        </a>

                        <!-- Promedio de Respuestas -->
                        <a href="{{ route('testes.index') }}" class="block border border-orange-200 rounded-lg p-4 bg-orange-50 hover:bg-orange-100 hover:shadow-md transition-all cursor-pointer">
                            <p class="text-sm text-orange-700">
                                Promedio de Calificación
                            </p>
                            <p class="text-3xl font-bold text-orange-800 mt-1">
                                {{ number_format($estadisticas['promedio_calificacion'], 2) }}%
                            </p>
                        </a>

                        <!-- Aprobadas -->
                        <a href="{{ route('testes.index') }}" class="block border border-green-200 rounded-lg p-4 bg-green-50 hover:bg-green-100 hover:shadow-md transition-all cursor-pointer">
                            <p class="text-sm text-green-700">
                                Aprobados
                            </p>
                            <p class="text-3xl font-bold text-green-800 mt-1">
                                {{ $estadisticas['aprobados'] }}
                            </p>
                        </a>

                        <!-- Reprobadas -->
                        <a href="{{ route('testes.index') }}" class="block border border-red-200 rounded-lg p-4 bg-red-50 hover:bg-red-100 hover:shadow-md transition-all cursor-pointer">
                            <p class="text-sm text-red-700">
                                Reprobados
                            </p>
                            <p class="text-3xl font-bold text-red-800 mt-1">
                                {{ $estadisticas['reprobados'] }}
                            </p>
                        </a>

                        <!-- participantes_mes -->
                        <a href="{{ route('testes.index') }}" class="block border border-purple-200 rounded-lg p-4 bg-purple-50 hover:bg-purple-100 hover:shadow-md transition-all cursor-pointer">
                            <p class="text-sm text-purple-700">
                                Participantes del Mes
                            </p>
                            <p class="text-3xl font-bold text-purple-800 mt-1">
                                {{ $estadisticas['participantes_mes'] }}
                            </p>
                        </a>

                        <!-- intentos_mes -->
                        <a href="{{ route('testes.index') }}" class="block border border-pink-200 rounded-lg p-4 bg-pink-50 hover:bg-pink-100 hover:shadow-md transition-all cursor-pointer">
                            <p class="text-sm text-pink-700">
                                Intentos del Mes
                            </p>
                            <p class="text-3xl font-bold text-pink-800 mt-1">
                                {{ $estadisticas['intentos_mes'] }}
                            </p>
                        </a>

                    </div>

                    <div class="mt-6 border-t-2 border-gray-200 pt-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- TABLA 1 - Tests -->
                            <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100">

                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            Resumen de Tests
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Estado y resultados de cada test de conocimiento.
                                        </p>
                                    </div>

                                    <a href="{{ route('testes.index') }}"
                                        class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                        Ver todos
                                    </a>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-600">

                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                            <tr>
                                                <th class="px-4 py-3">
                                                    Test
                                                </th>

                                                <th class="px-4 py-3 text-center">
                                                    Preguntas
                                                </th>

                                                <th class="px-4 py-3 text-center">
                                                    Intentos
                                                </th>

                                                <th class="px-4 py-3 text-center">
                                                    Promedio
                                                </th>

                                                <th class="px-4 py-3 text-center">
                                                    Estado
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @forelse ($tests as $test)

                                                <tr class="border-b hover:bg-gray-50">

                                                    <td class="px-4 py-3">

                                                        <div class="font-semibold text-gray-800">
                                                            {{ $test->nombre }}
                                                        </div>

                                                        @if ($test->descripcion)
                                                            <div class="text-xs text-gray-500 mt-1">
                                                                {{ Str::limit($test->descripcion, 80) }}
                                                            </div>
                                                        @endif

                                                    </td>

                                                    <td class="px-4 py-3 text-center">
                                                        {{ $test->preguntas_count }}
                                                    </td>

                                                    <td class="px-4 py-3 text-center">
                                                        {{ $test->intentos_count }}
                                                    </td>

                                                    <td class="px-4 py-3 text-center font-semibold">

                                                        @if ($test->intentos_count > 0)
                                                            {{ number_format($test->intentos_avg_porcentaje, 2) }}%
                                                        @else
                                                            <span class="text-gray-400">
                                                                Sin resultados
                                                            </span>
                                                        @endif

                                                    </td>

                                                    <td class="px-4 py-3 text-center">

                                                        @if ($test->estado === 'Activo')

                                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                Activo
                                                            </span>

                                                        @else

                                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                                Inactivo
                                                            </span>

                                                        @endif

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>
                                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                                        No hay tests registrados.
                                                    </td>
                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>
                                </div>

                            </div>

                            <!-- TABLA 2 - Ranking -->
                            <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100">

                                <div class="flex justify-between items-center mb-4">

                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            Ranking de Calificaciones
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Mejores resultados obtenidos en los tests.
                                        </p>
                                    </div>

                                </div>

                                <div class="overflow-x-auto">

                                    <table class="w-full text-sm text-left text-gray-600">

                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">

                                            <tr>

                                                <th class="px-3 py-3 text-center">
                                                    #
                                                </th>

                                                <th class="px-3 py-3">
                                                    Participante
                                                </th>

                                                <th class="px-3 py-3">
                                                    Test
                                                </th>

                                                <th class="px-3 py-3">
                                                    Municipio
                                                </th>

                                                <th class="px-3 py-3 text-center">
                                                    Calificación
                                                </th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @forelse ($ranking as $index => $intento)

                                                <tr class="border-b hover:bg-gray-50">

                                                    <td class="px-3 py-3 text-center font-bold text-gray-500">
                                                        {{ $index + 1 }}
                                                    </td>

                                                    <td class="px-3 py-3">

                                                        <div class="font-semibold text-gray-800">
                                                            {{ $intento->nombre }}
                                                        </div>

                                                        <div class="text-xs text-gray-500">
                                                            {{ $intento->created_at?->format('d/m/Y H:i') }}
                                                        </div>

                                                    </td>

                                                    <td class="px-3 py-3">
                                                        {{ $intento->test->nombre }}
                                                    </td>

                                                    <td class="px-3 py-3">
                                                        {{ $intento->municipio->nombre ?? 'N/A' }}
                                                    </td>

                                                    <td class="px-3 py-3 text-center">

                                                        <span class="font-bold
                                                            @if ($intento->porcentaje >= 80)
                                                                text-green-600
                                                            @elseif ($intento->porcentaje >= 60)
                                                                text-yellow-600
                                                            @else
                                                                text-red-600
                                                            @endif
                                                        ">
                                                            {{ number_format($intento->porcentaje, 2) }}%
                                                        </span>

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td colspan="5"
                                                        class="px-4 py-8 text-center text-gray-500">

                                                        No hay resultados registrados.

                                                    </td>

                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-layouts.app>
