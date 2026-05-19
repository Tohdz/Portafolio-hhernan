<?php
include("conexion.php");

$dni = $_POST['id'];
$casillero = $_POST['user'];
$ref = $_POST['referencia'];
$peso = $_POST['peso'];
$fecha = $_POST['fecha'];
$status = $_POST['status'];
$activo = isset($_POST['activo']) ? 1 : 0;

$sql = "UPDATE paquete p SET p.id_casillero = '$casillero',p.referencia = '$ref',p.peso = '$peso',p.recibido = '$fecha',p.status = '$status',p.activo = $activo WHERE p.id_paquete = '$dni'";

if($conn->query($sql)){
    header("Location: ../paginas/paquetes.php?ok=1");
    exit();
}else{
    header("Location: ../paginas/paquetes.php?error=db");
    exit();
}
?>