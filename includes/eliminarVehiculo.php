<?php
/**
 * Elimina un vehículo registrado en la base de datos.
 *
 * Verifica que el usuario tenga rol de administrador antes de permitir
 * la eliminación y luego redirige al listado de vehículos.
 */
session_start();
require_once __DIR__ . '/../config/conexion.php';

/** @var mysqli $conn */
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../index.php");
    exit;
}

// Validar que se haya proporcionado un ID de vehículo y convertirlo a entero.
$id = intval($_GET['id'] ?? 0);
$sql = "DELETE FROM Carro WHERE ID_Carro='$id'";

// Ejecutar la consulta y redirigir según el resultado.
if ($conn->query($sql) === TRUE) {
    header("Location: ../views/admin/verVehiculos.php");
    exit;
} else {
    echo "Error al eliminar vehículo";
}
