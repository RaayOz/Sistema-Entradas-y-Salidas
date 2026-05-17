<?php
// Configuración de la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "SIESA";

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>
