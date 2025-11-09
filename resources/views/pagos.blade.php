<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Pagos en Línea</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Pagos en Línea</h2>
                <p class="text-lg">Inicio </span class="font-bold"> / Pagos en Línea</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="grid grid-cols-2 gap-8 px-2 md:px-32 py-8 font-bold text-center">
                
                <div class="flex flex-col justify-center items-center">
                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">Pagos Facturas Wompi</h3>
                    <a href="https://procesos.aguasdelhuila.gov.co/pago/buscar" target="_blank" class="block w-100 h-auto">
                        <img src="{{ asset('storage/img/Pago_factura_Wompi.webp') }}" 
                            alt="Pagos Factura con Wompi" title="Pagos Factura con Wompi" 
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex flex-col justify-center items-center">
                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">Pagos Facturas PSE</h3>
                    <a href="https://procesos.aguasdelhuila.gov.co/pago/buscar" target="_blank" class="block w-100 h-auto">
                        <img src="{{ asset('storage/img/pagos_factura_pse.webp') }}" 
                        alt="Pagos Factura con PSE" title="Pagos Factura con PSE" 
                        class="w-full h-full object-contain">
                    </a>
                    <h3 class="text-xl font-bold text-black">Compra de medidores e insumos químicos</h3>
                </div>
            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
