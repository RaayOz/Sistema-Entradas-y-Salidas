<?php

require_once __DIR__ . '/../config/conexion.php';

if (!isset($_GET['id'])) {
    die("ID no proporcionado");
}

$id = intval($_GET['id']);

$conn->query("DELETE FROM Carro WHERE ID_Usuario = $id");

$sql = "DELETE FROM Usuario WHERE ID_Usuario = $id";

if ($conn->query($sql)) {
    header("Location: ../views/admin/verUsuarios.php");
    exit;
} else {
    die("Error al eliminar usuario: " . $conn->error);
}

?>