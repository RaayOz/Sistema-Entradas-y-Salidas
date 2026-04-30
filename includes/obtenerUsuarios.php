<?php

require_once __DIR__ . '/../config/conexion.php';

$nocontrol = $_GET['nocontrol'] ?? '';
$rol       = $_GET['rol']       ?? '';

$porPagina = 25;
$pagina    = max(1, intval($_GET['pagina'] ?? 1));
$offset    = ($pagina - 1) * $porPagina;

$where = "WHERE 1=1";

if (!empty($nocontrol)) $where .= " AND u.NoControl LIKE '%$nocontrol%'";
if (!empty($rol))       $where .= " AND r.NombreRol = '$rol'";

$sqlBase = "FROM Usuario u
INNER JOIN Rol r ON u.ID_Rol = r.ID_Rol
$where";

$resultTotal    = $conn->query("SELECT COUNT(*) AS total $sqlBase");
$totalRegistros = $resultTotal->fetch_assoc()['total'];
$totalPaginas   = ceil($totalRegistros / $porPagina);

$sql = "SELECT 
    u.ID_Usuario,
    u.NoControl,
    u.Nombres,
    u.Apellidos,
    u.Correo,
    u.Telefono,
    r.NombreRol
$sqlBase
ORDER BY u.NoControl ASC
LIMIT $porPagina OFFSET $offset";

$resultUsuarios = $conn->query($sql);

if (!$resultUsuarios) {
    die("Error en la consulta: " . $conn->error);
}