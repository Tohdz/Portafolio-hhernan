<?php
include("conexion.php");

if(isset($_GET['id_ord_serv'])){
    $id = $_GET['id_ord_serv'];
    $sql = "DELETE FROM ordenServicio WHERE id_ord_serv='$id'";
    if ($conn->query($sql)===TRUE) {
            header("Location: ../paginas/servicios.php?delete=1");
            exit();
        } else {
            header("Location: ../paginas/servicios.php?error=db");
            exit();
        }
}
?>