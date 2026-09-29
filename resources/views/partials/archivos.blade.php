@foreach($archivos as $file)
<li class="flex flex-col sm:flex-row gap-2 justify-between py-4">
    <div class="flex gap-4 pr-4">
        <svg xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2">
            <path d="m15 10 5 5-5 5"/>
            <path d="M4 4v7a4 4 0 0 0 4 4h12"/>
        </svg>

        <a href="{{ route('posts.document', [$file->post->slug, $file->slug]) }}"
           class="text-black hover:text-[#0047DC]">
            {{ $file->nombre }}
        </a>
    </div>

    <div class="flex gap-2">

        <a href="{{ route('posts.document', [$file->post->slug, $file->slug]) }}" class="flex w-48 px-4 py-2 rounded-lg bg-[#0047DC] hover:bg-blue-900 text-white justify-center gap-2">
            Visualizar
        </a>

        <a href="{{ asset('storage/'.$file->archivo) }}"
           download
           class="flex w-48 px-4 py-2 rounded-lg bg-[#00C81F] hover:bg-green-700 text-white justify-center gap-2">
            Descargar
        </a>

    </div>
</li>
@endforeach