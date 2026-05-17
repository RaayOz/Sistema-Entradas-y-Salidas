<?php
// Este archivo se encarga de actualizar la información de un vehículo en la base de datos
session_start();
require_once "../config/conexion.php";

/** @var mysqli $conn */
$id = $_POST['id'];
$matricula = $_POST['matricula'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];

// Validar que los campos no estén vacíos
$sql = "UPDATE Carro SET 
Matricula='$matricula',
Marca='$marca',
Modelo='$modelo',
Color='$color'
WHERE ID_Carro='$id'";

// Ejecutar la consulta y redirigir según el resultado
if ($conn->query($sql)) {
    header("Location: ../views/admin/verVehiculos.php");
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>