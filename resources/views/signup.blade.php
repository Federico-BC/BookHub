<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<body>
  <main class="card" role="main">
    <h1>Registro de usuario</h1>

    <form id="signupForm" action="{{ route('signupLogic') }}" method="post">
      @csrf
      <?php //dd($errors) ?>
      <div class="field">
        <label for="username">Nombre de usuario</label>
        <input class="input" id="username" name="username" type="text" placeholder="Tu usuario" required />
        @error("username")
        <p style="color:red">Nombre de usuario incorrecto</p>
        @enderror
        
        <label for="email">Correo electrónico</label>
        <input class="input" id="email" name="email" type="email" placeholder="tú@ejemplo.com" required />
        @error("email")
        <p style="color:red">Email incorrecto</p>
        @enderror
        
      </div>

      <div class="field password-wrap">
        <label for="password">Contraseña</label>
        <input class="input" id="password" name="password" type="password" placeholder="Tu contraseña" minlength="6" required />
        @error("password")
        <p style="color:red">La contraseña es incorrecta</p>
        @enderror

        <label for="password2">Repite la contraseña</label>
        <input class="input" id="password2" name="password2" type="password" placeholder="Tu contraseña" minlength="6" required />
        @error("password2")
        <p style="color:red">Las contraseñas no coinciden</p>
        @enderror
      </div>

      <button class="btn" type="submit" id="submitBtn">Entrar</button>
    </form>

    <footer>
      <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
    </footer>
  </main>

</body>
</html>