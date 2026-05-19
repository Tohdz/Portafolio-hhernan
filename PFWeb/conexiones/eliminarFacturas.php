<?php
include("conexion.php");

if(isset($_GET['id_det_fact'])){
    $code = $_GET['id_det_fact'];
    $presql = "SELECT id_fact FROM detallefactura WHERE id_det_fact ='$code'";
    $answer = $conn->query($presql);
    $row = $answer->fetch_assoc();
    $ind = $row['id_fact'];
    $sql2 = "DELETE FROM detallefactura WHERE id_det_fact='$code'";
    $sql = "DELETE FROM factura WHERE id_fact='$ind'";
    if ($conn->query($sql2)&&$conn->query($sql)===TRUE) {
            header("Location: ../paginas/facturas.php?delete=1");
            exit();
        } else {
            header("Location: ../paginas/facturas.php?error=db");
            exit();
        }
}
?>