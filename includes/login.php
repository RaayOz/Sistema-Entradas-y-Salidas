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

    switch ($usuario['ID_Rol']) {
        case 1:
            header("location: ../usuarios/admin/inicio.php");
            break;
        case 2:
            header("location: ../usuarios/guardia/inicio.php");
            break;
        case 3:
            header("location: ../usuarios/alumno/inicio.php");
            break;
        default:
            echo "Rol no reconocido";
    }

} else {
    echo "Número de control o contraseña incorrectos";
}
?>