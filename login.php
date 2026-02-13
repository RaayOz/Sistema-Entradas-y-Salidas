<?php
include("conexion.php");

$numero = $_POST['numero_control'];
$password = $_POST['password'];

$sql = "SELECT * FROM alumnos WHERE numero_control = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $numero);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $alumno = $resultado->fetch_assoc();

    if ($password === $alumno['password']) {
    echo "Bienvenido " . $alumno['nombre_completo'];
    } else {
    echo "Contraseña incorrecta";
    }

} else {
    echo "Número de control no encontrado";
}
?>