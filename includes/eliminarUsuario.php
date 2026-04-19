<?php
session_start();
include("../config/conexion.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM Usuario WHERE ID_Usuario='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: ../views/admin/verUsuarios.php");
} else {
    echo "Error al eliminar usuario";
}
