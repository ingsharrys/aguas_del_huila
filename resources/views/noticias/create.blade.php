@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Noticia</h1>

    <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea name="contenido" class="form-control" rows="6" required></textarea>
        </div>

        <div class="mb-3">
            <label for="imagen_portada" class="form-label">Imagen Portada</label>
            <input type="file" name="imagen_portada" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
