<?php
include("conexion.php");

if(isset($_GET['id_paquete'])){
    $id = $_GET['id_paquete'];
    $sql = "DELETE FROM paquete WHERE id_paquete='$id'";
    if ($conn->query($sql)===TRUE) {
            header("Location: ../paginas/paquetes.php?delete=1");
            exit();
        } else {
            header("Location: ../paginas/paquetes.php?error=db");
            exit();
        }
}
?>