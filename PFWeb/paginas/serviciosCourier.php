<?php
include("../conexiones/conexion.php");

$id = $_GET['id_paquete'];

$sql = "SELECT id_sede, nombre_sede FROM sede";
$resultado = $conn->query($sql);
$sql1 = "SELECT id_paquete, referencia FROM paquete WHERE activo=true AND id_paquete='$id'";
$resultado1 = $conn->query($sql1);
$servicio = $resultado1->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administración de Ordenes</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="imagenAdmin">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../paginas/courier.php">
                <i class="bi bi-arrow-left fs-4 text-white"></i>
            </a>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5" style="padding-left:120px;">
        <header class="fw-bold text-white fs-3 pb-2">Registro de servicio</header>
        <form class="p-3 rounded shadow" style="background-color: rgba(33, 37, 41, 0.6);" action="../conexiones/servicioCourier.php" method="POST">
            <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top:10px; width:300px;">
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold" for="status">Ingrese status:</label><br>
                    <select name="status" id="status">
                        <option value="En ruta de entrega">En ruta de entrega</option>
                        <option value="Intento de entrega fallido">Intento de entrega fallido</option>
                        <option value="Entregado">Entregado</option>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="sede" class="form-label text-white fw-bold">Sede:</label>
                    <select class="form-select" id="sede" name="sede" required>
                        <option value="">Seleccione una sede</option>
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                            <option value="<?= $fila['id_sede'] ?>">
                                <?= $fila['nombre_sede'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold" for="ref">Referencia:</label><br>
                    <select class="form-select" id="ref" name="ref" required>
                        <option value="<?= $servicio['id_paquete'] ?>"><?= $servicio['referencia'] ?></option>
                        <?php while ($fila = $resultado1->fetch_assoc()): ?>
                            <option value="<?= $fila['id_paquete'] ?>">
                                <?= $fila['referencia'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold" for="fecha">Fecha:</label>
                    <input type="datetime-local" name="fecha" class="form-control" placeholder="Ingrese fecha" id="fecha">
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Comentarios:</label>
                    <input type="textfield" class="form-control" name="coments" required>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</body>
</html>