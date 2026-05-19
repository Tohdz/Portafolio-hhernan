<?php
include("../conexiones/conexion.php");

$sql = "SELECT u.correo, c.codigo, p.referencia, p.peso, p.recibido, p.status, p.id_paquete  
FROM usuarios u JOIN casillero c ON u.dni = c.dni JOIN paquete p ON c.id_casillero=p.id_casillero
WHERE p.activo=true AND p.status IN ('Liberado por aduana', 'En ruta de entrega', 'Intento de entrega fallido', 'Disponible para retiro', 'Entregado')";
$resultado = $conn->query($sql);
$sql2 = "SELECT 
    os.id_ord_serv,
    os.fecha_hora,
    os.comentarios,
    os.activo,
    s.nombre_sede,
    p.referencia
FROM ordenServicio os
JOIN sede s 
    ON os.id_sede = s.id_sede
JOIN paquete p 
    ON os.id_paquete = p.id_paquete
WHERE os.activo=true";
$resultado2 = $conn->query($sql2);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modificación de usuarios</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="imagenAdmin">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../paginas/home.php">
                <i class="bi bi-arrow-left fs-4 text-white"></i>
            </a>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5" style="padding-left:120px;">
        <header class="fw-bold text-white fs-3 pb-3">Servicios de Entrega</header>
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
        <div class="container">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Usuario</th>
                        <th>Casillero</th>
                        <th>Numero de referencia</th>
                        <th>Peso</th>
                        <th>Fecha de modificacion</th>
                        <th>Status</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($dat = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td style="display:none;"><?= $dat['id_paquete'] ?></td>
                            <td><?= $dat['correo'] ?></td>
                            <td><?= $dat['codigo'] ?></td>
                            <td><?= $dat['referencia'] ?></td>
                            <td><?= $dat['peso'] ?></td>
                            <td><?= $dat['recibido'] ?></td>
                            <td><?= $dat['status'] ?></td>
                            <td>
                                <a class="btn btn-dark" href="../paginas/serviciosCourier.php?id_paquete=<?= $dat['id_paquete'] ?>">
                                    <i class="bi bi-clipboard2-fill fs-5 text-white"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5" style="padding-left:120px;">
        <header class="fw-bold text-white fs-3 pb-3">Facturacion</header>
        <div class="container">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Sede</th>
                        <th>Numero de referencia</th>
                        <th>Fecha de modificacion</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($dat = $resultado2->fetch_assoc()): ?>
                        <tr>
                            <td style="display:none;"><?= $dat['id_ord_serv'] ?></td>
                            <td><?= $dat['nombre_sede'] ?></td>
                            <td><?= $dat['referencia'] ?></td>
                            <td><?= $dat['fecha_hora'] ?></td>
                            <td><?= $dat['comentarios'] ?></td>
                            <td>
                                <a class="btn btn-dark" href="../paginas/facturaServicio.php?id_ord_serv=<?= $dat['id_ord_serv'] ?>">
                                    <i class="bi bi-receipt fs-5 text-white"></i>
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