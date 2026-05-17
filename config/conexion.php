<?php
/** 
 * Archivo de conexión a la base de datos.
 *
 * Define los parámetros de conexión y establece una conexión MySQLi.
 * Si la conexión falla, se detiene el script y se muestra un mensaje de error.
 */
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
