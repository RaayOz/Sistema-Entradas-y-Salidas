<?php
/**
 * Recupera usuarios paginados y filtrados para la vista administrativa.
 *
 * Admite filtros opcionales por número de control y rol.
 */
require_once __DIR__ . '/../config/conexion.php';

// Leer los parámetros de filtro desde GET.
$nocontrol = $_GET['nocontrol'] ?? '';
$rol       = $_GET['rol']       ?? '';

// Configuración de paginación.
$porPagina = 25;
$pagina    = max(1, intval($_GET['pagina'] ?? 1));
$offset    = ($pagina - 1) * $porPagina;

// Construir la cláusula WHERE según los filtros aplicados.
$where = "WHERE 1=1";
if (!empty($nocontrol)) $where .= " AND u.NoControl LIKE '%$nocontrol%'";
if (!empty($rol))       $where .= " AND r.NombreRol = '$rol'";

// Consulta base para contar el total de usuarios con los filtros aplicados.
$sqlBase = "FROM Usuario u
INNER JOIN Rol r ON u.ID_Rol = r.ID_Rol
$where";

// Calcular el total de usuarios para paginación.
$resultTotal    = $conn->query("SELECT COUNT(*) AS total $sqlBase");
$totalRegistros = $resultTotal->fetch_assoc()['total'];
$totalPaginas   = ceil($totalRegistros / $porPagina);

// Consulta SQL para obtener los usuarios filtrados y paginados.
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

// Ejecutar la consulta para obtener los usuarios.
$resultUsuarios = $conn->query($sql);

// Verificar si la consulta fue exitosa.
if (!$resultUsuarios) {
    die("Error en la consulta: " . $conn->error);
}