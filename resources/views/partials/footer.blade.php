<footer class="bg-[#0047DC] text-white pt-12 pb-4 px-4 lg:px-32 text-sm shadow-md">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

        <!-- Columna 1: Información institucional -->
        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/img/logo-aguas-huila-white.png') }}" alt="Aguas del Huila" title="Aguas del Huila" class="h-auto">
                <img src="{{ asset('storage/img/logo-gobernacion-white.png') }}" alt="Gobernación del Huila" title="Gobernación del Huila" class="h-auto">
            </div>

            <div>
                <p class="font-bold text-lg">Aguas Del Huila S.A. E.S.P.</p>
                <p>NIT 800.100.553-2</p>
                <p>Dirección: Calle 21 No. 1C - 17 Neiva (Huila) - Colombia</p>
                <p>Código Postal: 410010</p>
                <p>Teléfono de Contacto: (+57) 608-8753181</p>
                <p>Línea Gratuita: 01 8000 952858</p>
                <p>Correo Electrónico: Radicación de Correspondencia y PQR en la Web</p>
            </div>
        </div>

        <!-- Columna 2: Sede y horarios -->
        <div class="space-y-4">
            <div>
                <p class="font-bold text-lg">Sede Principal:</p>
                <p>Calle 21 No. 1C - 17</p>
                <a href="https://maps.app.goo.gl/uie1wGNNpJ7UNiBV6" target="_blank" class="underline">Ubicación</a>
            </div>

            <div>
                <p class="font-bold text-lg">Horarios de Atención</p>
                <p>Lunes a Jueves: Mañana 7AM a 12M - Tarde 2PM a 6PM</p>
                <p>Viernes: Mañana 7AM a 12M - Tarde 2PM a 5PM</p>
            </div>

            <div>
                <a href="{{ route('oficinas') }}" target="_blank" class="font-bold text-lg text-white hover:text-gray">Sedes</a>
                <ul class="space-y-1">
                    <li>Correo Electrónico para Notificaciones Judiciales</li>
                    <li><a href="mailto:notificacionesjudiciales@aguasdelhuila.gov.co" class="hover:underline">notificacionesjudiciales@aguasdelhuila.gov.co</a></li>
                    <li><a href="/storage/posts/archivos/politicas/6.%20Politica%20de%20tratamiento%20de%20datos.pdf" target="_blank" class="hover:underline">Política de Tratamiento de Datos Personales</a></li>
                    <li><a href="/storage/posts/archivos/atencion_ciudadano/CARTA%20DEL%20TRATO%20DIGNO%20AGUAS%20DEL%20HUILA.pdf" target="_blank" class="hover:underline">Carta de Trato Digno al Usuario</a></li>
                </ul>
            </div>
        </div>

        <!-- Columna 3: Certificaciones y redes -->
        <div class="flex flex-col justify-between h-full">
            <img src="{{ asset('storage/img/certificados-iso.png') }}" alt="Certificados ISO" title="Certificados ISO" class="h-14 mb-6">

            <div class="flex flex-col items-start space-y-3">
                <p class="font-semibold text-2xl">Síguenos</p>
                <div class="flex space-x-4">
                    <a href="https://web.facebook.com/aguasdelhuila" target="_blank" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                    <a href="https://x.com/AguasdelHuila" target="_blank" class="hover:text-gray-100"><svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter-icon lucide-twitter"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg></a>
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
<button id="scrollTopBtn" 
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
