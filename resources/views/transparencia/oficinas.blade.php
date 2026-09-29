<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Oficinas</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Oficinas de Aguas del Huila</h2>
                <p class="text-lg">Inicio / Transparencia y Acceso a la Información Pública</span class="font-bold"> / Oficinas de Aguas del Huila</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="prose max-w-none text-justify text-gray-900">
                En Aguas del Huila trabajamos para estar cada vez más cerca de los huilenses, garantizando atención oportuna, acompañamiento técnico y servicios de calidad para todos los municipios del departamento. Por eso contamos con sedes estratégicamente ubicadas que facilitan el acceso a nuestros programas, trámites y servicios.
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 my-4">
                
                <!-- Neiva -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://maps.app.goo.gl/eV3v74u3iecrHMsM9" >Neiva (Sede Principal)</a></h3>
                        <img src="{{ asset('storage/img/sedes/sede-neiva.jpg') }}" alt="Neiva" title="Neiva" class="justify-self-center my-2">
                        <p class="text-black">
                            DIRECCION: Calle 21 No. 1C - 17
                            </br> 
                            TELEFONO: (+57) 3174034811
                        </p>
                    </div>
                </div>
                
                <!-- Tarqui -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://maps.app.goo.gl/E1aJkxNPWYLpJUoP9" >Tarqui</a></h3>
                        <img src="{{ asset('storage/img/sedes/sede-tarqui.jpg') }}" alt="Tarqui" title="Tarqui" class="justify-self-center my-2">
                        <p class="text-black">
                            DIRECCION: CALLE 8 No. 4 - 63
                            </br> 
                            TELEFONO: 316 529 0918
                        </p>
                    </div>
                </div>
                
                <!-- Nátaga -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://maps.app.goo.gl/g9GwezqmSeeaEE4V8" >Nátaga</a></h3>
                        <img src="{{ asset('storage/img/sedes/sede-nataga.jpg') }}" alt="Nátaga" title="Nátaga" class="justify-self-center my-2">
                        <p class="text-black">
                            DIRECCION: CARRERA 7 No. 1 - 47 
                            </br> 
                            TELEFONO: 310 210 9036
                        </p>
                    </div>
                </div>
                
                <!-- Paicol -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://maps.app.goo.gl/VYksEBy9UUaJh89U6" >Paicol</a></h3>
                        <img src="{{ asset('storage/img/sedes/sede-paicol.jpg') }}" alt="Paicol" title="Paicol" class="justify-self-center my-2">
                        <p class="text-black">
                            DIRECCION: Calle 3 # 6-56
                        </p>
                    </div>
                </div>
                
                <!-- Santa María -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://maps.app.goo.gl/tST6HNQKSS7KywPF6" >Santa María</a></h3>
                        <img src="{{ asset('storage/img/sedes/sede-santa-maria.jpg') }}" alt="Santa María" title="Santa María" class="justify-self-center my-2">
                        <p class="text-black">
                            DIRECCION: CALLE 8 No. 3 - 55
                            </br> 
                            TELEFONO: 317 331 3126
                        </p>
                    </div>
                </div>

            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
