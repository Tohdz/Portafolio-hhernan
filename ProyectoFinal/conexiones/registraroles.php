<?php
// Aca traemos la conexion para tener menos codigo.
include("conexion.php");

// 3. Recibir datos del formulario
$nombre = $_POST['rol'];
$dni = $_POST['user'];

$sql = "INSERT INTO roles (nombre, dni) VALUES ('$nombre','$dni')";

if ($conn->query($sql)=== TRUE) {
    header("Location: ../paginas/roles.php?ok=1");
    exit();
} else {
    header("Location: ../paginas/roles.php?error=db");
    exit();
}

// 5. Cerrar conexión 
$conn->close();
?>