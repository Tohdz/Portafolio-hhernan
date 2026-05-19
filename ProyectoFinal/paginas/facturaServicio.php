<?php
include("../conexiones/conexion.php");

$id = $_GET['id_ord_serv'];

$sql = "SELECT os.id_ord_serv, p.referencia
        FROM ordenServicio os
        JOIN paquete p ON os.id_paquete = p.id_paquete WHERE os.id_ord_serv='$id'";
$resultado = $conn->query($sql);
$fact = $resultado->fetch_assoc();
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
            <a class="navbar-brand" href="../paginas/courier.php">
                <i class="bi bi-arrow-left fs-4 text-white"></i>
            </a>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5" style="padding-left:120px;">
        <header class="fw-bold text-white fs-3 pb-2">Registro de facturas</header>
        <form class="p-3 rounded shadow" style="background-color: rgba(33, 37, 41, 0.6);" action="../conexiones/facturacionCourier.php" method="POST">
            <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top:10px; width:300px;">
                <div class="mb-3 mt-3">
                    <label for="ref" class="form-label text-white fw-bold">Referencia:</label>
                    <select class="form-select" id="ref" name="ref" required>
                        <option value="<?= $fact['id_ord_serv'] ?>"><?= $fact['referencia'] ?></option>
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
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</body>
</html>