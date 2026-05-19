<?php
// Aca traemos la conexion para tener menos codigo.
include("conexion.php");

// 3. Recibir datos del formulario
$ref = $_POST['ref'];
$precio=$_POST['precio'];
$fecha = date("Y-m-d H:i:s");
$activo=$_POST['activo'];
$preciototal=$_POST['precio']+($_POST['precio']*0.13);
$sql = "INSERT INTO factura (fecha_hora, precio_final) VALUES ('$fecha','$preciototal')";
if ($conn->query($sql) === TRUE) {
    $id_fact = $conn->insert_id;
    $sql2 = "INSERT INTO detallefactura (id_fact, id_ord_serv,precio_unitario, activo) VALUES 
    ('$id_fact','$ref','$precio','$activo')";
    if ($conn->query($sql2) === TRUE) {
        header("Location: ../paginas/facturas.php?ok=1");
        exit();
    } else {
        header("Location: ../paginas/facturas.php?error=db");
        exit();
    }
}
// 5. Cerrar conexión 
$conn->close();
?>