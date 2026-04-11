<?php
include("conexion.php");

$entradasalida = $_POST['entradasalida'];
$metodoacceso = $_POST['metodoacceso'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$lugar = $_POST['lugar'];

$sql = "INSERT INTO Registro
(EntradaSalida, MetodoAcceso, Fecha, Hora, Lugar)
VALUES 
('$entradasalida','$metodoacceso','$fecha','$hora','$lugar')";

if ($conn->query($sql) === TRUE) {
    echo "Acceso registrado correctamente";
    echo '<button class="boton" onclick="window.location.href=\'../usuarios/guardia/inicio.php\'">Volver al Inicio</button>';
} else {
    echo "Error: " . $conn->error;
}
?>