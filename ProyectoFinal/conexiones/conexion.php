<?php
// Datos de conexión a la BD que crea el script del caso de estudio.

$host = "localhost";
$user = "root";
$pass="";
$db = "proyecto_final";

// 1. Crear la conexión
$conn = new mysqli($host, $user, $pass, $db);

// 2. Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: ".$conn->connect_error);
}
?>