<?php
include("conexion.php");

$id = $_POST['id'];
$sede = $_POST['sede'];
$ref = $_POST['ref'];
$fecha = $_POST['fecha'];
$coments = $_POST['coments'];
$activo = isset($_POST['activo']) ? 1 : 0;

$sql = "UPDATE ordenServicio os SET os.id_sede = '$sede',os.id_paquete= '$ref',os.fecha_hora = '$fecha',os.comentarios = '$coments',os.activo = $activo WHERE os.id_ord_serv = '$id'";

if($conn->query($sql)){
    header("Location: ../paginas/servicios.php?ok=1");
    exit();
}else{
    header("Location: ../paginas/servicios.php?error=db");
    exit();
}
?>