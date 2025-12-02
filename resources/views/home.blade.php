@extends('header')
@section("head")
<title>Home</title>
<script type="module" src="/js/home.js"></script>
@endsection
@section("body")
<style>
    body {
        background-image: url("images/fondo1.jpg");
    }

    .form-control:focus {
        border-color: orange !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 102, 0, 0.25) !important;
    }

    .content-wrapper {
        height: 80vh;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        text-align: center;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        justify-content: center;
        margin-top: 70px;
    }

    #buscador {
        margin-top: 50px;
        max-width: 600px
    }
</style>

<div class="container content-wrapper">
   <form action="{{ route('search') }}" method="get" class="input-group shadow-sm" id="buscador">
        <div class="w-100 text-center">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white">
                    🔍
                </span>
                <input type="text" name="term" class="form-control" placeholder="Buscar...">
            </div>
        </div>
    </form>

    <h2 style="margin-top: 80px;">📚 Libros de la semana 📚</h2>
    <div class="card-container">

        <custom-bookcard olid="OL9142297M"></custom-bookcard>
        <custom-bookcard olid="OL9137997M"></custom-bookcard>
        <custom-bookcard olid="OL13275513M"></custom-bookcard>
        <custom-bookcard olid="OL13234064M"></custom-bookcard>

    </div>
</div>

@endsection