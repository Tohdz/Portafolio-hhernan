<?php
include("../conexiones/conexion.php");

$sql = "SELECT os.id_ord_serv, p.referencia
        FROM ordenServicio os
        JOIN paquete p ON os.id_paquete = p.id_paquete";
$resultado = $conn->query($sql);
$sql1 = "SELECT df.id_det_fact, p.referencia, df.precio_unitario, f.precio_final, f.fecha_hora, s.nombre_sede, os.comentarios
        FROM paquete p
        JOIN ordenservicio os ON os.id_paquete = p.id_paquete JOIN detallefactura df ON os.id_ord_serv=df.id_ord_serv JOIN factura f ON df.id_fact=f.id_fact JOIN sede s ON s.id_sede=os.id_sede";
$resultado1 = $conn->query($sql1);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administración de Facturas</title>
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
                        <a class="nav-link" href="../paginas/paquetes.php">Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/servicios.php">Orden de servicios</a>
                    </li>
                </ul>
                <a href="../conexiones/cerrarSesion.php" class="btn btn-outline-light"><i class="fa fa-sign-out" style="font-size:24px"></i></a>
            </div>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5" style="padding-left:120px;">
        <header class="fw-bold text-white fs-3 pb-2">Administración de facturas</header>

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
        <form class="p-3 rounded shadow" style="background-color: rgba(33, 37, 41, 0.6);" action="../conexiones/registrarFactura.php" method="POST">
            <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top:10px; width:300px;">
                <div class="mb-3 mt-3">
                    <label for="ref" class="form-label text-white fw-bold">Referencia:</label>
                    <select class="form-select" id="ref" name="ref" required>
                        <option value="">Seleccione una referencia</option>
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <option value="<?= $fila['id_ord_serv'] ?>">
                            <?= $fila['referencia'] ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold" for="precio">Precio unitario:</label>
                    <input type="text" name="precio" class="form-control" placeholder="Ingrese precio" id="precio" required>
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
                        <th>Referencia</th>
                        <th>Precio unitario</th>
                        <th>Precio total</th>
                        <th>Fecha de facturacion</th>
                        <th>Sede</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($dat = $resultado1->fetch_assoc()): ?>
                        <tr>
                            <td style="display:none;"><?= $dat['id_det_fact'] ?></td>
                            <td><?= $dat['referencia'] ?></td>
                            <td><?= $dat['precio_unitario'] ?></td>
                            <td><?= $dat['precio_final'] ?></td>
                            <td><?= $dat['fecha_hora'] ?></td>
                            <td><?= $dat['nombre_sede'] ?></td>
                            <td><?= $dat['comentarios'] ?></td>
                            <td><a class="btn btn-danger" href="../conexiones/eliminarFacturas.php?id_det_fact=<?= $dat['id_det_fact'] ?>">
                                <i class="bi bi-trash fs-5 text-white"></i>
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