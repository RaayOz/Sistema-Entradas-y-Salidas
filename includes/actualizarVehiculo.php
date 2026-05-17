<?php
/**
 * Actualiza los datos de un vehículo registrado en la base de datos.
 *
 * Recibe los parámetros por POST y actualiza la fila de la tabla Carro.
 * Luego redirige al listado de vehículos.
 */
session_start();
require_once __DIR__ . '/../config/conexion.php';

/** @var mysqli $conn */
$id = $_POST['id'];
$matricula = $_POST['matricula'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];

// Preparar la consulta SQL para actualizar el vehículo.
$sql = "UPDATE Carro SET 
    Matricula='$matricula',
    Marca='$marca',
    Modelo='$modelo',
    Color='$color'
    WHERE ID_Carro='$id'";

// Ejecutar la consulta y redirigir según el resultado.
if ($conn->query($sql)) {
    header("Location: ../views/admin/verVehiculos.php");
    exit;
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>