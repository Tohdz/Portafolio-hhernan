<?php
include("conexion.php");

if(isset($_GET['dni'])){
    $dni = $_GET['dni'];
    $presql = "SELECT id_direccion FROM usuarios WHERE dni ='$dni'";
    $answer = $conn->query($presql);
    $row = $answer->fetch_assoc();
    $ind = $row['id_direccion'];
    $sql = "DELETE FROM roles WHERE dni='$dni'";
    $sql2 = "DELETE FROM usuarios WHERE dni='$dni'";
    $sql3 = "DELETE FROM direccion WHERE id_direccion='$ind'";
    if ($conn->query($sql)&&$conn->query($sql2)&&$conn->query($sql3)===TRUE) {
            header("Location: ../paginas/usuarios.php?delete=1");
            exit();
        } else {
            header("Location: ../paginas/usuarios.php?error=db");
            exit();
        }
}
?>