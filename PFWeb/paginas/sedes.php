<?php
include("../conexiones/conexion.php");
$sql2 = "SELECT s.id_sede, s.nombre_sede, s.telefono, s.activo, d.pais, d.direccion
        FROM sede s
        JOIN direccion d ON s.id_direccion = d.id_direccion";
$resultado2 = $conn->query($sql2);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administración de Sedes</title>
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
                        <a class="nav-link" href="../paginas/usuarios.php">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/roles.php">Roles</a>
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
    <div class="d-flex flex-column justify-content-center align-items-center mt-5" style="padding-left:120px;">
        <header class="fw-bold text-white fs-3 pb-3">Administración de sedes</header>

        <?php if (isset($_GET['ok'])): ?>
            <div class="alert alert-success mt-3" role="alert">
                Registro guardado correctamente.
            </div>
        <?php endif; ?>
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
        <form class="p-3 rounded shadow" style="background-color: rgba(33, 37, 41, 0.6);" action="../conexiones/registrarSede.php" method="POST">
            <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top:10px; width:300px;">
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Telefono:</label>
                    <input type="text" class="form-control" name="telefono"  required>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold" for="pais">Ingrese su país:</label><br>
                    <select name="pais" id="pais">
                        <option value="">Seleccione su pais</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Estados Unidos">Estados Unidos</option>
                        <option value="México">México</option>
                        <option value="Colombia">Colombia</option>
                        <option value="España">España</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Chile">Chile</option>
                        <option value="Perú">Perú</option>
                        <option value="Panamá">Panamá</option>
                        <option value="Canadá">Canadá</option>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold" for="dir">Ingrese su direccion:</label>
                    <input type="text" name="dir" class="form-control" placeholder="Ingrese su direccion" id="dir"  required>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold">
                        <input type="hidden" name="activo" value="0">
                        <input type="checkbox" name="activo" value="1">
                        Activo
                    </label>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
    <div class="d-flex flex-column align-items-center pt-5">
        <div class="container">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Pais</th>
                        <th>Direccion</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($dat = $resultado2->fetch_assoc()): ?>
                        <tr>
                            <td style="display:none;"><?= $dat['id_sede'] ?></td>
                            <td><?= $dat['nombre_sede'] ?></td>
                            <td><?= $dat['telefono'] ?></td>
                            <td><?= $dat['pais'] ?></td>
                            <td><?= $dat['direccion'] ?></td>
                            <td><?= $dat['activo'] ?></td>
                            <td><a class="btn btn-danger" href="../conexiones/eliminarSede.php?id_sede=<?= $dat['id_sede'] ?>">
                                <i class="bi bi-trash fs-5 text-white"></i>
                            </a>
                            <a class="btn btn-success" href="../paginas/modificarSede.php?id_sede=<?= $dat['id_sede'] ?>">
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