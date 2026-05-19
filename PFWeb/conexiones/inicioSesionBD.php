<?php
// Aca traemos la conexion para tener menos codigo.
include("conexion.php");

// 3. Recibir datos del formulario
$email = $_POST['email'];
$pass = $_POST['pass'];


// 4. Validacion de usuario ya creado
$presql="SELECT correo,contrasena,activo FROM usuarios WHERE correo ='$email'";
$answer=$conn->query($presql);
$row = $answer->fetch_assoc(); 
$correosql = $row['correo'];
$passsql = $row['contrasena'];
$activosql = $row['activo'];

if ($correosql==$email && $passsql==$pass){
    session_start();
    $_SESSION["email"] = $correosql;
    header("Location: ../paginas/home.php");
    exit();
} else {
    header("Location: ../paginas/inicioSesion.php?error=notcreated");
    exit();
}
// 5. Cerrar conexión 
$conn->close();
?>