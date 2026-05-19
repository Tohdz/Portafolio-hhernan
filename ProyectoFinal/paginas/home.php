<?php
// Inicio de sesion
session_start();
$_SESSION["email"];

include("../conexiones/conexion.php");
$sql2 = "SELECT p.referencia, p.peso, p.recibido, p.status FROM usuarios u JOIN casillero c ON u.dni=c.dni JOIN paquete p ON c.id_casillero=p.id_casillero where u.correo = '{$_SESSION['email']}' AND p.activo= true";
$resultado2 = $conn->query($sql2);
$sql0 = "SELECT u.nombre, u.telefono,c.codigo, d.pais, d.direccion FROM usuarios u JOIN casillero c ON u.dni=c.dni JOIN direccion d ON c.id_direccion=d.id_direccion where u.correo = '{$_SESSION['email']}'";
$resultado0 = $conn->query($sql0);
$datos = $resultado0->fetch_assoc();
$sql = "SELECT roles.nombre FROM usuarios JOIN roles ON usuarios.dni = roles.dni where usuarios.correo = '{$_SESSION['email']}'";
$resultado = $conn->query($sql);
$roles = [];
while ($row = $resultado->fetch_assoc()) {
    $roles[] = $row['nombre'];
}
$_SESSION["roles"] = $roles;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="home">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <?php if (in_array("Client", $_SESSION["roles"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/modificarCliente.php">Mi Perfil</a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array("Courier", $_SESSION["roles"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/courier.php">Entregas</a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array("Admin", $_SESSION["roles"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/usuarios.php">Usuarios</a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array("Admin", $_SESSION["roles"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/roles.php">Roles</a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array("Admin", $_SESSION["roles"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/sedes.php">Sedes</a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array("Admin", $_SESSION["roles"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/casilleros.php">Casilleros</a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array("Admin", $_SESSION["roles"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/paquetes.php">Paquetes</a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array("Admin", $_SESSION["roles"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/servicios.php">Orden de servicios</a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array("Admin", $_SESSION["roles"])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../paginas/facturas.php">Facturas</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <span class="navbar-text text-white me-3">
                    <i class="fa fa-user"></i> <?php echo $_SESSION["email"]; ?>
                </span>
                <a href="../conexiones/cerrarSesion.php" class="btn btn-outline-light"><i class="fa fa-sign-out" style="font-size:24px"></i></a>
            </div>
        </div>
    </nav>
    <?php if (in_array("Client", $_SESSION["roles"])): ?>
        <div class="p-3 rounded shadow col-md-4 m-4" style="background-color: rgba(33, 37, 41, 0.6);">
            <h1 class="text-white pb-3">Datos de usuario</h1>
            <H5 class="text-white">Nombre: <?= $datos['nombre'] ?></H5>
            <H5 class="text-white">Casillero: <?= $datos['codigo'] ?></H5>
            <H5 class="text-white">Direccion 1: <?= $datos['pais'] ?></H5>
            <H5 class="text-white">Direccion 2: <?= $datos['direccion'] ?></H5>
            <H5 class="text-white">Telefono: <?= $datos['telefono'] ?></H5>
        </div>
        <div class="d-flex flex-column align-items-center pt-5">
            <div class="container">
                <h1 class="text-white text-center pb-3">Paquetes activos</h1>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Numero de referencia</th>
                            <th>Peso</th>
                            <th>Fecha de modificacion</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($dat = $resultado2->fetch_assoc()): ?>
                            <tr>
                                <td><?= $dat['referencia'] ?></td>
                                <td><?= $dat['peso'] ?></td>
                                <td><?= $dat['recibido'] ?></td>
                                <td><?= $dat['status'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
    <!-- <script>
        let roles = <?php echo json_encode($_SESSION["roles"]); ?>;
        console.log(roles);
    </script> -->
</body>

</html>