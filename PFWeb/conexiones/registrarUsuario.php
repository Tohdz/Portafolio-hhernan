<?php
// Aca traemos la conexion para tener menos codigo.
include("conexion.php");

// 3. Recibir datos del formulario
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$correo = $_POST['email'];
$telefono = $_POST['telefono'];
$pais=$_POST['pais'];
$direccion=$_POST['dir'];
$contrasena=$_POST['pass'];
$activo=true;

// 4. Validacion de usuario ya creado
$presql="SELECT dni FROM usuarios as userauth WHERE dni ='$dni'";
$answer=$conn->query($presql);
$row = $answer->fetch_assoc(); 
$total = $row['dni'] ?? '';

if ($total==null){
    $sql = "INSERT INTO direccion (pais, direccion) VALUES ('$pais','$direccion')";
    if ($conn->query($sql) === TRUE){
        $id_direccion = $conn->insert_id;
        $sql2 = "INSERT INTO usuarios (dni, nombre, contrasena, correo, telefono, id_direccion, activo) VALUES ('$dni','$nombre','$contrasena','$correo','$telefono','$id_direccion','$activo')";
        $sql3 = "INSERT INTO roles (nombre, dni) VALUES ('Client','$dni')";
        if ($conn->query($sql2) && $conn->query($sql3)=== TRUE) {
            $pais = 'Estados Unidos';
            $direccion = 'Miami.FL 2345 street 24th';
            $sql4 = "INSERT INTO direccion (pais, direccion) VALUES ('$pais','$direccion')";
            if ($conn->query($sql4) === TRUE) {
                $id_direccion = $conn->insert_id;
                $sql5 = "INSERT INTO casillero (dni, id_direccion, activo) VALUES ('$dni','$id_direccion','$activo')";
                if ($conn->query($sql5) === TRUE) {
                    header("Location: ../paginas/inicioSesion.php?ok=1");
                    exit();
                }
            }
        } else {
            header("Location: ../paginas/inicioSesion.php?error=db");
            exit();
        }
    }
}else {
    header("Location: ../paginas/inicioSesion.php?error=created");
    exit();
}
// 5. Cerrar conexión 
$conn->close();
?>