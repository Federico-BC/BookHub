<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro</title>
  <script src="/js/signup.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  <style>
    .form-control:focus {
      border-color: orange !important;
      box-shadow: 0 0 0 0.25rem rgba(255, 102, 0, 0.25) !important;
    }
    body{
      background-image: url("images/fondo2.jpg");
    }
    #color{
      background-color: rgba(238, 238, 238, 1);
    }
    
  </style>
</head>

<body class="container pt-5 ">
  <main class="card mx-auto" style="width: 395px;" role="main">
    <div class="card-body justify-content-center px-4" id="color">
      <h2 class="card-title text-center" style="color: orange">BookHub</h2>
      <h5 class="card-subtitle mt-2 text-body-secondary">Registro de usuario</h5>
      <form id="signupForm" action="{{ route('signupLogic') }}" method="post">
        @csrf
        <div class="field row justify-content-center py-2 mx-auto">
          <label for="username">Nombre de usuario</label>
          <input class="form-control" id="username" name="username" type="text" placeholder="Tu usuario" required @if (isset($forminfo)) value="{{ $forminfo["username"] }}" @else value="{{ old("username", "") }}" @endif />
          @error("username")
          <p class="text-danger">Nombre de usuario incorrecto</p>
          @enderror
          @if (isset($forminfo)&& in_array("username", $forminfo["error"]))
          <p class="text-danger">Nombre de usuario ya en uso</p>
          @endif
        </div>

        <div class="field row justify-content-center mx-auto">
          <label for="email">Correo electrónico</label>
          <input class="form-control" id="email" name="email" type="email" placeholder="tú@ejemplo.com" required @if (isset($forminfo)) value="{{ $forminfo["email"] }}" @else value="{{ old("email", "") }}" @endif />
          @error("email")
          <p class="text-danger">Email incorrecto</p>
          @enderror
          @if (isset($forminfo)&& in_array("email", $forminfo["error"]))
          <p class="text-danger">Email ya en uso</p>
          @endif
        </div>

        <div id="passDiv" class="field password-wrap row ">
          <div class="col">
            <label for="password" class="px-2">Contraseña</label>
            <input class="form-control" id="password" name="password" type="password" placeholder="Tu contraseña" minlength="8" required />
          </div>

          <div class="col">
            <label for="password2" class="px-2">Repite la contraseña</label>
            <input class="form-control" id="password2" name="password2" type="password" placeholder="Tu contraseña" minlength="8" required />
          </div>
        </div>
        @error("password")
        <p class="text-danger">La contraseña debe tener minimo 8 caracteres incluyendo un numero, una minuscula y una mayuscula</p>
        @enderror

        @error("password2")
        <p class="text-danger">Las contraseñas no coinciden</p>
        @enderror
        <div class="d-grid mx-auto">
          <button class="btn btn-lg mt-2" style="color: white; background-color: orange; " type="submit" id="submitBtn">Entrar</button>
        </div>
      </form>

      <footer>
        <p class="text-end mt-2" style="font-size:smaller">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
      </footer>
    </div>
  </main>

</body>

</html>