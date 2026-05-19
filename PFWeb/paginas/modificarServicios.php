<?php
include("../conexiones/conexion.php");
$id = $_GET['id_ord_serv'];
$sql = "SELECT id_sede, nombre_sede FROM sede";
$resultado = $conn->query($sql);
$sql1 = "SELECT id_paquete, referencia FROM paquete";
$resultado1 = $conn->query($sql1);
$sql2 = "SELECT 
    os.id_ord_serv,
    os.fecha_hora,
    os.comentarios,
    os.activo,
    s.id_sede,
    s.nombre_sede,
    p.id_paquete,
    p.referencia
FROM ordenServicio os
JOIN sede s 
    ON os.id_sede = s.id_sede
JOIN paquete p 
    ON os.id_paquete = p.id_paquete WHERE os.id_ord_serv ='$id'";
$resultado2 = $conn->query($sql2);
$servicio = $resultado2->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modificación de Servicios</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="imagenAdmin">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../paginas/servicios.php">
                <i class="bi bi-arrow-left fs-4 text-white"></i>
            </a>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5" style="padding-left:120px;">
        <header class="fw-bold text-white fs-3 pb-3">Modificación de servicios</header>
        <form class="p-3 rounded shadow" style="background-color: rgba(33, 37, 41, 0.6);" action="../conexiones/updateServicios.php" method="POST">
            <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top:10px; width:300px;">
                <input type="hidden" name="id" value="<?= $servicio['id_ord_serv'] ?>">
                <div class="mb-3 mt-3">
                    <label for="sede" class="form-label text-white fw-bold">Sede:</label>
                    <select class="form-select" id="sede" name="sede" required>
                        <option value="<?= $servicio['id_sede'] ?>"><?= $servicio['nombre_sede'] ?></option>
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
                    <input type="datetime-local" name="fecha" class="form-control" placeholder="Ingrese fecha" id="fecha" value="<?= $servicio['fecha_hora'] ?>">
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Comentarios:</label>
                    <input type="textfield" class="form-control" name="coments" value="<?= $servicio['comentarios'] ?>" required>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold">
                        <input type="checkbox" name="activo" value="1" <?= $servicio['activo'] == 1 ? 'checked' : '' ?>>
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