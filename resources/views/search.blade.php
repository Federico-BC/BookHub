@extends('header')
@section("head")
<title>Resultados para: {{ $searchTerm }}</title>
<script type="module" src="/js/search.js"></script>
@endsection

@section("body")
<style>
    body{
        background-image: url("images/fondo1.jpg");
    }
    .book-title a {
        text-decoration: none;
        color: #000000;
        transition: color 0.2s ease-in-out;
    }

    .book-title a:hover {
        color: #ff8c32;
    }

    .book-img-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    img {
        max-height: 200px;
    }

    .results-box {
        max-width: 900px;
        margin: 0 auto;
    }
</style>

<div class="container py-4 results-box mt-4">
    <h3 class="mb-4">Resultados para: <span class="fw-bold">{{ $searchTerm }}</span></h3>

    @if ($booksFound)
    @foreach ($booksOlids as $olid )

    <custom-searchresult olid="{{ $olid }}"></custom-searchResult>
    
    @endforeach
    @else
    <h3 class="mb-4">No se han encontrado resultados</h3>
    @endif

</div>
@endsection
