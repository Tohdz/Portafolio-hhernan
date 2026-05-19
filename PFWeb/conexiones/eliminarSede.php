<?php
include("conexion.php");

if(isset($_GET['id_sede'])){
    $id = $_GET['id_sede'];
    $presql = "SELECT id_direccion FROM sede WHERE id_sede ='$id'";
    $answer = $conn->query($presql);
    $row = $answer->fetch_assoc();
    $ind = $row['id_direccion'];
    $sql2 = "DELETE FROM sede WHERE id_sede='$id'";
    $sql = "DELETE FROM direccion WHERE id_direccion='$ind'";
    if ($conn->query($sql2)&&$conn->query($sql)===TRUE) {
            header("Location: ../paginas/sedes.php?delete=1");
            exit();
        } else {
            header("Location: ../paginas/sedes.php?error=db");
            exit();
        }
}
?>