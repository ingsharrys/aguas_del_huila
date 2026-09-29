
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<header class="w-full shadow-md relative z-50">

    <!-- Franja azul GOV.CO -->
    <div class="bg-[#0047DC] text-white text-sm flex justify-between items-center px-32 py-2" id="mainNavbarblue">
        <div class="flex items-center gap-2">
            <a href="https://www.gov.co/" aria-label="GOV">
                <img src="{{ asset('storage/img/logo/logo_gov.png') }}" alt="GOV.CO" class="h-6">
            </a>
        </div>
    </div>

    <div class="bg-white w-full text-gray-800 flex flex-wrap justify-center px-2 lg:px-32 rounded-bl-4xl rounded-br-4xl transition-all duration-900 ease-out" id="mainNavbarFijo">
        <!-- Franja verde -->
        <div class="w-full text-white text-sm hidden md:flex justify-between mx-0 sm:mx-8 px-2 sm:px-8 py-2 rounded-bl-4xl rounded-br-4xl" style="background: #008A14;">
            <div class="flex flex-wrap items-center gap-1 sm:gap-5 text-sm">
                <a href="https://accounts.google.com/v3/signin/identifier?continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&dsh=S-1775406078%3A1770130191320756&ifkv=AXbMIuAJFgQYC9rhKihtxp60-FSUmAING6jmAs2PVPw0-LhTU58r_cCXvK2ICuLH7ohrCw8LgfP9DA&rip=1&sacu=1&service=mail&flowName=GlifWebSignIn&flowEntry=ServiceLogin" aria-label="Correo" class="flex items-center gap-1 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                    Correo
                </a>
                <a href="https://aguasdelhuila.gov.co/login" aria-label="Extranet" class="flex items-center gap-1 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-share2-icon lucide-share-2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/></svg>
                    Extranet
                </a>
                <a aria-label="Diagnostico rural" href="https://aguapotable.aguasdelhuila.gov.co/ControlDoc"  class="hover:underline">Diagnóstico Rural</a>
                <a aria-label="Nacederos" href="{{ route('nacederos') }}"  class="hover:underline">Nacedero</a>
            </div>

            <div class="flex items-center gap-1 sm:gap-5 text-sm">
                <div class="relative group">
                    <a aria-label="Transparencia"
                      href="{{ route('transparencia') }}"
                      class="hover:underline">
                        Transparencia
                    </a>

                    <div class="hidden group-hover:block absolute w-50 top-8 left-0 bg-white p-2 rounded-lg shadow-xl border border-[#0047DC] z-50">
                        <img
                            src="{{ asset('storage/senas/transparencia-senas.webp') }}"
                            alt="Seña de Transparencia"
                            class="w-full">
                    </div>
                </div>
                <div class="relative group">
                    <a aria-label="Participa"
                      href="{{ route('participa') }}"
                      class="hover:underline">
                        Participa
                    </a>

                    <div class="hidden group-hover:block absolute w-50 top-8 left-0 bg-white p-2 rounded-lg shadow-xl border border-[#0047DC] z-50">
                        <img
                            src="{{ asset('storage/senas/participa-senas.webp') }}"
                            alt="Señas para Participa"
                            class="w-48 rounded-lg shadow-lg">
                    </div>
                </div>
                <div class="relative group">
                    <a aria-label="Atención y Servicios a la Ciudadanía"
                      href="{{ route('participacion') }}"
                      class="hover:underline">
                        Atención y Servicios a la Ciudadanía
                    </a>

                    <div class="hidden group-hover:block absolute w-50 top-8 left-0 bg-white p-2 rounded-lg shadow-xl border border-[#0047DC] z-50">
                        <img
                            src="{{ asset('storage/senas/atencion-y-servicios-a-la-ciudadania-sena.webp') }}"
                            alt="Señas para Atención y Servicios a la Ciudadanía"
                            class="w-48 rounded-lg shadow-lg">
                    </div>
                </div>
                <a aria-label="Red Facebook" href="https://web.facebook.com/aguasdelhuila"  class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                <a aria-label="Red X" href="https://x.com/AguasdelHuila" target="_blank" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2H21.5l-7.11 8.13L22.75 22h-6.54l-5.12-6.7L5.25 22H2l7.6-8.68L1.5 2h6.71l4.63 6.1L18.244 2Zm-1.14 18h1.8L7.23 3.89H5.3L17.104 20Z"/></svg></a>
                <a aria-label="Instagram" href="https://www.instagram.com/aguasdelhuila/" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"> <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/> <path d="M16 11.37a4 4 0 1 1-4.63-4.63 4 4 0 0 1 4.63 4.63z"/> <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
                <a aria-label="TikTok" href="https://www.tiktok.com/@aguasdelhuila" target="_blank" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.12v13.14a2.72 2.72 0 1 1-2.72-2.72c.27 0 .53.04.78.11V9.37a5.84 5.84 0 1 0 5.06 5.77V8.47a7.92 7.92 0 0 0 4.63 1.48V6.69h-.85z"/></svg></a>
              </div>
        </div>

        <!-- ======================================================== -->
        <!-- Menú principal -->
        <!-- ======================================================== -->

        <a aria-label="Ir al inicio" href="{{ url('/') }}" class="p-0 hidden lg:block absolute" style="left: 15px;">
          <img src="{{ asset('storage/img/logo/logo-aguas-2026.jpg') }}" alt="Aguas del Huila" class="h-24">
        </a>

        <nav class="w-full py-4 flex justify-between">
            <div class="flex items-center gap-2">
                <a aria-label="Ir al inicio" href="{{ url('/') }}" class="p-0 m-0">
                  <img src="{{ asset('storage/img/logo/logo-aguas-2026.jpg') }}" alt="Aguas del Huila" class="h-12 block lg:hidden">
                </a>
                <a aria-label="Ir al inicio" href="https://www.huila.gov.co/" class="p-0 m-0 relative z-10">
                  <img src="{{ asset('storage/img/logo/logo_gobernacion_huila.png') }}" alt="Gobernación del Huila" class="h-12">
                </a>
            </div>

            <!-- Menú -->
            <ul class="hidden md:flex items-center gap-4 font-medium text-sm">
                <li>
                    <div class="relative group">
                      <a aria-label="Ir al inicio"
                        href="{{ url('/') }}"
                        class="hover:text-[#0047DC]">
                          Inicio
                      </a>

                      <div class="hidden group-hover:block absolute w-50 top-8 left-0 bg-white p-2 rounded-lg shadow-xl border border-[#0047DC] z-50">
                          <img
                              src="{{ asset('storage/senas/inicio-sena.webp') }}"
                              alt="Señas para Inicio"
                              class="w-48 rounded-lg shadow-lg">
                      </div>
                  </div>
                </li>
                <!-- Institucional con submenu -->
                <li class="relative group">
                  <button class="flex items-center gap-1 hover:text-[#0047DC] focus:outline-none" aria-label="Institucional">
                    Institucional
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>

                  <ul
                    class="absolute left-0 top-full mt-2 w-96 bg-white shadow-lg rounded-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50 grid grid-cols-2 gap-0"
                  >
                    <li class="col-span-2">
                        <div class="relative group">
                          <div class="hidden group-hover:block w-full bg-white p-2 rounded-lg shadow-xl border border-[#0047DC] justify-items-center">
                              <img
                                  src="{{ asset('storage/senas/entidad-sena.webp') }}"
                                  alt="Señas para Institucional"
                                  class="w-48 rounded-lg shadow-lg">
                          </div>
                      </div>
                    </li>
                    <li><a aria-label="Historia" href="{{ route('historia') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Historia</a></li>
                    <li><a aria-label="Funciones generales" href="{{ route('funcionesgenerales') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Funciones Generales</a></li>
                    <li><a aria-label="Imagen corporativa" href="{{ route('posts.file', 'imagen-corporativa') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Imagen Corporativa</a></li>
                    <li><a aria-label="Nuestro Gerente" href="{{ route('nuestrogerente') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Representante Legal</a></li>
                    <li><a aria-label="Gestion de calidad" href="{{ route('gestioncalidad') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Gestión de Calidad</a></li>
                    <li><a aria-label="Normativa" href="{{ route('posts.file', 'normatividad') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Normatividad</a></li>
                    <li><a aria-label="Induccion" href="{{ route('induccion') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Inducción</a></li>
                    <li><a aria-label="Directorio de entidades" href="{{ url('/') }}#directorio-de-entidades"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Entidades del Sector</a></li>
                    <li><a aria-label="Directorio" href="{{ route('directorio') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Aguas del Huila</a></li>
                    <li><a aria-label="Glosario" href="{{ route('glosario') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Glosario</a></li>
                    <li><a aria-label="Preguntas Frecuentes" href="{{ route('preguntasfrecuentes') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Preguntas Frecuentes</a></li>
                    <li><a aria-label="PDA" href="{{ route('posts.file', 'planes-de-desarrollo-departamental') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Plan de Desarrollo Departamental</a></li>
                  </ul>
                </li>  
                <!-- Contratación con submenu -->
                <li class="relative group">
                  <button class="flex items-center gap-1 hover:text-[#0047DC] focus:outline-none">
                    Contratación
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>

                  <ul
                    class="absolute left-0 top-full mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50"
                  >
                    <li>
                        <div class="relative group">
                          <div class="hidden group-hover:block w-full bg-white p-2 rounded-lg shadow-xl border border-[#0047DC] justify-items-center">
                              <img
                                  src="{{ asset('storage/senas/contratacion-sena.webp') }}"
                                  alt="Señas para contratacion"
                                  class="w-48 rounded-lg shadow-lg">
                          </div>
                      </div>
                    </li>
                    <li><a aria-label="Contratacion" href="{{ route('contrato') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Procesos Contractuales Parte 1</a></li>
                    <li><a aria-label="Contratacion dos" href="{{ route('contratodos') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Procesos Contractuales Parte 2</a></li>
                    <li><a aria-label="Accesos proponente" href="https://procesos.aguasdelhuila.gov.co/login"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Acceso de Proponente</a></li>
                    <li><a aria-label="Historial Contratacion" href="{{ route('posts.file', 'contratacion') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Histórico Contratación</a></li>
                  </ul>
                </li>  
                <!-- Servicios con submenú -->
                <li class="relative group">
                  <button class="flex items-center gap-1 hover:text-[#0047DC] focus:outline-none">
                    Servicios
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>
                  <ul
                    class="absolute left-0 top-full mt-2 w-96 bg-white shadow-lg rounded-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50 grid grid-cols-2 gap-0"
                  >
                    <li class="col-span-2">
                        <div class="relative group">
                          <div class="hidden group-hover:block w-full bg-white p-2 rounded-lg shadow-xl border border-[#0047DC] justify-items-center">
                              <img
                                  src="{{ asset('storage/senas/servicios-sena.webp') }}"
                                  alt="Señas para Servicios"
                                  class="w-48 rounded-lg shadow-lg">
                          </div>
                      </div>
                    </li>
                    @forelse($servicios as $servicio)
                      <li>
                        <a href="{{ route('servicios.article', [$servicio->slug, $servicio->id]) }}" aria-label="{{ $servicio->nombre }}" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">
                          {{ $servicio->nombre }}
                        </a>
                      </li>
                    @empty
                      <li><span class="block px-4 py-2 text-sm text-gray-400">Sin registros</span></li>
                    @endforelse
                  </ul>
                </li>
                <!-- PDA con submenú -->
                <li class="relative group">
                  <a class="flex items-center gap-1 hover:text-[#0047DC] focus:outline-none" href="{{ route('posts.show') }}" aria-label="PDA">
                    PDA
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </a>
                  <ul
                    class="absolute left-0 top-full mt-2 w-96 bg-white shadow-lg rounded-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50 grid grid-cols-2 gap-0"
                  >
                    @forelse($pdaPosts as $post)
                      <li>
                        <a href="{{ route('posts.show', $post->slug) }}" aria-label="{{ $post->nombre }}" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">
                          {{ $post->nombre }}
                        </a>
                      </li>
                    @empty
                      <li><span class="block px-4 py-2 text-sm text-gray-400">Sin registros</span></li>
                    @endforelse
                  </ul>
                </li>
                <!-- Descargas con submenu -->
                <li class="relative group">
                  <a class="flex items-center gap-1 hover:text-[#0047DC] focus:outline-none" href="{{ route('posts.download') }}" aria-label="Documentos">
                    Documentos
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </a>

                  <ul
                    class="absolute left-0 top-full mt-2 w-96 bg-white shadow-lg rounded-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50 grid grid-cols-2 gap-0"
                  >
                    @forelse($descargas as $descarga)
                      <li>
                        @if ($descarga->id == 4)
                        <a href="{{ $descarga->slug }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]" aria-label="{{ $descarga->nombre }}">
                        @else
                        <a href="{{ route('posts.file', $descarga->slug) }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]" aria-label="{{ $descarga->nombre }}">
                        @endif
                          {{ $descarga->nombre }}
                        </a>
                      </li>
                    @empty
                      <li><span class="block px-4 py-2 text-sm text-gray-400">Sin registros</span></li>
                    @endforelse
                  </ul>
                </li>
                <li>
                  <div class="relative group">
                    <a aria-label="Noticias"
                      href="{{ route('noticias.blog') }}"
                      class="hover:text-[#0047DC]">
                        Noticias
                    </a>

                    <div class="hidden group-hover:block absolute w-50 top-8 left-0 bg-white p-2 rounded-lg shadow-xl border border-[#0047DC] z-50">
                        <img
                            src="{{ asset('storage/senas/prensa-sena.webp') }}"
                            alt="Seña de noticias"
                            class="w-full">
                    </div>
                  </div>
                </li>
                <!-- Botón y lupa -->
                <div class="flex items-center gap-1">
                    <a href="{{ route('pagos') }}" aria-label="Pagos en Línea" class=" text-white px-4 py-2 rounded-full text-xs bg-[#008A14] hover:bg-green-800 transition">
                      PAGOS EN LÍNEA
                  </a>
                  <!-- Lupa -->
                  <div class="relative group">
                    <button class="relative group hover:text-green-900" style="color: #008A14;" aria-label="Abrir buscador">
                      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/>
                      </svg>
                    </button>

                    <ul
                      class="absolute right-0 top-full mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50"
                    >
                      <form action="{{ route('search') }}" method="GET" class="flex">
                            <label for="buscarpc" class="sr-only">
                                Buscar
                            </label>
                        <input 
                          type="text" 
                          name="q" 
                          id="buscarpc"
                          placeholder="Buscar..." 
                          class="flex w-full border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:border-[#00C81F]"
                          required
                        >
                        <button aria-label="buscar"
                          type="submit" 
                          class=" text-white px-3 py-2 rounded-r-md hover:bg-green-600" style="background: #008A14;"
                        >
                          Buscar
                        </button>
                      </form>
                    </ul>
                  </div>  
                </div>
            </ul>
              
            <!-- Menú móvil -->
            <button id="menu-toggle" class="text-gray-700 ml-4 flex md:hidden" aria-label="Abrir menú">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </nav>
    </div>

    <!-- ======================================================== -->
    <!-- Menú móvil -->
    <!-- ======================================================== -->

    <div id="mobile-menu" class="hidden fixed w-full bg-white border-t shadow-sm px-6 py-3" x-data="{ openPDA: false, openDescargas: false }">
      <ul class="flex flex-col gap-2 text-gray-700">

        <li><a href="{{ url('/') }}" aria-label="Ir al inicio" class="block py-2 border-b">Inicio</a></li>

        <!-- Institucional con submenú -->
        <li class="border-b" x-data="{ open: false }">
          <button aria-label="institucional"
            @click="open = !open" 
            class="flex justify-between items-center w-full py-2 text-left hover:text-blue-600 focus:outline-none">
            Institucional
            <svg xmlns="http://www.w3.org/2000/svg" 
              class="w-5 h-5 transform transition-transform duration-300" 
              :class="{ 'rotate-180': open }"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul x-show="open" x-collapse class="pl-4 mt-1 space-y-1 text-gray-600 grid gap-0 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            <li><a aria-label="historia" href="{{ route('historia') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Historia</a></li>
            <li><a aria-label="funcionesgenerales" href="{{ route('funcionesgenerales') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Funciones Generales</a></li>
            <li><a aria-label="imagen" href="{{ route('posts.file', 'imagen-corporativa') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Imagen Corporativa</a></li>
            <li><a aria-label="nuestrogerente" href="{{ route('nuestrogerente') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Representante Legal</a></li>
            <li><a aria-label="gestioncalidad" href="{{ route('gestioncalidad') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Gestión de Calidad</a></li>
            <li><a aria-label="normatividad" href="{{ route('posts.file', 'normatividad') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Normatividad</a></li>
            <li><a aria-label="induccion" href="{{ route('induccion') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Inducción</a></li>
            <li><a aria-label="directorio entidades" href="{{ url('/') }}#directorio-de-entidades"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Entidades del Sector</a></li>
            <li><a aria-label="directorio" href="{{ route('directorio') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Aguas del Huila</a></li>
            <li><a aria-label="glosario" href="{{ route('glosario') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Glosario</a></li>
            <li><a aria-label="preguntasfrecuentes" href="{{ route('preguntasfrecuentes') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Preguntas Frecuentes</a></li>
            <li><a aria-label="PDA" href="{{ route('posts.file', 'planes-de-desarrollo-departamental') }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Plan de Desarrollo Departamental</a></li>
          </ul>
        </li>

        <li><a href="{{ route('transparencia') }}" aria-label="transparencia" class="block py-2 border-b">Transparencia</a></li>
        <li><a href="{{ route('participacion') }}" aria-label="atencion" class="block py-2 border-b">Atención y Servicios a la Ciudadanía</a></li>

        <!-- Contratación con submenú -->
        <li class="border-b" x-data="{ open: false }">
          <button aria-label="contratacion"
            @click="open = !open" 
            class="flex justify-between items-center w-full py-2 text-left hover:text-blue-600 focus:outline-none">
            Contratación
            <svg xmlns="http://www.w3.org/2000/svg" 
              class="w-5 h-5 transform transition-transform duration-300" 
              :class="{ 'rotate-180': open }"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul x-show="open" x-collapse class="pl-4 mt-1 space-y-1 text-gray-600 grid gap-0 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            <li><a href="{{ route('contrato') }}" aria-label="contrato" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Procesos Contractuales Parte 1</a></li>
            <li><a href="{{ route('contratodos') }}" aria-label="contratodos" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Procesos Contractuales Parte 2</a></li>
            <li><a href="https://procesos.aguasdelhuila.gov.co/login" aria-label="procesos" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Acceso de Proponente</a></li>
            <li><a href="{{ route('posts.file', 'contratacion') }}" aria-label="contratacion" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Histórico Contratación</a></li>
          </ul>
        </li>

        <!-- Servicios con submenú -->
        <li class="border-b" x-data="{ open: false }">
          <button aria-label="servicios"
            @click="open = !open" 
            class="flex justify-between items-center w-full py-2 text-left hover:text-blue-600 focus:outline-none">
            Servicios
            <svg xmlns="http://www.w3.org/2000/svg" 
              class="w-5 h-5 transform transition-transform duration-300" 
              :class="{ 'rotate-180': open }"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul x-show="open" x-collapse class="pl-4 mt-1 space-y-1 text-gray-600 grid gap-0 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            @forelse($servicios as $servicio)
              <li>
                <a href="{{ $servicio->slug }}"  class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]" aria-label="{{ $servicio->nombre }}">
                  {{ $servicio->nombre }}
                </a>
              </li>
            @empty
              <li><span class="block px-4 py-2 text-sm text-gray-400">Sin registros</span></li>
            @endforelse
          </ul>
        </li>

        <!-- PDA con submenú -->
        <li class="border-b" x-data="{ open: false }">
          <button aria-label="pda"
            @click="open = !open" 
            class="flex justify-between items-center w-full py-2 text-left hover:text-blue-600 focus:outline-none">
            PDA
            <svg xmlns="http://www.w3.org/2000/svg" 
              class="w-5 h-5 transform transition-transform duration-300" 
              :class="{ 'rotate-180': open }"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul x-show="open" x-collapse class="pl-4 mt-1 space-y-1 text-gray-600 grid gap-0 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($pdaPosts as $post)
              <li><a href="{{ route('posts.show', $post->slug) }}"  class="block py-1 hover:text-blue-500" aria-label="{{ $post->nombre }}">{{ $post->nombre }}</a></li>
            @endforeach
          </ul>
        </li>

        <!-- Descargas con submenú -->
        <li class="border-b" x-data="{ open: false }">
          <button aria-label="documentos"
            @click="open = !open" 
            class="flex justify-between items-center w-full py-2 text-left hover:text-blue-600 focus:outline-none">
            Documentos
            <svg xmlns="http://www.w3.org/2000/svg" 
              class="w-5 h-5 transform transition-transform duration-300" 
              :class="{ 'rotate-180': open }"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul x-show="open" x-collapse class="pl-4 mt-1 space-y-1 text-gray-600 grid gap-0 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            <li><a href="{{ route('posts.download') }}"  class="block py-1 hover:text-blue-500" aria-label="Documentos">Documentos</a></li>
            @foreach ($descargas as $descargas)
              <li><a href="{{ $descargas->slug }}"  class="block py-1 hover:text-blue-500" aria-label="{{ $descargas->nombre }}">{{ $descargas->nombre }}</a></li>
            @endforeach
          </ul>
        </li>       
        <li><a href="{{ route('participa') }}" aria-label="Participa" class="block py-2 border-b">Participa</a></li>
        <li><a href="https://accounts.google.com/v3/signin/identifier?continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&dsh=S-1775406078%3A1770130191320756&ifkv=AXbMIuAJFgQYC9rhKihtxp60-FSUmAING6jmAs2PVPw0-LhTU58r_cCXvK2ICuLH7ohrCw8LgfP9DA&rip=1&sacu=1&service=mail&flowName=GlifWebSignIn&flowEntry=ServiceLogin" aria-label="Correo" class="block py-2 border-b">Correo</a></li>
        <li><a href="https://aguasdelhuila.gov.co/login" aria-label="Extranet" class="block py-2 border-b">Extranet</a></li>
        <li><a href="https://aguapotable.aguasdelhuila.gov.co/ControlDoc" aria-label="Diagnostico Rural" class="block py-2 border-b">Diagnóstico Rural</a></li>
        <li><a href="{{ route('nacederos') }}" aria-label="Nacederos" class="block py-2 border-b">Nacederos</a></li>
        <li><a href="{{ route('noticias.blog') }}" aria-label="Noticias" class="block py-2 border-b">Noticias</a></li>

        <!-- Pagos -->
        <li>
          <a href="{{ route('pagos') }}" aria-label="Pagos en Línea" class="block  text-white font-semibold py-2 px-4 rounded-full text-center bg-[#008A14] hover:bg-green-800 transition">
            Pagos en Línea
          </a>
        </li>

        <!-- Buscador -->
        <li class="flex justify-start pt-2">
          <form action="{{ route('search') }}" method="GET" class="flex">
                <label for="buscarmovil" class="sr-only">
                    Buscar
                </label>
            <input 
              type="text" 
              name="q" 
              id="buscarmovil"
              placeholder="Buscar..." 
              class="flex w-full border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:border-[#00C81F]"
              required
            >
            <button aria-label="buscar"
              type="submit" 
              aria-label="Buscar en la web"
              class=" text-white px-3 py-2 rounded-r-md hover:bg-green-600" style="background: #008A14;"
            >
              Buscar
            </button>
          </form>
        </li>
      </ul>
    </div>

</header>

<script>
    // Script simple para menú móvil
    document.getElementById('menu-toggle').addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>

<script>
// navbar fijo al scroll
document.addEventListener("scroll", function () {
    const navbar = document.getElementById("mainNavbarblue");
    const navbarfijo = document.getElementById("mainNavbarFijo");
    const menu = document.getElementById('mobile-menu');

    if (window.scrollY > 150) {
        navbar.classList.add("hidden");

        navbarfijo.classList.add(
            "opacity-100",
            "translate-y-0",
            "fixed",
        );

        menu.classList.add(
            "mt-20",
        );

        navbarfijo.classList.remove(
            "-translate-y-1",
        );

    } else {
        navbar.classList.remove("hidden");

        navbarfijo.classList.add(
            "-translate-y-1",
        );

        navbarfijo.classList.remove(
            "opacity-100",
            "translate-y-0",
            "fixed",
        );

        menu.classList.remove(
            "mt-20",
        );
    }
});
</script>