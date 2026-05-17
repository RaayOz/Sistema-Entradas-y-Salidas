<?php
// Este archivo se encarga de eliminar un vehículo de la base de datos
session_start();
include("../config/conexion.php");

/** @var mysqli $conn */
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../index.php");
    exit;
}

// Validar que se haya proporcionado un ID de vehículo
$id = $_GET['id'];

// Validar que el ID sea un número entero
$id = intval($_GET['id']);
$sql = "DELETE FROM Carro WHERE ID_Carro='$id'";

// Ejecutar la consulta y redirigir según el resultado
if ($conn->query($sql) === TRUE) {
    header("Location: ../views/admin/verVehiculos.php");
} else {
    echo "Error al eliminar vehículo";
}
