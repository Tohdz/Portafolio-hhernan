<?php
// Aca traemos la conexion para tener menos codigo.
include("conexion.php");

// 3. Recibir datos del formulario
$ref = $_POST['ref'];
$precio=$_POST['precio'];
$fecha = date("Y-m-d H:i:s");
$activo=true;
$preciototal=$_POST['precio']+($_POST['precio']*0.13);
$sql = "INSERT INTO factura (fecha_hora, precio_final) VALUES ('$fecha','$preciototal')";
$sql3="UPDATE ordenservicio SET activo=false WHERE id_ord_serv='$ref'";
$resultado=$conn->query($sql3);
if ($conn->query($sql)=== TRUE) {
    $id_fact = $conn->insert_id;
    $sql2 = "INSERT INTO detallefactura (id_fact, id_ord_serv,precio_unitario, activo) VALUES 
    ('$id_fact','$ref','$precio','$activo')";
    if ($conn->query($sql2) === TRUE) {
        header("Location: ../paginas/courier.php?ok=1");
        exit();
    } else {
        header("Location: ../paginas/courier.php?error=db");
        exit();
    }
}
// 5. Cerrar conexión 
$conn->close();
?>