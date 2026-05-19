<?php
include("conexion.php");

if(isset($_GET['dni']) && isset($_GET['nombre'])){

    $dni = $_GET['dni'];
    $nombre = $_GET['nombre'];

    $sql = "DELETE FROM roles WHERE nombre='$nombre' AND dni='$dni'";
    if ($conn->query($sql)===TRUE) {
            header("Location: ../paginas/roles.php?delete=1");
            exit();
        } else {
            header("Location: ../paginas/roles.php?error=db");
            exit();
        }
}
?>