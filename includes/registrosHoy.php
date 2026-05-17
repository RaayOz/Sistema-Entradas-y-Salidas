<?php
/**
 * Obtiene los registros de acceso del día actual.
 *
 * Usa la fecha del servidor para filtrar los registros del día y
 * devuelve el conjunto para mostrarlo en la vista correspondiente.
 */
require_once __DIR__ . '/../config/conexion.php';

// Obtener la fecha actual en formato YYYY-MM-DD para filtrar los registros.
$fechaHoy = date("Y-m-d");

// Preparar la consulta SQL para obtener los registros del día actual con detalles del usuario y vehículo.
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
FROM Registro r
INNER JOIN Usuario u ON r.ID_Usuario = u.ID_Usuario
LEFT JOIN Carro c ON r.ID_Carro = c.ID_Carro
WHERE r.Fecha = '$fechaHoy'
ORDER BY r.Hora DESC";

// Ejecutar la consulta para obtener los registros del día.
$resultRegistros = $conn->query($sql);

// Verificar si la consulta fue exitosa.
if (!$resultRegistros) {
    die("Error en la consulta: " . $conn->error);
}
