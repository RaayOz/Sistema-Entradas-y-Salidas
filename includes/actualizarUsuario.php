<?php

include("../config/conexion.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nocontrol = $_POST['nocontrol'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$telefono = $_POST['telefono'];

$sql = "UPDATE Usuario SET 
Nombres='$nombre',
Apellidos='$apellidos',
NoControl='$nocontrol',
Correo='$correo',
Contrasena='$contrasena',
Telefono='$telefono'
WHERE ID_Usuario='$id'";

if ($conn->query($sql)) {
    header("Location: ../views/admin/verUsuarios.php");
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>