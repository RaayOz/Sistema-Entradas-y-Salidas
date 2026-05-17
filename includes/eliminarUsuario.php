<?php
/**
 * Elimina un usuario de la base de datos.
 *
 * Primero elimina los vehículos asociados al usuario y luego elimina
 * el registro del usuario en la tabla Usuario.
 */
session_start();
require_once __DIR__ . '/../config/conexion.php';

/** @var mysqli $conn */
if (!isset($_GET['id'])) {
    die("ID no proporcionado");
}

// Validar que el ID sea un número entero.
$id = intval($_GET['id']);

// Eliminar los vehículos asociados al usuario antes de borrar el usuario.
$conn->query("DELETE FROM Carro WHERE ID_Usuario = $id");

// Eliminar el usuario de la base de datos.
$sql = "DELETE FROM Usuario WHERE ID_Usuario = $id";

// Ejecutar la consulta y redirigir según el resultado.
if ($conn->query($sql)) {
    header("Location: ../views/admin/verUsuarios.php");
    exit;
} else {
    die("Error al eliminar usuario: " . $conn->error);
}
?>