@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Noticias</h1>
    <a href="{{ route('noticias.create') }}" class="btn btn-primary mb-3">Nueva Noticia</a>

    @foreach($noticias as $noticia)
        <div class="card mb-3">
            @if($noticia->imagen_portada)
                <img src="{{ asset('storage/'.$noticia->imagen_portada) }}" class="card-img-top" alt="{{ $noticia->titulo }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                <p class="card-text">{{ Str::limit(strip_tags($noticia->contenido), 200) }}</p>
                <p class="text-muted">Por {{ $noticia->autor->name }}</p>
                <a href="{{ route('noticias.edit', $noticia) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('noticias.destroy', $noticia) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach

    {{ $noticias->links() }}
</div>
@endsection
