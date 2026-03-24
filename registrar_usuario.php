<?php
include("conexion.php");

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nocontrol = $_POST['nocontrol'];
$curp = $_POST['curp'];
$contrasena = $_POST['contrasena'];
$rol = $_POST['rol'];
$telefono = $_POST['numeroEmergencia'];

$sql = "INSERT INTO Usuario 
(Nombres, Apellidos, NoControl, CURP, Contrasena, ID_Rol, Telefono)
VALUES 
('$nombre','$apellidos','$nocontrol','$curp','$contrasena','$rol','$telefono')";

if ($conn->query($sql) === TRUE) {

    echo "Usuario registrado correctamente";
    echo "<br><a href='registros.php'>Registrar otro</a>";

} else {

    echo "Error: " . $conn->error;

}
?>