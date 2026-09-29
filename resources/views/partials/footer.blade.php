
<!-- Contador de visitas -->
<section class="px-2 lg:px-32 bg-white">
    <div class="w-full">
        @include('partials.counter')
    </div>
</section>

<footer class="bg-[#0047DC] text-white pt-12 pb-4 px-4 lg:px-32 text-sm shadow-md">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

        <!-- Columna 1: Información institucional -->
        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/img/logo-aguas-huila-white.png') }}" alt="Aguas del Huila" class="h-auto">
                <img src="{{ asset('storage/img/logo-gobernacion-white.png') }}" alt="Gobernación del Huila" class="h-auto">
            </div>

            <div>
                <h1 class="font-bold text-lg">Aguas Del Huila S.A. E.S.P.</h1>
                <p>NIT 800.100.553-2</p>
                <p>Dirección: Calle 21 No. 1C - 17 Neiva (Huila) - Colombia</p>
                <p>Código Postal: 410010</p>
                <p>Teléfono de Contacto: (+57) 3174034811</p>
                <p>Línea Anticorrupción: (+57) 3174034811</p>
                <p>Correo Electrónico: <a href="mailto:notificacionesjudiciales@aguasdelhuila.gov.co" class="underline">notificacionesjudiciales@aguasdelhuila.gov.co</a></p>
                <p>PBX: (608) XXX XXXX</p>
                <p>Línea gratuita nacional: 018000 XXX XXX</p>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="https://www.gov.co/" aria-label="GOV">
                    <img src="{{ asset('storage/img/logo/logo_gov.png') }}" alt="GOV.CO" class="h-14">
                </a>
                
                <a href="https://colombia.co/" aria-label="Colombia CO">
                    <img src="{{ asset('storage/img/logo/Marca_pais_Colombia_logo.png') }}" alt="Colombia CO" class="h-14">
                </a>
            </div>
        </div>

        <!-- Columna 2: Sede y horarios -->
        <div class="space-y-4">
            <div>
                <h2 class="font-bold text-lg">Sede Principal:</h2>
                <p>Calle 21 No. 1C - 17 - Neiva, Huila</p>
                <a href="https://maps.app.goo.gl/uie1wGNNpJ7UNiBV6"  class="underline">Ubicación</a>
            </div>

            <div>
                <h3 class="font-bold text-lg">Horarios de Atención</h3>
                <p>Lunes a Jueves: Mañana 7AM a 12M - Tarde 2PM a 6PM</p>
                <p>Viernes: Mañana 7AM a 12M - Tarde 2PM a 5PM</p>
            </div>

            <div>
                <h3><a href="{{ route('oficinas') }}"  class="font-bold text-lg text-white hover:text-gray hover:underline">Sedes</a></h3>
                <ul class="space-y-1">
                    <li>
                        <p>Neiva: Calle 21 No. 1C - 17</p>
                    </li>
                    <li>
                        <p>Tarqui: CALLE 8 No. 4 - 63</p>
                    </li>
                    <li>
                        <p>Nátaga: CARRERA 7 No. 1 - 47</p>
                    </li>
                    <li>
                        <p>Paicol: Calle 3 # 6-56</p>
                    </li>
                    <li>
                        <p>Santa María: CALLE 8 No. 3 - 55</p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Columna 3: enlaces -->
        <div class="space-y-4">
            <h3 class="font-bold text-lg">Enlaces de interés</h3>

            <ul class="space-y-1">
                <li>
                    <a href="{{ route('transparencia') }}" class="hover:underline">
                        Transparencia y Acceso a la Información Pública
                    </a>
                </li>

                <li>
                    <a href="{{ route('participa') }}" class="hover:underline">
                        Participa
                    </a>
                </li>

                <li>
                    <a href="{{ route('pqr') }}" class="hover:underline">
                        PQRSDF
                    </a>
                </li>

                <li>
                    <a href="{{ route('mapadelsitio') }}" class="hover:underline">
                        Mapa del Sitio
                    </a>
                </li>

                <li>
                    <a href="{{ route('glosario') }}" class="hover:underline">
                        Glosario
                    </a>
                </li>

                <li>
                    <a href="{{ route('preguntasfrecuentes') }}" class="hover:underline">
                        Preguntas Frecuentes
                    </a>
                </li>

                <li>
                    <p>Herramienta de accesibilidad disponible mediante el botón flotante UserWay.</p>
                </li>
            </ul>

            <!-- <img src="{{ asset('storage/img/certificados-iso.png') }}" alt="Certificados ISO" class="h-14"> -->

        </div>

        <!-- Columna 4: Certificaciones y redes -->
        <div class="space-y-4">
            <h3 class="font-bold text-lg">Políticas</h3>

            <ul class="space-y-1">
                <li>
                    <a href="https://aguasdelhuila.gov.co/archivos/documentos/politicas/terminos-y-condiciones-de-uso-2026" class="hover:underline">
                        Términos y Condiciones de Uso
                    </a>
                </li>

                <li>
                    <a href="https://aguasdelhuila.gov.co/archivos/documentos/politicas/politica-de-privacidad-y-tratamiento-de-datos-personales-2026" aria-label="Descargar Política de Tratamiento de Datos Personales en formato PDF" class="hover:underline">
                        Política de privacidad y tratamiento de datos personales
                    </a>
                </li>

                <li>
                    <a href="https://aguasdelhuila.gov.co/archivos/documentos/politicas/politica-de-derechos-de-autor-yo-autorizacion-de-uso-sobre-los-contenidos-2026" class="hover:underline">
                        Política de derechos de autor y/o autorización de uso sobre los contenidos
                    </a>
                </li>

                <li>
                    <a href="https://aguasdelhuila.gov.co/archivos/documentos/politicas/politica-de-administracion-y-uso-de-las-tecnologias-de-la-informacion-y-las-comunicaciones-2026" class="hover:underline">
                        Política de Administración y Uso de las Tecnologías de la Información y las Comunicaciones
                    </a>
                </li>

                <li>
                    <a href="https://aguasdelhuila.gov.co/archivos/documentos/gobierno-digital/politica-general-de-seguridad-y-privacidad-de-la-informacion" class="hover:underline">
                        Política general de seguridad
                    </a>
                </li>

                <li><a href="https://aguasdelhuila.gov.co/archivos/documentos/servicio-ciudadano/carta-de-trato-digno-2025" class="hover:underline" aria-label="Descargar Carta de Trato Digno al Usuario en formato PDF">Carta de Trato Digno al Usuario</a></li>
            </ul>
            
            <div class="flex flex-col items-start space-y-3">
                <h3 class="font-semibold text-2xl">Síguenos</h3>
                <div class="flex space-x-4">
                    <a href="https://web.facebook.com/aguasdelhuila" aria-label="Red facebook" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                    <a aria-label="Red X" href="https://x.com/AguasdelHuila" target="_blank" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2H21.5l-7.11 8.13L22.75 22h-6.54l-5.12-6.7L5.25 22H2l7.6-8.68L1.5 2h6.71l4.63 6.1L18.244 2Zm-1.14 18h1.8L7.23 3.89H5.3L17.104 20Z"/></svg></a>
                    <a aria-label="Instagram" href="https://www.instagram.com/aguasdelhuila/" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"> <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/> <path d="M16 11.37a4 4 0 1 1-4.63-4.63 4 4 0 0 1 4.63 4.63z"/> <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
                    <a aria-label="TikTok" href="https://www.tiktok.com/@aguasdelhuila" target="_blank" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.12v13.14a2.72 2.72 0 1 1-2.72-2.72c.27 0 .53.04.78.11V9.37a5.84 5.84 0 1 0 5.06 5.77V8.47a7.92 7.92 0 0 0 4.63 1.48V6.69h-.85z"/></svg></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Línea inferior -->
    <div class="text-center text-xs mt-10 border-t border-white/20 pt-4">
        © {{ date('Y') }} Aguas del Huila S.A. E.S.P. - Todos los derechos reservados.
    </div>
</footer>

<!-- BOTÓN FLOTANTE "IR ARRIBA" -->
<button id="scrollTopBtn" aria-label="Ir arriba"
    class="hidden fixed bottom-6 right-6 bg-[#0047DC] text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition transform hover:scale-110 cursor-pointer"
    onclick="scrollToTop()"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
    </svg>
</button>

<script>
    const scrollTopBtn = document.getElementById('scrollTopBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.remove('hidden');
        } else {
            scrollTopBtn.classList.add('hidden');
        }
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>
