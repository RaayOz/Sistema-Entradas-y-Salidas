<?php
session_start();
include("conexion.php");

$nocontrol = $_POST['nocontrol'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM Usuario 
        WHERE NoControl='$nocontrol' 
        AND Contrasena='$contrasena'";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {

    $usuario = $resultado->fetch_assoc();

    $_SESSION['usuario'] = $usuario['Nombres'];
    $_SESSION['rol'] = $usuario['ID_Rol'];
    $_SESSION['id'] = $usuario['ID_Usuario'];

    header("Location: panel.php");
    exit();

} else {

    echo "Usuario o contraseña incorrectos";
}
?>