<?php
include("../conexiones/conexion.php");
$sql = "SELECT id_casillero, dni FROM casillero";
$resultado = $conn->query($sql);
$sql2 = "SELECT p.id_paquete, p.referencia, p.peso, p.recibido, p.status, p.activo, c.dni, c.codigo
        FROM paquete p
        JOIN casillero c ON p.id_casillero = c.id_casillero";
$resultado2 = $conn->query($sql2);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administración de Paquetes</title>
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
                        <a class="nav-link" href="../paginas/sedes.php">Sedes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/casilleros.php">Casilleros</a>
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
        <header class="fw-bold text-white fs-3 pb-3">Administración de paquetes</header>

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
        <form class="p-3 rounded shadow" style="background-color: rgba(33, 37, 41, 0.6);" action="../conexiones/registrarPaquetes.php" method="POST">
            <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top:10px; width:300px;">
                <div class="mb-3 mt-3">
                    <label for="user" class="form-label text-white fw-bold">Usuario:</label>
                    <select class="form-select" id="user" name="user" required>
                        <option value="">Seleccione un usuario</option>
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                            <option value="<?= $fila['id_casillero'] ?>">
                                <?= $fila['dni'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Peso:</label>
                    <input type="number" step="0.01" class="form-control" name="peso" required>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold" for="fecha">Fecha:</label>
                    <input type="datetime-local" name="fecha" class="form-control" placeholder="Ingrese fecha" id="fecha">
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold" for="status">Ingrese status:</label><br>
                    <select name="status" id="status">
                        <option value="En tránsito(USA)">En tránsito(USA)</option>
                        <option value="Recibido/warehouse">Recibido/warehouse</option>
                        <option value="Procesado en centro logístico">Procesado en centro logístico</option>
                        <option value="Exportado">Exportado</option>
                        <option value="En tránsito internacional">En tránsito internacional</option>
                        <option value="En país destino">En país destino</option>
                        <option value="En revisión aduanera">En revisión aduanera</option>
                        <option value="Pendiente de documentación">Pendiente de documentación</option>
                        <option value="Impuestos calculados">Impuestos calculados</option>
                        <option value="Liberado por aduana">Liberado por aduana</option>
                        <option value="En ruta de entrega">En ruta de entrega</option>
                        <option value="Intento de entrega fallido">Intento de entrega fallido</option>
                        <option value="Disponible para retiro">Disponible para retiro</option>
                        <option value="Entregado">Entregado</option>
                    </select>
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
                        <th>Casillero</th>
                        <th>Usuario</th>
                        <th>Referencia</th>
                        <th>Peso</th>
                        <th>Fecha de modificacion</th>
                        <th>Estado</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($dat = $resultado2->fetch_assoc()): ?>
                        <tr>
                            <td style="display:none;"><?= $dat['id_paquete'] ?></td>
                            <td><?= $dat['codigo'] ?></td>
                            <td><?= $dat['dni'] ?></td>
                            <td><?= $dat['referencia'] ?></td>
                            <td><?= number_format((float)$dat['peso'], 2) ?></td>
                            <td><?= $dat['recibido'] ?></td>
                            <td><?= $dat['status'] ?></td>
                            <td><?= $dat['activo'] ?></td>
                            <td><a class="btn btn-danger" href="../conexiones/eliminarPaquetes.php?id_paquete=<?= $dat['id_paquete'] ?>">
                                    <i class="bi bi-trash fs-5 text-white"></i>
                                </a>
                                <a class="btn btn-success" href="../paginas/modificarPaquetes.php?id_paquete=<?= $dat['id_paquete'] ?>">
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