<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @yield("head")
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>

<body>
  <header class="navbar navbar-light bg-light px-3 shadow-sm">
    <div class="d-flex align-items-left">
      <h1 class="navbar-brand card-title text-center" style="color: orange; font-weight: bold">BookHub</h1>
      <a class="navbar-brand card-title text-center" href="">Inicio</a>
      <a class="navbar-brand card-title text-center" href="">Perfil</a>
    </div>

    <div class="d-flex align-items-center">
      <div class="nav-item dropdown">
        <a href="#" role="button" data-bs-toggle="dropdown" class="nav-link dropdown-toggle d-flex align-items-center">
          {{ $username }}
          <img src="ProfilePictures/{{ $username }}.png" alt="Foto de perfil" class="rounded-circle ms-2" width="30" height="30">
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a href="#" class="dropdown-item">Ajustes de cuenta</a></li>
          <li><a href="#" class="dropdown-item text-danger">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </header>
  @yield("body")
</body>

</html>