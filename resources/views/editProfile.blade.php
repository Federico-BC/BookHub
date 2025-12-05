@extends('header')

@section("head")
<title>{{ $username }}</title>
<script type="module" src="/js/profile.js"></script>
@endsection

@section("body")
<style>
    body {
        background-image: url("../images/fondo1.jpg"); 
    }
    .form-control:focus {
      border-color: orange !important;
      box-shadow: 0 0 0 0.25rem rgba(255, 102, 0, 0.25) !important;
    }

    .fixed-card {
        width: 546px !important;
        height: 402.8px !important;
    }

    .profile-pic {
        width: 120px !important;
        height: 120px !important;
        min-width: 120px !important;
        min-height: 120px !important;
        max-width: 120px !important;
        max-height: 120px !important;
        border-radius: 50%;
        object-fit: cover;
    }

    .card {
        border-radius: 12px;
    }

    .btn-orange {
        background-color: #ff7b00;
        border-color: #ff7b00;
        color: white;
    }
    .btn-orange:hover {
        background-color: #e96f00;
        border-color: #e96f00;
        color: white;
    }
</style>

<div class="container py-5">
    <h2 class="text-center mb-4">Editar Datos de Cuenta</h2>

    <div class="row g-4 justify-content-center mt-5">

        <div class="col-md-6 d-flex justify-content-center">
            <div class="card shadow-sm p-4 fixed-card">
                <h4 class="mb-3">Datos Actuales</h4>

                <div class="text-center mb-3">
                    <img src="{{ $pfp ?? "/ProfilePictures/$username.png" }}" 
                         class="profile-pic"
                         alt="Foto actual">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control" value="{{ $username }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Correo</label>
                    <input type="email" class="form-control" value="{{ $email }}" disabled>
                </div>
            </div>
        </div>

        <div class="col-md-6 d-flex justify-content-center">
            <div class="card shadow-sm p-4 fixed-card">
                <h4 class="mb-3">Actualizar Datos</h4>

                <form action="{{ route('saveProfileChanges') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nueva Foto de Perfil</label>
                        <input type="file" name="newPfp" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nuevo Nombre</label>
                        <input type="text" name="newUsername" class="form-control" placeholder="Escribe tu nuevo nombre">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nuevo Correo</label>
                        <input type="email" name="newEmail" class="form-control" placeholder="Escribe tu nuevo correo">
                    </div>

                    <button type="submit" class="btn btn-orange w-100">Guardar Cambios</button>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
