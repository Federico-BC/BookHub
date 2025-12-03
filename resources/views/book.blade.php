@extends('header')

@section("head")
<title>{{ $title }}</title>
<script type="module" src="/js/home.js"></script>
@endsection

@section("body")
<style>
    body {
        background-image: url("../images/fondo1.jpg");
    }

    #mainDiv {
        margin-top: 70px;
    }
</style>

<div class="container" id="mainDiv">
    <div class="row">
        <div class="col-md-4 d-flex justify-content-center">
            <img src="https://covers.openlibrary.org/b/olid/{{ $olid }}-L.jpg" alt="Portada de {{ $title }}" class="img-fluid">
        </div>

        <div class="col-md-8">
            <h2 class="mb-4">{{ $title }}</h2>
            <p>
                <strong>Autor:</strong>
                {{ $authorName }}
            </p>
            <p><strong>Número de páginas:</strong> {{ $pages ?? 'Desconocido' }}</p>
            <p>
                <strong>Editorial:</strong>
                {{ is_array($publisher) ? implode(', ', $publisher) : ($publisher ?? 'Desconocido') }}
            </p>
            <p><strong>Código ISBN:</strong>
                @foreach($isbn as $code)
                {{ $code }}@if(!$loop->last), @endif
                @endforeach
            </p>

            <h4 class="mt-4">Descripción</h4>
            @if ($description)
            <p>{{ $description }}</p>
            @else
            <p>No disponible</p>
            @endif

            @if ($fav)
            <form action="{{ route('removeFav') }}" method="post">
                @csrf
                <input type="hidden" name="olid" value="{{ $olid }}">
                <button class="btn btn-lg mt-2" style="width: 100%; color: white; background-color: gray;" type="submit" id="submitBtn">Eliminar de favoritos</button>
            </form>
            @else
            <form action="{{ route('addFav') }}" method="post">
                @csrf
                <input type="hidden" name="olid" value="{{ $olid }}">
                <button class="btn btn-lg mt-2" style="width: 100%; color: white; background-color: orange;" type="submit" id="submitBtn">Añadir a favoritos</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection