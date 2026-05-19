<?php
include("../conexiones/conexion.php");

$id = $_GET['id_paquete'];
$sql1 = "SELECT id_casillero, dni FROM casillero";
$resultado1 = $conn->query($sql1);
$sql = "SELECT p.id_paquete, p.referencia, p.peso, p.recibido, p.status, p.activo,c.id_casillero, c.dni, c.codigo
        FROM paquete p
        JOIN casillero c ON p.id_casillero = c.id_casillero WHERE p.id_paquete='$id'";
$resultado = $conn->query($sql);
$paquete = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modificación de Paquetes</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="imagenAdmin">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../paginas/paquetes.php">
                <i class="bi bi-arrow-left fs-4 text-white"></i>
            </a>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5" style="padding-left:120px;">
        <header class="fw-bold text-white fs-3 pb-3">Modificación de paquetes</header>
        <form class="p-3 rounded shadow" style="background-color: rgba(33, 37, 41, 0.6);" action="../conexiones/updatePaquetes.php" method="POST">
            <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top:10px; width:300px;">
                <input type="hidden" name="id" value="<?= $paquete['id_paquete'] ?>">
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Casillero:</label>
                    <input type="text" class="form-control" name="casillero" value="<?= $paquete['codigo'] ?>" readonly>
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Usuario:</label>
                    <select class="form-select" id="user" name="user" required>
                        <option value="<?= $paquete['id_casillero'] ?>"><?= $paquete['dni'] ?></option>
                        <?php while ($fila = $resultado1->fetch_assoc()): ?>
                        <option value="<?= $fila['id_casillero'] ?>">
                            <?= $fila['dni'] ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Referencia:</label>
                    <input type="text" class="form-control" name="referencia" value="<?= $paquete['referencia'] ?>" readonly>
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Peso:</label>
                    <input type="text" class="form-control" name="peso" value="<?= $paquete['peso'] ?>" required>
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Fecha:</label>
                    <input type="datetime-local" class="form-control" name="fecha" value="<?= $paquete['recibido'] ?>">
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold" for="status">Ingrese el status:</label><br>
                    <select name="status" id="status">
                        <option value="<?= $paquete['status'] ?>"><?= $paquete['status'] ?></option>
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
                        <input type="checkbox" name="activo" value="1" <?= $paquete['activo'] == 1 ? 'checked' : '' ?>>
                        Activo
                    </label>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
    </div>
</body>
</html>