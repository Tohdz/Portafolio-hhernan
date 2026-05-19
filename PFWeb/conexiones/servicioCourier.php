<?php
// Aca traemos la conexion para tener menos codigo.
include("conexion.php");

// 3. Recibir datos del formulario
$status=$_POST['status'];
$sede = $_POST['sede'];
$ref=$_POST['ref'];
$fecha=$_POST['fecha'];
$coments=$_POST['coments'];
$activo=true;

$sql = "INSERT INTO ordenServicio (fecha_hora,comentarios, id_sede, id_paquete, activo) VALUES 
('$fecha','$coments','$sede','$ref','$activo')";
$sql2="UPDATE paquete SET status='$status', activo= false WHERE id_paquete='$ref'";
if ($conn->query($sql)&&$conn->query($sql2) === TRUE) {
    header("Location: ../paginas/courier.php?ok=1");
    exit();
}else {
    header("Location: ../paginas/courier.php?error=db");
    exit();
}
// 5. Cerrar conexión 
$conn->close();
?>