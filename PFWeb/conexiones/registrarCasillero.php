<?php
// Aca traemos la conexion para tener menos codigo.
include("conexion.php");

// 3. Recibir datos del formulario
$user = $_POST['user'];
$pais=$_POST['pais'];
$direccion=$_POST['dir'];
$activo=$_POST['activo'];

$sql = "INSERT INTO direccion (pais, direccion) VALUES ('$pais','$direccion')";
if ($conn->query($sql) === TRUE) {
    $id_direccion = $conn->insert_id;
    $sql2 = "INSERT INTO casillero (dni, id_direccion, activo) VALUES ('$user','$id_direccion','$activo')";
    if ($conn->query($sql2) === TRUE) {
        header("Location: ../paginas/casilleros.php?ok=1");
        exit();
    } else {
        header("Location: ../paginas/casilleros.php?error=db");
        exit();
    }
}
// 5. Cerrar conexión 
$conn->close();
?>