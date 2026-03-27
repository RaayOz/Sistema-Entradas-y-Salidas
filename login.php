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
    $_SESSION['nocontrol'] = $usuario['NoControl'];
    $_SESSION['rol'] = $usuario['ID_Rol'];

    if ($usuario['ID_Rol'] == 1) {
        header("Location: registros.php");
    } else {
        header("Location: panel.php");
    }

} else {
    echo "Número de control o contraseña incorrectos";
}
?>