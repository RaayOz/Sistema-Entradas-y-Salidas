<?php
include("../config/conexion.php");

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nocontrol = $_POST['nocontrol'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$rol = $_POST['rol'];
$telefono = $_POST['telefono'];

$nombrerol = "$nombrerol";

$sql = "INSERT INTO Usuario 
(Nombres, Apellidos, NoControl, Correo, Contrasena, ID_Rol, Telefono)
VALUES 
('$nombre','$apellidos','$nocontrol','$correo','$contrasena','$rol','$telefono')";


if ($conn->query($sql) === TRUE) {
    echo "$nombrerol Registrado Correctamente";
    echo '<button class="boton" onclick="window.location.href=\'../views/admin/registros.php\'">Volver</button>';
} else {
    echo "Error: " . $conn->error;
}
?>