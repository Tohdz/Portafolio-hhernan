<?php
include("../conexiones/conexion.php");

$id = $_GET['id_sede'];

$sql = "SELECT s.id_sede, s.nombre_sede, s.telefono, d.pais, d.direccion, s.activo  FROM sede s JOIN direccion d ON s.id_direccion = d.id_direccion WHERE s.id_sede ='$id'";
$resultado = $conn->query($sql);
$sede = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modificación de sedes</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="imagenAdmin">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../paginas/usuarios.php">
                <i class="bi bi-arrow-left fs-4 text-white"></i>
            </a>
        </div>
    </nav>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5" style="padding-left:120px;">
        <header class="fw-bold text-white fs-3 pb-3">Modificación de Sede</header>
        <form class="p-3 rounded shadow" style="background-color: rgba(33, 37, 41, 0.6);" action="../conexiones/updateSede.php" method="POST">
            <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top:10px; width:300px;">
                <input type="hidden" name="id" value="<?= $sede['id_sede'] ?>">
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $sede['nombre_sede'] ?>" required>
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label text-white fw-bold">Telefono:</label>
                    <input type="text" class="form-control" name="telefono" value="<?= $sede['telefono'] ?>" required>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold" for="pais">Ingrese su país:</label><br>
                    <select name="pais" id="pais">
                        <option value="<?= $sede['pais'] ?>"><?= $sede['pais'] ?></option>
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
                    <input type="text" name="dir" class="form-control" placeholder="Ingrese su direccion" id="dir" value="<?= $sede['direccion'] ?>" required>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-label text-white fw-bold">
                        <input type="checkbox" name="activo" value="1" <?= $sede['activo'] == 1 ? 'checked' : '' ?>>
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