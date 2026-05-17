<?php

require_once __DIR__ . '/../config/conexion.php';

$fechaHoy = date("Y-m-d");

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

$resultRegistros = $conn->query($sql);

if (!$resultRegistros) {
    die("Error en la consulta: " . $conn->error);
}
