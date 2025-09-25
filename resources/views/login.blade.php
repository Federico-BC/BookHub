<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<body>
  <main class="card" role="main">
    <h1>Inicia sesión</h1>

    <form id="loginForm" action="#" method="post">
      @csrf
      <div class="field">
        <label for="username">Nombre de usuario</label>
        <input class="input" id="username" name="username" type="text" placeholder="Tu usuario" required />
      </div>

      <div class="field password-wrap">
        <label for="password">Contraseña</label>
        <input class="input" id="password" name="password" type="password" placeholder="Tu contraseña" minlength="6" required />
      </div>

      <button class="btn" type="submit" id="submitBtn">Entrar</button>
    </form>

    <footer>
      <p>¿No tienes cuenta? <a href="{{ route('signup') }}">Crear una</a></p>
    </footer>
  </main>

</body>
</html>
