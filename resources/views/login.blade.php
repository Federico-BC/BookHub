<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  <style>
    .form-control:focus {
      border-color: orange !important;
      box-shadow: 0 0 0 0.25rem rgba(255, 102, 0, 0.25) !important;
    }
  </style>
</head>

<body class="container pt-5">
  <main class="card mx-auto" style="width: 395px;" role="main">
    <div class="card-body justify-content-center px-4">
      <h2 class="card-title text-center" style="color: orange">BookHub</h2>
      <h5 class="card-subtitle mt-2 text-body-secondary">Inicio de sesión</h5>

    <form id="loginForm" action="{{ route('loginLogic') }}" method="post">
      @csrf
      <div class="field row justify-content-center py-2 mx-auto">
        <label for="username">Nombre de usuario</label>
        <input class="form-control" id="username" name="username" type="text" placeholder="Tu usuario" required />
      </div>

      <div class="field password-wrap">
        <div class="col">
          <label for="password">Contraseña</label>
          <input class="form-control" id="password" name="password" type="password" placeholder="Tu contraseña" minlength="6" required />
        </div>
      </div>

      @if (isset($error))
      <p>{{ $error }}</p>
      @endif

      <div class="d-grid mx-auto">
          <button class="btn btn-lg mt-2" style="color: white; background-color: orange; " type="submit" id="submitBtn">Entrar</button>
        </div>
    </form>

    <footer>
      <p class="text-end mt-2" style="font-size:smaller">¿No tienes cuenta? <a href="{{ route('signup') }}">Crear una</a></p>
    </footer>
    </div>
  </main>

</body>

</html>