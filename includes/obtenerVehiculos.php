<?php

require_once __DIR__ . '/../config/conexion.php';

$dueno     = $_GET['dueno']     ?? '';
$matricula = $_GET['matricula'] ?? '';
$marca     = $_GET['marca']     ?? '';
$modelo    = $_GET['modelo']    ?? '';
$color     = $_GET['color']     ?? '';

$porPagina = 25;
$pagina    = max(1, intval($_GET['pagina'] ?? 1));
$offset    = ($pagina - 1) * $porPagina;

$where = "WHERE 1=1";

if (!empty($dueno))     $where .= " AND u.NoControl LIKE '%$dueno%'";
if (!empty($matricula)) $where .= " AND c.Matricula LIKE '%$matricula%'";
if (!empty($marca))     $where .= " AND c.Marca LIKE '%$marca%'";
if (!empty($modelo))    $where .= " AND c.Modelo LIKE '%$modelo%'";
if (!empty($color))     $where .= " AND c.Color LIKE '%$color%'";

$sqlBase = "FROM Carro c
INNER JOIN Usuario u ON c.ID_Usuario = u.ID_Usuario
$where";

$resultTotal    = $conn->query("SELECT COUNT(*) AS total $sqlBase");
$totalRegistros = $resultTotal->fetch_assoc()['total'];
$totalPaginas   = ceil($totalRegistros / $porPagina);

$sql = "SELECT 
    c.ID_Carro,
    c.Matricula,
    c.Marca,
    c.Modelo,
    c.Color,
    u.NoControl AS NoControl
$sqlBase
ORDER BY c.Matricula ASC
LIMIT $porPagina OFFSET $offset";

$resultVehiculos = $conn->query($sql);

if (!$resultVehiculos) {
    die("Error en la consulta: " . $conn->error);
}