<?php
/**
 * Recupera el historial de accesos del usuario actualmente en sesión.
 *
 * Filtra los registros por NoControl del usuario y devuelve los datos
 * para su visualización en la vista de historial.
 */
require_once __DIR__ . '/../config/conexion.php';

// Obtener el NoControl del usuario desde la sesión para filtrar los registros.
$nocontrol = $_SESSION['nocontrol'];

// Preparar la consulta SQL para obtener el historial de accesos del usuario con detalles del vehículo.
$sql = "SELECT 
    r.EntradaSalida AS EntradaSalida,
    r.MetodoAcceso  AS MetodoAcceso,
    c.Matricula     AS Matricula,
    r.Fecha         AS Fecha,
    r.Hora          AS Hora,
    r.Lugar         AS Lugar,
    r.Motivo        AS Motivo
FROM Registro r
INNER JOIN Usuario u ON r.ID_Usuario = u.ID_Usuario
LEFT JOIN Carro c ON r.ID_Carro = c.ID_Carro
WHERE u.NoControl = '$nocontrol'
ORDER BY r.Fecha DESC, r.Hora DESC";

// Ejecutar la consulta para obtener el historial de accesos del usuario.
$resultRegistros = $conn->query($sql);

// Verificar si la consulta fue exitosa.
if (!$resultRegistros) {
    die("Error en la consulta: " . $conn->error);
}