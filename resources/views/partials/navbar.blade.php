<style>
#menu-desktop {
    @media (width >= 96rem) {
        display: flex !important;
    }
}
</style>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<header class="w-full shadow-md relative z-50">

    <!-- Franja azul GOV.CO -->
    <div class="bg-[#0047DC] text-white text-sm flex justify-between items-center px-32 py-2">
        <div class="flex items-center gap-2">
            <a href="https://www.gov.co/" target="_blank" >
                <img src="{{ asset('storage/img/logo/logo_gov.png') }}" alt="GOV.CO" title="GOV" class="h-10">
            </a>
        </div>
    </div>

    <div class="bg-white text-gray-800 flex flex-wrap justify-center px-2 lg:px-32 rounded-bl-4xl rounded-br-4xl">
        <!-- Franja verde -->
        <div class="w-full bg-[#00C81F] text-white text-sm flex justify-between mx-0 sm:mx-8 px-2 sm:px-8 py-2 rounded-bl-4xl rounded-br-4xl">
            <div class="flex flex-wrap items-center gap-1 sm:gap-5">
                <a href="mailto:info@aguasdelhuila.gov.co" target="_blank" class="flex items-center gap-1 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                    Correo
                </a>
                <a href="https://extranet.aguasdelhuila.gov.co/login.aspx" target="_blank" class="flex items-center gap-1 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-share2-icon lucide-share-2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/></svg>
                    Extranet
                </a>
                <a href="https://aguapotable.aguasdelhuila.gov.co/ControlDoc" target="_blank" class="hover:underline">Diagnóstico Rural</a>
                <a href="{{ route('nacederos') }}" target="_blank" class="hover:underline">Nacedero</a>
                <a href="{{ route('noticias.blog') }}" target="_blank" class="hover:underline">Noticias</a>
            </div>

            <div class="flex items-center gap-1 sm:gap-5">
                <a href="https://web.facebook.com/aguasdelhuila" target="_blank" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                <a href="https://x.com/AguasdelHuila" target="_blank" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter-icon lucide-twitter"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg></a>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- Menú principal -->
        <!-- ======================================================== -->

        <nav class="w-full py-4 flex justify-between">
            <div class="flex items-center gap-2">
                <img src="{{ asset('storage/img/logo/logo_aguas_huila.png') }}" alt="Aguas del Huila" title="Aguas del Huila" class="h-12">
                <img src="{{ asset('storage/img/logo/logo_gobernacion_huila.png') }}" alt="Gobernación del Huila" title="Gobernación del Huila" class="h-12">
            </div>

            <!-- Menú -->
            <ul class="hidden items-center gap-4 font-medium" id="menu-desktop">
                <li><a href="{{ url('/') }}" target="_blank" class="hover:text-[#0047DC]">Inicio</a></li>
                <!-- Institucional con submenu -->
                <li class="relative group">
                  <button class="flex items-center gap-1 hover:text-[#0047DC] focus:outline-none">
                    Institucional
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>

                  <ul
                    class="absolute left-0 top-full mt-2 w-96 bg-white shadow-lg rounded-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50 grid grid-cols-2 gap-0"
                  >
                    <li><a href="{{ route('historia') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Historia</a></li>
                    <li><a href="{{ route('funcionesgenerales') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Funciones Generales</a></li>
                    <li><a href="{{ route('posts.file', 'imagen-corporativa') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Imagen Corporativa</a></li>
                    <li><a href="{{ route('nuestrogerente') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Representante Legal</a></li>
                    <li><a href="{{ route('gestioncalidad') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Gestión de Calidad</a></li>
                    <li><a href="{{ route('posts.file', 'normatividad') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Normatividad</a></li>
                    <li><a href="{{ route('induccion') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Inducción</a></li>
                    <li><a href="{{ route('posts.file', 'directorio-entidades-del-sector') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Entidades del Sector</a></li>
                    <li><a href="{{ route('directorio') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Aguas del Huila</a></li>
                    <li><a href="{{ route('glosario') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Glosario</a></li>
                    <li><a href="{{ route('preguntasfrecuentes') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Preguntas Frecuentes</a></li>
                    <li><a href="{{ route('posts.file', 'planes-de-desarrollo-departamental') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Plan de Desarrollo Departamental</a></li>
                  </ul>
                </li>  
                <li><a href="{{ route('transparencia') }}" target="_blank" class="hover:text-[#0047DC]">Transparencia</a></li>
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
                    <li><a href="{{ route('contratacionuno') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Procesos Contractuales Parte 1</a></li>
                    <li><a href="{{ route('contrataciondos') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Procesos Contractuales Parte 2</a></li>
                    <li><a href="https://procesos.aguasdelhuila.gov.co/login" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Acceso de Proponente</a></li>
                    <li><a href="{{ route('posts.file', 'contratacion') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Histórico Contratación</a></li>
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
                    @forelse($servicios as $servicio)
                      <li>
                        <a href="{{ route('servicios.article', [$servicio->slug, $servicio->id]) }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">
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
                  <a class="flex items-center gap-1 hover:text-[#0047DC] focus:outline-none" href="{{ route('posts.show') }}" target="_blank">
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
                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">
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
                  <a class="flex items-center gap-1 hover:text-[#0047DC] focus:outline-none" href="{{ route('posts.download') }}" target="_blank">
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
                        <a href="{{ $descarga->slug }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">
                        @else
                        <a href="{{ route('posts.file', $descarga->slug) }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">
                        @endif
                          {{ $descarga->nombre }}
                        </a>
                      </li>
                    @empty
                      <li><span class="block px-4 py-2 text-sm text-gray-400">Sin registros</span></li>
                    @endforelse
                  </ul>
                </li>
                <!-- Participacion con submenu -->
                <li class="relative group">
                  <button class="flex items-center gap-1 hover:text-[#0047DC] focus:outline-none">
                    Participa
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>

                  <ul
                    class="absolute left-0 top-full mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50"
                  >
                    <li><a href="{{ route('participacion') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Participación Ciudadana</a></li>
                    <li><a href="{{ route('convocatoria') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Convocatorias</a></li>
                    <li><a href="{{ route('calendario') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Calendario de Actividades</a></li>
                  </ul>
                </li>   
                <!-- Botón y lupa -->
                <div class="flex items-center gap-1">
                    <a href="{{ route('pagos') }}" target="_blank" class="bg-[#00C81F] text-white px-4 py-2 rounded-full text-sm hover:bg-[#00A038] transition">
                      PAGOS EN LÍNEA
                  </a>
                  <!-- Lupa -->
                  <div class="relative group">
                    <button class="relative group text-[#00C81F] hover:text-green-900">
                      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/>
                      </svg>
                    </button>

                    <ul
                      class="absolute right-0 top-full mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-1 transition-all duration-300 z-50"
                    >
                      <form action="{{ route('search') }}" method="GET" class="flex">
                        <input 
                          type="text" 
                          name="q" 
                          placeholder="Buscar..." 
                          class="flex w-full border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:border-[#00C81F]"
                          required
                        >
                        <button 
                          type="submit" 
                          class="bg-[#00C81F] text-white px-3 py-2 rounded-r-md hover:bg-green-600"
                        >
                          Buscar
                        </button>
                      </form>
                    </ul>
                  </div>  
                </div>
            </ul>
              
            <!-- Menú móvil -->
            <button id="menu-toggle" class="2xl:hidden text-gray-700 ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </nav>
    </div>

    <!-- ======================================================== -->
    <!-- Menú móvil -->
    <!-- ======================================================== -->

    <div id="mobile-menu" class="hidden 2xl:hidden bg-white border-t shadow-sm px-6 py-3" x-data="{ openPDA: false, openDescargas: false }">
      <ul class="flex flex-col gap-2 text-gray-700">

        <li><a href="{{ url('/') }}" target="_blank" class="block py-2 border-b">Inicio</a></li>

        <!-- Institucional con submenú -->
        <li class="border-b" x-data="{ open: false }">
          <button 
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
            <li><a href="{{ route('historia') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Historia</a></li>
            <li><a href="{{ route('funcionesgenerales') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Funciones Generales</a></li>
            <li><a href="{{ route('posts.file', 'imagen-corporativa') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Imagen Corporativa</a></li>
            <li><a href="{{ route('nuestrogerente') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Representante Legal</a></li>
            <li><a href="{{ route('gestioncalidad') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Gestión de Calidad</a></li>
            <li><a href="{{ route('transparencia') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Transparencia</a></li>
            <li><a href="{{ route('posts.file', 'normatividad') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Normatividad</a></li>
            <li><a href="{{ route('induccion') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Inducción</a></li>
            <li><a href="{{ route('posts.file', 'directorio-entidades-del-sector') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Entidades del Sector</a></li>
            <li><a href="{{ route('directorio') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Aguas del Huila</a></li>
            <li><a href="{{ route('glosario') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Glosario</a></li>
            <li><a href="{{ route('preguntasfrecuentes') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Preguntas Frecuentes</a></li>
            <li><a href="{{ route('posts.file', 'planes-de-desarrollo-departamental') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Plan de Desarrollo Departamental</a></li>
          </ul>
        </li>

        <li><a href="{{ route('transparencia') }}" target="_blank" class="block py-2 border-b">Transparencia</a></li>

        <!-- Contratación con submenú -->
        <li class="border-b" x-data="{ open: false }">
          <button 
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
            <li><a href="{{ route('contratacionuno') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Procesos Contractuales Parte 1</a></li>
            <li><a href="{{ route('contrataciondos') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Procesos Contractuales Parte 2</a></li>
            <li><a href="https://procesos.aguasdelhuila.gov.co/login" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Acceso de Proponente</a></li>
            <li><a href="{{ route('posts.file', 'contratacion') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Histórico Contratación</a></li>
          </ul>
        </li>

        <!-- Servicios con submenú -->
        <li class="border-b" x-data="{ open: false }">
          <button 
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
                <a href="{{ $servicio->slug }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">
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
          <button 
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
              <li><a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="block py-1 hover:text-blue-500">{{ $post->nombre }}</a></li>
            @endforeach
          </ul>
        </li>

        <!-- Descargas con submenú -->
        <li class="border-b" x-data="{ open: false }">
          <button 
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
            <li><a href="{{ route('posts.download') }}" target="_blank" class="block py-1 hover:text-blue-500">Documentos</a></li>
            @foreach ($descargas as $descargas)
              <li><a href="{{ $descargas->slug }}" target="_blank" class="block py-1 hover:text-blue-500">{{ $descargas->nombre }}</a></li>
            @endforeach
          </ul>
        </li>

        <!-- Participa con submenú -->
        <li class="border-b" x-data="{ open: false }">
          <button 
            @click="open = !open" 
            class="flex justify-between items-center w-full py-2 text-left hover:text-blue-600 focus:outline-none">
            Participa
            <svg xmlns="http://www.w3.org/2000/svg" 
              class="w-5 h-5 transform transition-transform duration-300" 
              :class="{ 'rotate-180': open }"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <ul x-show="open" x-collapse class="pl-4 mt-1 space-y-1 text-gray-600 grid gap-0 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            <li><a href="{{ route('participacion') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Participación Ciudadana</a></li>
            <li><a href="{{ route('convocatoria') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Convocatorias</a></li>
            <li><a href="{{ route('calendario') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-[#0047DC]">Calendario de Actividades</a></li>
          </ul>
        </li>

        <!-- Pagos -->
        <li>
          <a href="{{ route('pagos') }}" target="_blank" class="block bg-[#00C81F] text-white font-semibold py-2 px-4 rounded-full text-center hover:bg-[#00A038] transition">
            Pagos en Línea
          </a>
        </li>

        <!-- Buscador -->
        <li class="flex justify-start pt-2">
          <form action="{{ route('search') }}" method="GET" class="flex">
            <input 
              type="text" 
              name="q" 
              placeholder="Buscar..." 
              class="flex w-full border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:border-[#00C81F]"
              required
            >
            <button 
              type="submit" 
              class="bg-[#00C81F] text-white px-3 py-2 rounded-r-md hover:bg-green-600"
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
