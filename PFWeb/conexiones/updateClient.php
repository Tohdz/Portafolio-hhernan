<?php
include("conexion.php");

$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$pais = $_POST['pais'];
$dir = $_POST['dir'];
$activo = $_POST['activo'];

$sql = "UPDATE usuarios u
JOIN direccion d ON u.id_direccion = d.id_direccion
SET 
    u.nombre = '$nombre',
    u.contrasena = '$contrasena',
    u.correo = '$correo',
    u.telefono = '$telefono',
    u.activo = '$activo',
    d.pais = '$pais',
    d.direccion = '$dir'
WHERE u.dni = '$dni'";

if($conn->query($sql)){
    header("Location: ../paginas/home.php?ok=1");
    exit();
}else{
    header("Location: ../paginas/home.php?error=db");
    exit();
}
?>