<?php

require_once __DIR__ . '/../config/conexion.php';

$metodo   = $_GET['metodo']   ?? '';
$fecha    = $_GET['fecha']    ?? '';
$hora     = $_GET['hora']     ?? '';
$usuario  = $_GET['usuario']  ?? '';
$matricula = $_GET['matricula'] ?? '';

$porPagina = 25;
$pagina    = max(1, intval($_GET['pagina'] ?? 1));
$offset    = ($pagina - 1) * $porPagina;

$where = "WHERE 1=1";

if (!empty($metodo))    $where .= " AND r.MetodoAcceso = '$metodo'";
if (!empty($fecha))     $where .= " AND r.Fecha = '$fecha'";
if (!empty($hora))      $where .= " AND r.Hora LIKE '$hora%'";
if (!empty($usuario))   $where .= " AND u.NoControl LIKE '%$usuario%'";
if (!empty($matricula)) $where .= " AND c.Matricula LIKE '%$matricula%'";

$sqlBase = "FROM Registro r
INNER JOIN Usuario u ON r.ID_Usuario = u.ID_Usuario
LEFT JOIN Carro c ON r.ID_Carro = c.ID_Carro
$where";

$resultTotal = $conn->query("SELECT COUNT(*) AS total $sqlBase");
$totalRegistros = $resultTotal->fetch_assoc()['total'];
$totalPaginas   = ceil($totalRegistros / $porPagina);

$sql = "SELECT 
    r.ID_Registro,
    u.NoControl     AS NoControl,
    r.EntradaSalida AS EntradaSalida,
    r.MetodoAcceso  AS MetodoAcceso,
    c.Matricula     AS Matricula,
    r.Fecha         AS Fecha,
    r.Hora          AS Hora,
    r.Lugar         AS Lugar,
    r.Motivo        AS Motivo
$sqlBase
ORDER BY r.Fecha DESC, r.Hora DESC
LIMIT $porPagina OFFSET $offset";

$resultRegistros = $conn->query($sql);

if (!$resultRegistros) {
    die("Error en la consulta: " . $conn->error);
}