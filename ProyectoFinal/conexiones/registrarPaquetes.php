<?php
// Aca traemos la conexion para tener menos codigo.
include("conexion.php");

// 3. Recibir datos del formulario
$user = $_POST['user'];
$peso=$_POST['peso'];
$fecha=$_POST['fecha'];
$status=$_POST['status'];
$activo=$_POST['activo'];

$sql = "INSERT INTO paquete (id_casillero,referencia, peso, recibido, status, activo ) VALUES 
('$user',UUID_SHORT(),'$peso','$fecha','$status','$activo')";
if ($conn->query($sql) === TRUE) {
    header("Location: ../paginas/paquetes.php?ok=1");
    exit();
}else {
    header("Location: ../paginas/paquetes.php?error=db");
    exit();
}
// 5. Cerrar conexión 
$conn->close();
?>