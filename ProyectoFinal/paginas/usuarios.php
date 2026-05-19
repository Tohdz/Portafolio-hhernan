<?php
include("../conexiones/conexion.php");
$sql2 = "SELECT dni,nombre,contrasena,correo,telefono, activo FROM usuarios";
$resultado2 = $conn->query($sql2);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administracion de Usuarios</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="imagenAdmin">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../paginas/home.php">
                <i class="bi bi-arrow-left fs-4 text-white"></i>
            </a>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/roles.php">Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/sedes.php">Sedes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/casilleros.php">Casilleros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/paquetes.php">Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/servicios.php">Orden de servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/facturas.php">Facturas</a>
                    </li>
                </ul>
                <a href="../conexiones/cerrarSesion.php" class="btn btn-outline-light"><i class="fa fa-sign-out" style="font-size:24px"></i></a>
            </div>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-center align-items-start mt-5" style="padding-left:120px;">
        <header class="fw-bold text-white fs-3">Administración de Usuarios</header>
        <?php if (isset($_GET['delete'])): ?>
            <div class="alert alert-success mt-3" role="alert">
                Registro eliminado correctamente.
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'db'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                Error en el guardado, informe lo antes posible.
            </div>
        <?php endif; ?>
    </div>
    <div class="d-flex flex-column align-items-center pt-5">
        <div class="container">
            <table class="table table-striped table-hover table-bordered bg-transparent">
                <thead class="table-dark">
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Contraseña</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($dat = $resultado2->fetch_assoc()): ?>
                        <tr>
                            <td><?= $dat['dni'] ?></td>
                            <td><?= $dat['nombre'] ?></td>
                            <td><?= $dat['contrasena'] ?></td>
                            <td><?= $dat['correo'] ?></td>
                            <td><?= $dat['telefono'] ?></td>
                            <td><?= $dat['activo'] ?></td>
                            <td><a class="btn btn-danger" href="../conexiones/eliminarUser.php?dni=<?= $dat['dni'] ?>">
                                    <i class="bi bi-trash fs-5 text-white"></i>
                                </a>
                                <a class="btn btn-success" href="../paginas/modificarUser.php?dni=<?= $dat['dni'] ?>">
                                    <i class="bi bi-pencil-square fs-5 text-white"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>