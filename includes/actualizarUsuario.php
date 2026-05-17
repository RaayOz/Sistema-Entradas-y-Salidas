<?php
/**
 * Actualiza los datos de un usuario en la base de datos.
 *
 * Recibe los parámetros por POST y actualiza el registro correspondiente
 * en la tabla Usuario. Luego redirige al listado de usuarios.
 */
session_start();
require_once __DIR__ . '/../config/conexion.php';

/** @var mysqli $conn */
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nocontrol = $_POST['nocontrol'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

// Preparar la consulta SQL para actualizar el usuario.
$sql = "UPDATE Usuario SET 
    Nombres='$nombre',
    Apellidos='$apellidos',
    NoControl='$nocontrol',
    Correo='$correo',
    Telefono='$telefono'
    WHERE ID_Usuario='$id'";

// Ejecutar la consulta y redirigir según el resultado.
if ($conn->query($sql)) {
    header("Location: ../views/admin/verUsuarios.php");
    exit;
} else {
    echo "Error al actualizar: " . $conn->error;
} 
