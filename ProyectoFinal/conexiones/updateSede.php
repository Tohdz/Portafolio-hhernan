<?php
include("conexion.php");

$dni = $_POST['id'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$pais = $_POST['pais'];
$dir = $_POST['dir'];
$activo = $_POST['activo'];

$sql = "UPDATE sede s
JOIN direccion d ON s.id_direccion = d.id_direccion
SET 
    s.nombre_sede = '$nombre',
    s.telefono = '$telefono',
    s.activo = '$activo',
    d.pais = '$pais',
    d.direccion = '$dir'
WHERE s.id_sede = '$dni'";

if($conn->query($sql)){
    header("Location: ../paginas/sedes.php?ok=1");
    exit();
}else{
    header("Location: ../paginas/sedes.php?error=db");
    exit();
}
?>