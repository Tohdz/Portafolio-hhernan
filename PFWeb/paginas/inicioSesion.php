<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../estilos/estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="inicioSesion">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/smarTrack.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/registroUsuarios.html">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/inicioSesion.php">Mi cuenta</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top:150px;">
        <header class="fw-bold text-white fs-2 pb-3">Inicio de sesión</header>
        <?php if (isset($_GET['ok'])): ?>
            <div class="alert alert-success mt-3" role="alert">
                Registro exitoso, Por favor inicie sesion.
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'created'): ?>
            <div class="alert alert-danger" role="alert">
                El usuario ya se encuentra creado.
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'db'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                Error en el guardado, informe lo antes posible.
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'notcreated'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                El usuario no existe, por favor registrarse.
            </div>
        <?php endif; ?>
        <form id="form" class="p-4 rounded shadow" style="background-color: rgba(33, 37, 41, 0.6);" action="../conexiones/inicioSesionBD.php" method="POST">
            <div class="mb-3 mt-3">
                <label class="form-label text-white fw-bold" for="user">Identificador de usuario:</label>
                <input type="email" name="email" class="form-control" placeholder="Ingrese su email" id="user" required>
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label text-white fw-bold" for="pass">Contraseña:</label>
                <input type="password" name="pass" class="form-control" placeholder="Ingrese su contraseña" id="pass" required>
            </div>
            <div class="mb-3 mt-3 text-center">
                <button type="submit" class="btn btn-warning">Iniciar sesion</button>
            </div>
        </form>
    </div>
</body>

</html>