<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Pintando a Super Agua</title>
        <style>

            /* Tarjeta principal */
            .contenedor {
                background: #ffffff;
                padding: 25px;
                border-radius: 16px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.08);
                display: flex;
                flex-direction: column;
                align-items: center;
                max-width: 100%;
            }

            h2.titulo-dibujo {
                color: #333;
                margin-top: 0;
                margin-bottom: 20px;
                font-size: 24px;
                text-align: center;
            }

            /* Panel de herramientas */
            .herramientas {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                align-items: center;
                justify-content: center;
                background: #f8fafc;
                padding: 15px 25px;
                border-radius: 12px;
                margin-bottom: 25px;
                border: 1px solid #e2e8f0;
                width: 100%;
                box-sizing: border-box;
            }

            /* Grupos individuales dentro de herramientas */
            .grupo {
                display: flex;
                align-items: center;
                gap: 10px;
                font-weight: 500;
                color: #475569;
            }

            /* Inputs personalizados */
            input[type="color"] {
                -webkit-appearance: none;
                border: none;
                width: 35px;
                height: 35px;
                border-radius: 50%;
                cursor: pointer;
                overflow: hidden;
                padding: 0;
            }
            input[type="color"]::-webkit-color-swatch-wrapper {
                padding: 0;
            }
            input[type="color"]::-webkit-color-swatch {
                border: 2px solid #cbd5e1;
                border-radius: 50%;
            }

            input[type="range"] {
                cursor: pointer;
            }

            .tamaño-label {
                min-width: 45px;
                font-size: 14px;
                color: #64748b;
            }

            /* Botones */
            .btn-grupo {
                display: flex;
                gap: 10px;
            }

            button {
                padding: 10px 18px;
                border: none;
                border-radius: 8px;
                font-size: 14px;
                font-weight: bold;
                cursor: pointer;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .btn-secundario {
                background-color: #f1f5f9;
                color: #475569;
                border: 1px solid #cbd5e1;
            }
            .btn-secundario:hover {
                background-color: #e2e8f0;
            }

            .btn-primario {
                background-color: #3b82f6;
                color: white;
                box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
            }
            .btn-primario:hover {
                background-color: #2563eb;
                box-shadow: 0 6px 12px rgba(59, 130, 246, 0.4);
                transform: translateY(-1px);
            }

            .btn-deshacer {
                background-color: #fef9c3;
                color: #854d0e;
                border: 1px solid #fde047;
            }
            .btn-deshacer:hover { background-color: #fef08a; }

            /* Lienzo */
            .canvas-contenedor {
                border: 3px dashed #cbd5e1;
                border-radius: 12px;
                padding: 10px;
                background: #f8fafc;
            }

            canvas {
                display: block;
                background-color: #fff;
                border-radius: 8px;
                cursor: crosshair;
                touch-action: none;
                max-width: 100%;
                box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            }

            /* Responsividad para móviles */
            @media (max-width: 600px) {
                .herramientas {
                    flex-direction: column;
                    align-items: stretch;
                }
                .btn-grupo {
                    justify-content: space-between;
                }
                button {
                    flex: 1;
                    justify-content: center;
                }
            }
        </style>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Pintando a Super Agua</h2>
                <p class="text-lg">
                    <a href="/" class="hover:text-[#00C81F]">Inicio</a> /
                    <a href="{{ route('transparencia') }}" class="hover:text-[#00C81F]">Transparencia y Acceso a la Información Pública</a> /
                    <span class="font-bold">Pintando a Super Agua</span>
                </p>
            </div>
        </div>
        
        <div class="px-2 lg:px-32 py-10">

            <div class="contenedor">
                <h2 class="titulo-dibujo">Dale color al superhéroe que nos enseña a proteger los recursos naturales</h2>
                
                <div class="herramientas">
                    <div class="grupo">
                        <label for="colorPicker" class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-palette preview-icon"><path d="M12 22a1 1 0 0 1 0-20 10 9 0 0 1 10 9 5 5 0 0 1-5 5h-2.25a1.75 1.75 0 0 0-1.4 2.8l.3.4a1.75 1.75 0 0 1-1.4 2.8z"/><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/></svg> Color:</label>
                        <input type="color" id="colorPicker" value="#00aaff">
                    </div>

                    <div class="grupo">
                        <label for="brushSize" class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-brush preview-icon"><path d="m11 10 3 3"/><path d="M6.5 21A3.5 3.5 0 1 0 3 17.5a2.62 2.62 0 0 1-.708 1.792A1 1 0 0 0 3 21z"/><path d="M9.969 17.031 21.378 5.624a1 1 0 0 0-3.002-3.002L6.967 14.031"/></svg> Grosor:</label>
                        <input type="range" id="brushSize" min="1" max="40" value="15">
                        <span id="brushSizeLabel" class="tamaño-label">15px</span>
                    </div>

                    <div class="btn-grupo">
                        <button id="btnDeshacer" class="btn-deshacer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-undo-2 preview-icon"><path d="M9 14 4 9l5-5"/><path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5a5.5 5.5 0 0 1-5.5 5.5H11"/></svg> Deshacer</button>
                        <button id="btnLimpiar" class="btn-secundario"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-brush-cleaning preview-icon"><path d="m16 22-1-4"/><path d="M19 14a1 1 0 0 0 1-1v-1a2 2 0 0 0-2-2h-3a1 1 0 0 1-1-1V4a2 2 0 0 0-4 0v5a1 1 0 0 1-1 1H6a2 2 0 0 0-2 2v1a1 1 0 0 0 1 1"/><path d="M19 14H5l-1.973 6.767A1 1 0 0 0 4 22h16a1 1 0 0 0 .973-1.233z"/><path d="m8 22 1-4"/></svg> Limpiar</button>
                        <button id="btnDescargar" class="btn-primario"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download preview-icon"><path d="M12 15V3"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/></svg> Descargar</button>
                    </div>
                </div>

                <div class="canvas-contenedor">
                    <canvas id="lienzo"></canvas>
                </div>
            </div>

        </div>

        <script>
            const canvas = document.getElementById('lienzo');
            const ctx = canvas.getContext('2d', { willReadFrequently: true });
            const brushSizeInput = document.getElementById('brushSize');
            const brushSizeLabel = document.getElementById('brushSizeLabel');
            
            let pintando = false;
            
            // Variables para el historial (Deshacer)
            let historial = [];
            let pasoActual = -1;

            brushSizeInput.addEventListener('input', (e) => {
                brushSizeLabel.textContent = e.target.value + 'px';
            });

            const img = new Image();
            img.src = '{{ asset('storage/img/supergota.jpg') }}'; 
            
            img.onload = () => {
                canvas.width = img.width;
                canvas.height = img.height;
                dibujarPlantilla();
                guardarEstado(); // Guarda la imagen en blanco como el paso 0
            };

            function dibujarPlantilla() {
                ctx.globalCompositeOperation = 'source-over';
                ctx.drawImage(img, 0, 0);
                ctx.globalCompositeOperation = 'multiply';
            }

            // Función para guardar el estado actual del canvas
            function guardarEstado() {
                // Si deshicimos pasos y empezamos a pintar de nuevo, borramos el "futuro"
                if (pasoActual < historial.length - 1) {
                    historial = historial.slice(0, pasoActual + 1);
                }
                // Guardamos los datos de los píxeles actuales
                historial.push(ctx.getImageData(0, 0, canvas.width, canvas.height));
                pasoActual++;
            }

            // Lógica del botón Deshacer
            document.getElementById('btnDeshacer').addEventListener('click', () => {
                if (pasoActual > 0) {
                    pasoActual--;
                    // Restauramos los píxeles del paso anterior
                    ctx.putImageData(historial[pasoActual], 0, 0);
                }
            });

            function iniciarTrazo(e) {
                pintando = true;
                dibujar(e);
            }

            function terminarTrazo() {
                if (pintando) {
                    pintando = false;
                    ctx.beginPath();
                    guardarEstado(); // Guardamos el estado justo al terminar de pintar un trazo
                }
            }

            function dibujar(e) {
                if (!pintando) return;
                e.preventDefault();

                const rect = canvas.getBoundingClientRect();
                let clientX = e.clientX || (e.touches && e.touches[0].clientX);
                let clientY = e.clientY || (e.touches && e.touches[0].clientY);
                
                const scaleX = canvas.width / rect.width;
                const scaleY = canvas.height / rect.height;
                
                const x = (clientX - rect.left) * scaleX;
                const y = (clientY - rect.top) * scaleY;

                ctx.lineWidth = brushSizeInput.value;
                ctx.lineCap = 'round';
                ctx.lineJoin = 'round';
                ctx.strokeStyle = document.getElementById('colorPicker').value;

                ctx.lineTo(x, y);
                ctx.stroke();
                ctx.beginPath();
                ctx.moveTo(x, y);
            }

            // Eventos de dibujo
            canvas.addEventListener('mousedown', iniciarTrazo);
            canvas.addEventListener('mouseup', terminarTrazo);
            canvas.addEventListener('mousemove', dibujar);
            canvas.addEventListener('mouseout', terminarTrazo);

            canvas.addEventListener('touchstart', iniciarTrazo, { passive: false });
            canvas.addEventListener('touchend', terminarTrazo);
            canvas.addEventListener('touchmove', dibujar, { passive: false });

            // Evento Limpiar (Ahora también se guarda en el historial)
            document.getElementById('btnLimpiar').addEventListener('click', () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                dibujarPlantilla();
                guardarEstado(); 
            });

            // Evento Descargar
            document.getElementById('btnDescargar').addEventListener('click', () => {
                const dataURL = canvas.toDataURL('image/png');
                const enlace = document.createElement('a');
                enlace.href = dataURL;
                enlace.download = 'Mi-Dibujo.png';
                document.body.appendChild(enlace);
                enlace.click();
                document.body.removeChild(enlace);
            });
        </script>

        @include('partials.footer')

    </body>
</html>
