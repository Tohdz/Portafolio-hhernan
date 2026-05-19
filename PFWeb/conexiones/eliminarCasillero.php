<?php
include("conexion.php");

if(isset($_GET['codigo'])){
    $code = $_GET['codigo'];
    $presql = "SELECT id_direccion FROM casillero WHERE codigo ='$code'";
    $answer = $conn->query($presql);
    $row = $answer->fetch_assoc();
    $ind = $row['id_direccion'];
    $sql2 = "DELETE FROM casillero WHERE codigo='$code'";
    $sql = "DELETE FROM direccion WHERE id_direccion='$ind'";
    if ($conn->query($sql2)&&$conn->query($sql)===TRUE) {
            header("Location: ../paginas/casilleros.php?delete=1");
            exit();
        } else {
            header("Location: ../paginas/casilleros.php?error=db");
            exit();
        }
}
?>