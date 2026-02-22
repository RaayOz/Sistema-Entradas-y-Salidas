<?php
include("conexion.php");

$numero = $_POST['numero_control'];
$password = $_POST['password'];

$sql = "SELECT * FROM alumnos WHERE numero_control = ?";
$params = array($numero);

$stmt = sqlsrv_query($conexion, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$alumno = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if ($alumno) {

    if ($password === $alumno['password']) {
        echo "Bienvenido " . $alumno['nombre_completo'];
    } else {
        echo "Contraseña incorrecta";
    }

} else {
    echo "Número de control no encontrado";
}
?>