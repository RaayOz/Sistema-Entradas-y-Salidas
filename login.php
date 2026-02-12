<?php
include("conexion.php");

$numero = $_POST['numero_control'];
$password = $_POST['password'];

$sql = "SELECT * FROM alumnos WHERE numero_control = '$numero'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $alumno = $resultado->fetch_assoc();

    echo "Bienvenido " . $alumno['nombre_completo'];
} else {
    echo "Número de control no encontrado";
}
?>