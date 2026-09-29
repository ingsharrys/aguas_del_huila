<x-layouts.app :title="__('Encuestas')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            <div class="flex w-full justify-between mb-4">
                <h1 class="text-center content-center font-black text-white">Listado de Encuestas</h1>
            </div>

            <!-- Estadisticas generales -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center border-b-2 border-gray-200 pb-2 mb-4">
                        <h2 class="text-xl font-bold text-[#0047DC]">Trámites</h2>
                        <a href="{{ route('encuesta.tramite') }}" class="flex w-48 px-4 py-2 border-green-700 rounded-lg text-white bg-green-600 hover:bg-green-700 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link-icon lucide-external-link"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg> Ver Formulario</a>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">
                            Total de Encuestas: <strong>{{ $estadisticas['tramites']['total'] }}</strong>
                        </p>
                    </div>
                    <div class="flex justify-center items-center pt-2 mt-2">
                        <a href="{{ route('dashboard.encuestas.tramites') }}" class="flex w-48 px-4 py-2 border-blue-700 rounded-lg text-white bg-blue-600 hover:bg-blue-700 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg> Ver Detalles</a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center border-b-2 border-gray-200 pb-2 mb-4">
                        <h2 class="text-xl font-bold text-[#0047DC]">Evaluación</h2>
                        <a href="{{ route('encuesta.evaluacion') }}" class="flex w-48 px-4 py-2 border-green-700 rounded-lg text-white bg-green-600 hover:bg-green-700 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link-icon lucide-external-link"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg> Ver Formulario</a>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">
                            Total de Encuestas: <strong>{{ $estadisticas['evaluacion']['total'] }}</strong>
                        </p>
                    </div>
                    <div class="flex justify-center items-center pt-2 mt-2">
                        <a href="{{ route('dashboard.encuestas.evaluacion') }}" class="flex w-48 px-4 py-2 border-blue-700 rounded-lg text-white bg-blue-600 hover:bg-blue-700 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg> Ver Detalles</a>
                    </div>
                </div>

            </div>

            <!-- Graficas estadisticas -->
            <div class="flex w-full justify-between my-4">
                <h2 class="text-center text-md md:text-3xl content-center font-black text-white">Encuesta de satisfacción de tramites y servicios</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">

                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-4">
                        ¿Por cual medio tuvo acceso?
                    </h2>

                    <canvas id="medioChart"></canvas>

                </div>

                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-4">
                        ¿La información fue clara y completa?
                    </h2>

                    <canvas id="informacionChart"></canvas>

                </div>

                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-4">
                        ¿Realizar el trámite fue fácil y adecuado?
                    </h2>

                    <canvas id="facilidadChart"></canvas>

                </div>

                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-4">
                        ¿A qué grupo al cual pertenece?
                    </h2>

                    <canvas id="grupoChart"></canvas>

                </div>

                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-4">
                        ¿Cuál es el grado de beneficio con el trámite?
                    </h2>

                    <canvas id="beneficioChart"></canvas>

                </div>

            </div>

            <!-- Graficas estadisticas -->
            <div class="flex w-full justify-between my-4">
                <h2 class="text-center text-md md:text-3xl content-center font-black text-white">Encuesta de Evaluación</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-4">
                        ¿Aguas del Huila está actualizada?
                    </h2>

                    <canvas id="actualizadaEvaChart"></canvas>

                </div>

                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-4">
                        ¿Encontró la información que buscaba?
                    </h2>

                    <canvas id="informacionEvaChart"></canvas>

                </div>

                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-4">
                        ¿Estás satisfecho con la distribución y diseño?
                    </h2>

                    <canvas id="satisfaccionEvaChart"></canvas>

                </div>

                <div class="bg-white rounded-xl shadow p-6">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-4">
                        ¿Fue fácil buscar la información de tu interés dentro?
                    </h2>

                    <canvas id="facilidadEvaChart"></canvas>

                </div>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        new Chart(document.getElementById('medioChart'),{

            type:'doughnut',

            data:{

                labels:@json($estadisticas['tramites']['medio']->keys()),

                datasets:[{

                    data:@json($estadisticas['tramites']['medio']->values()),

                    backgroundColor:[

                        '#0047DC',
                        '#00C81F',
                        '#4F46E5',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'

                    ]

                }]

            },

            options:{

                responsive:true,

                plugins:{
                    legend:{
                        position:'bottom'
                    }
                }

            }

        });

    </script>

    <script>

        new Chart(document.getElementById('informacionChart'),{

            type:'doughnut',

            data:{

                labels:@json($estadisticas['tramites']['informacion']->keys()),

                datasets:[{

                    data:@json($estadisticas['tramites']['informacion']->values()),

                    backgroundColor:[

                        '#0047DC',
                        '#00C81F',
                        '#4F46E5',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'

                    ]

                }]

            },

            options:{

                responsive:true,

                plugins:{
                    legend:{
                        position:'bottom'
                    }
                }

            }

        });

    </script>

    <script>

        new Chart(document.getElementById('facilidadChart'),{

            type:'doughnut',

            data:{

                labels:@json($estadisticas['tramites']['facilidad']->keys()),

                datasets:[{

                    data:@json($estadisticas['tramites']['facilidad']->values()),

                    backgroundColor:[

                        '#0047DC',
                        '#00C81F',
                        '#4F46E5',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'

                    ]

                }]

            },

            options:{

                responsive:true,

                plugins:{
                    legend:{
                        position:'bottom'
                    }
                }

            }

        });

    </script>

    <script>

        new Chart(document.getElementById('grupoChart'),{

            type:'doughnut',

            data:{

                labels:@json($estadisticas['tramites']['grupo']->keys()),

                datasets:[{

                    data:@json($estadisticas['tramites']['grupo']->values()),

                    backgroundColor:[

                        '#0047DC',
                        '#00C81F',
                        '#4F46E5',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'

                    ]

                }]

            },

            options:{

                responsive:true,

                plugins:{
                    legend:{
                        position:'bottom'
                    }
                }

            }

        });

    </script>

    <script>

        new Chart(document.getElementById('beneficioChart'),{

            type:'doughnut',

            data:{

                labels:@json($estadisticas['tramites']['beneficio']->keys()),

                datasets:[{

                    data:@json($estadisticas['tramites']['beneficio']->values()),

                    backgroundColor:[

                        '#0047DC',
                        '#00C81F',
                        '#4F46E5',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'

                    ]

                }]

            },

            options:{

                responsive:true,

                plugins:{
                    legend:{
                        position:'bottom'
                    }
                }

            }

        });

    </script>


    
    <script>

        new Chart(document.getElementById('actualizadaEvaChart'),{

            type:'pie',

            data:{

                labels:@json($estadisticas['evaluacion']['actualizada']->keys()),

                datasets:[{

                    data:@json($estadisticas['evaluacion']['actualizada']->values()),

                    backgroundColor:[

                        '#0047DC',
                        '#00C81F',
                        '#4F46E5',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'

                    ]

                }]

            },

            options:{

                responsive:true,

                plugins:{
                    legend:{
                        position:'bottom'
                    }
                }

            }

        });

    </script>
    
    <script>

        new Chart(document.getElementById('informacionEvaChart'),{

            type:'pie',

            data:{

                labels:@json($estadisticas['evaluacion']['informacion']->keys()),

                datasets:[{

                    data:@json($estadisticas['evaluacion']['informacion']->values()),

                    backgroundColor:[

                        '#0047DC',
                        '#00C81F',
                        '#4F46E5',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'

                    ]

                }]

            },

            options:{

                responsive:true,

                plugins:{
                    legend:{
                        position:'bottom'
                    }
                }

            }

        });

    </script>
    
    <script>

        new Chart(document.getElementById('satisfaccionEvaChart'),{

            type:'pie',

            data:{

                labels:@json($estadisticas['evaluacion']['satisfaccion']->keys()),

                datasets:[{

                    data:@json($estadisticas['evaluacion']['satisfaccion']->values()),

                    backgroundColor:[

                        '#0047DC',
                        '#00C81F',
                        '#4F46E5',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'

                    ]

                }]

            },

            options:{

                responsive:true,

                plugins:{
                    legend:{
                        position:'bottom'
                    }
                }

            }

        });

    </script>
    
    <script>

        new Chart(document.getElementById('facilidadEvaChart'),{

            type:'pie',

            data:{

                labels:@json($estadisticas['evaluacion']['facilidad']->keys()),

                datasets:[{

                    data:@json($estadisticas['evaluacion']['facilidad']->values()),

                    backgroundColor:[

                        '#0047DC',
                        '#00C81F',
                        '#4F46E5',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'

                    ]

                }]

            },

            options:{

                responsive:true,

                plugins:{
                    legend:{
                        position:'bottom'
                    }
                }

            }

        });

    </script>
</x-layouts.app>
