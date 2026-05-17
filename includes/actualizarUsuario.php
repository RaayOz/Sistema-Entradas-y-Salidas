<?php
// Este archivo se encarga de actualizar la información de un usuario en la base de datos
session_start();
include("../config/conexion.php");

/** @var mysqli $conn */
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nocontrol = $_POST['nocontrol'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

// Validar que los campos no estén vacíos
$sql = "UPDATE Usuario SET 
Nombres='$nombre',
Apellidos='$apellidos',
NoControl='$nocontrol',
Correo='$correo',
Telefono='$telefono'
WHERE ID_Usuario='$id'";

// Ejecutar la consulta y redirigir según el resultado
if ($conn->query($sql)) {
    header("Location: ../views/admin/verUsuarios.php");
} else {
    echo "Error al actualizar: " . $conn->error;
}
