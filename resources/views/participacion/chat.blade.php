<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Chat</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Chat</h2>
                <p class="text-lg">Inicio / Participa </span class="font-bold"> / Chat</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

        <p>
	<style type="text/css">
.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }	</style>
</p>
<div class="embed-container">
	<iframe allowtransparency="true" height="500" src="https://minnit.chat/Aguas?embed" style="border:none;" width="1000"></iframe><br />
	<a href="https://minnit.chat/Aguas" target="_blank">Free HTML5 Chatroom powered by Minnit Chat</a></div>

        </section>

        @include('partials.footer')

    </body>
</html>
