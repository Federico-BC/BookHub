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
  <a class="navbar-brand mb-0 h1" href="#">
    BookHub
  </a>

  <div class="d-flex align-items-center">
    <button class="btn btn-outline-secondary btn-sm me-2">
      <span class="navbar-toggler-icon"></span>
    </button>
    <button class="btn btn-outline-secondary btn-sm">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</header>
@yield("body")
</body>
</html>