<?php
// Aca traemos la conexion para tener menos codigo.
include("conexion.php");

// 3. Recibir datos del formulario
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$pais=$_POST['pais'];
$direccion=$_POST['dir'];
$activo=$_POST['activo'];

$sql = "INSERT INTO direccion (pais, direccion) VALUES ('$pais','$direccion')";
if ($conn->query($sql) === TRUE) {
    $id_direccion = $conn->insert_id;
    $sql2 = "INSERT INTO sede (nombre_sede, telefono, id_direccion, activo) VALUES ('$nombre','$telefono','$id_direccion','$activo')";
    if ($conn->query($sql2) === TRUE) {
        header("Location: ../paginas/sedes.php?ok=1");
        exit();
    } else {
        header("Location: ../paginas/sedes.php?error=db");
        exit();
    }
}
// 5. Cerrar conexión 
$conn->close();
?>