<?php

require_once __DIR__ . '/../config/conexion.php';

$nocontrol = $_GET['nocontrol'] ?? '';
$rol = $_GET['rol'] ?? '';

$sql = "SELECT 
u.ID_Usuario,
u.NoControl,
u.Nombres,
u.Apellidos,
u.Correo,
u.Telefono,
r.NombreRol
FROM Usuario u
INNER JOIN Rol r ON u.ID_Rol = r.ID_Rol
WHERE 1=1";

if (!empty($nocontrol)) {
    $sql .= " AND u.NoControl LIKE '%$nocontrol%'";
}

if (!empty($rol)) {
    $sql .= " AND r.NombreRol = '$rol'";
}

$resultUsuarios = $conn->query($sql);

if (!$resultUsuarios) {
    die("Error en la consulta: " . $conn->error);
}