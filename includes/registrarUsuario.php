<?php
include("../config/conexion.php");

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nocontrol = $_POST['nocontrol'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$rol = $_POST['rol'];
$telefono = $_POST['telefono'];

$sql = "INSERT INTO Usuario 
(Nombres, Apellidos, NoControl, Correo, Contrasena, ID_Rol, Telefono)
VALUES 
('$nombre','$apellidos','$nocontrol','$correo','$contrasena','$rol','$telefono')";


if ($conn->query($sql) === TRUE) {

    $sqlrol = "SELECT NombreRol FROM Rol WHERE ID_Rol = '$rol'";
    $resultrol = $conn->query($sqlrol);

    $nombrerol = "Usuario";

    if ($resultrol && $resultrol->num_rows > 0) {
        $fila = $resultrol->fetch_assoc();
        $nombrerol = $fila['NombreRol'];
    }

    echo "$nombrerol Registrado Correctamente";
    if ($rol == 4) {
        echo '<button class="boton" onclick="window.location.href=\'../views/guardia/visitante.php\'">Volver</button>';
    } else {
        echo '<button class="boton" onclick="window.location.href=\'../views/admin/registros.php\'">Volver</button>';
    }
} else {
    echo "Error: " . $conn->error;
}
