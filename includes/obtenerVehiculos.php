<?php
/**
 * Recupera vehículos paginados y filtrados para el panel administrativo.
 *
 * Admite filtros opcionales por dueño, matrícula, marca, modelo y color.
 */
require_once __DIR__ . '/../config/conexion.php';

// Leer los parámetros de filtro desde GET.
$dueno     = $_GET['dueno']     ?? '';
$matricula = $_GET['matricula'] ?? '';
$marca     = $_GET['marca']     ?? '';
$modelo    = $_GET['modelo']    ?? '';
$color     = $_GET['color']     ?? '';

// Configuración de paginación.
$porPagina = 25;
$pagina    = max(1, intval($_GET['pagina'] ?? 1));
$offset    = ($pagina - 1) * $porPagina;

// Construir la cláusula WHERE según los filtros aplicados.
$where = "WHERE 1=1";
if (!empty($dueno))     $where .= " AND u.NoControl LIKE '%$dueno%'";
if (!empty($matricula)) $where .= " AND c.Matricula LIKE '%$matricula%'";
if (!empty($marca))     $where .= " AND c.Marca LIKE '%$marca%'";
if (!empty($modelo))    $where .= " AND c.Modelo LIKE '%$modelo%'";
if (!empty($color))     $where .= " AND c.Color LIKE '%$color%'";

// Consulta base para contar el total de vehículos con los filtros aplicados.
$sqlBase = "FROM Carro c
INNER JOIN Usuario u ON c.ID_Usuario = u.ID_Usuario
$where";

// Calcular el total de vehículos para paginación.
$resultTotal    = $conn->query("SELECT COUNT(*) AS total $sqlBase");
$totalRegistros = $resultTotal->fetch_assoc()['total'];
$totalPaginas   = ceil($totalRegistros / $porPagina);

// Consulta SQL para obtener los vehículos filtrados y paginados.
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

// Ejecutar la consulta para obtener los vehículos.
$resultVehiculos = $conn->query($sql);

// Verificar si la consulta fue exitosa.
if (!$resultVehiculos) {
    die("Error en la consulta: " . $conn->error);
}