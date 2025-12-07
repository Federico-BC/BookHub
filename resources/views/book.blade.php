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

    .button-row {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .button-row form {
        flex: 1;
    }
</style>

<div class="container" id="mainDiv">
    <div class="row">
        <div class="col-md-4 d-flex justify-content-center">
            <img src="https://covers.openlibrary.org/b/olid/{{ $olid }}-L.jpg" 
                 alt="Portada de {{ $title }}" 
                 class="img-fluid">
        </div>

        <div class="col-md-8">
            <h2 class="mb-4">{{ $title }}</h2>

            <p><strong>Autor:</strong> {{ $authorName }}</p>
            <p><strong>Número de páginas:</strong> {{ $pages ?? 'Desconocido' }}</p>
            <p><strong>Editorial:</strong> 
                {{ is_array($publisher) ? implode(', ', $publisher) : ($publisher ?? 'Desconocido') }}
            </p>
            <p><strong>Código ISBN:</strong>
                @foreach($isbn as $code)
                    {{ $code }}@if(!$loop->last), @endif
                @endforeach
            </p>

            <h4 class="mt-4">Descripción</h4>
            <p>{{ $description ?? "No disponible" }}</p>

            <div class="button-row">

                @if ($fav)
                <form action="{{ route('removeFav') }}" method="post">
                    @csrf
                    <input type="hidden" name="olid" value="{{ $olid }}">
                    <input type="hidden" name="listCode" value="1">
                    <button class="btn btn-lg" style="width: 100%; color: white; background-color: gray;" type="submit">
                        Quitar de favoritos
                    </button>
                </form>
                @else
                <form action="{{ route('addFav') }}" method="post">
                    @csrf
                    <input type="hidden" name="olid" value="{{ $olid }}">
                    <input type="hidden" name="listCode" value="1">
                    <button class="btn btn-lg" style="width: 100%; color: white; background-color: orange;" type="submit">
                        Añadir a favoritos
                    </button>
                </form>
                @endif

                @if ($read)
                <form action="{{ route('removeFav') }}" method="post">
                    @csrf
                    <input type="hidden" name="olid" value="{{ $olid }}">
                    <input type="hidden" name="listCode" value="2">
                    <button class="btn btn-lg" style="width: 100%; color: white; background-color: gray;" type="submit">
                        Quitar de leídos
                    </button>
                </form>
                @else
                <form action="{{ route('addFav') }}" method="post">
                    @csrf
                    <input type="hidden" name="olid" value="{{ $olid }}">
                    <input type="hidden" name="listCode" value="2">
                    <button class="btn btn-lg" style="width: 100%; color: white; background-color: green;" type="submit">
                        Ya leído
                    </button>
                </form>
                @endif

                @if ($toRead)
                <form action="{{ route('removeFav') }}" method="post">
                    @csrf
                    <input type="hidden" name="olid" value="{{ $olid }}">
                    <input type="hidden" name="listCode" value="3">
                    <button class="btn btn-lg" style="width: 100%; color: white; background-color: gray;" type="submit">
                        Quitar "por leer"
                    </button>
                </form>
                @else
                <form action="{{ route('addFav') }}" method="post">
                    @csrf
                    <input type="hidden" name="olid" value="{{ $olid }}">
                    <input type="hidden" name="listCode" value="3">
                    <button class="btn btn-lg" style="width: 100%; color: white; background-color: royalblue;" type="submit">
                        Quiero leer
                    </button>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
