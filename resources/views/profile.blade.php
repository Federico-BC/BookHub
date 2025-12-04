@extends('header')

@section("head")
<title>{{ $profileUsername }}</title>
<script type="module" src="/js/profile.js"></script>
@endsection

@section("body")
<style>
    body {
        background-image: url("../images/fondo1.jpg"); 
    }
    .profile-header {
        background: linear-gradient(135deg, #ffa939ff 0%, #83532bff 100%); 
        color: white;
        padding: 40px 0;
        margin-bottom: 30px;
        border-radius: 0 0 10px 10px; 
    }
    .profile-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .book-cover {
        height: 200px;
        object-fit: cover;
        margin-bottom: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }
    .book-cover:hover {
        transform: translateY(-5px); 
    }
    .book-title {
        height: 3em; 
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }
</style>

<div class="profile-header">
    <div class="container text-center">
        <img src="/ProfilePictures/{{ $profileUsername }}.png" class="rounded-circle profile-img mb-3" alt="Foto de Perfil">
        
        <h1 class="display-5">{{ $profileUsername}}</h1>
        
        <p class="lead">{{ $email }}</p>
    </div>
</div>

<div class="container">
    
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">📚 Libros Favoritos</h2>
            <hr class="mb-4">
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        @foreach ($favs as $favOlid)
        <custom-profilebookcard olid="{{ $favOlid }}"></custom-profilebookcard>
        @endforeach
    </div>
    <div class="my-5 text-center">
        <button class="btn btn-outline-secondary">Editar Perfil</button>
    </div>
</div>
@endsection