<?php
// Aca traemos la conexion para tener menos codigo.
include("conexion.php");

// 3. Recibir datos del formulario
$sede = $_POST['sede'];
$ref=$_POST['ref'];
$fecha=$_POST['fecha'];
$coments=$_POST['coments'];
$activo=$_POST['activo'];

$sql = "INSERT INTO ordenServicio (fecha_hora,comentarios, id_sede, id_paquete, activo) VALUES 
('$fecha','$coments','$sede','$ref','$activo')";
if ($conn->query($sql) === TRUE) {
    header("Location: ../paginas/servicios.php?ok=1");
    exit();
}else {
    header("Location: ../paginas/servicios.php?error=db");
    exit();
}
// 5. Cerrar conexión 
$conn->close();
?>