<?php

require_once __DIR__ . '/../config/conexion.php';

$nocontrol = $_SESSION['nocontrol'];

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

$resultRegistros = $conn->query($sql);

if (!$resultRegistros) {
    die("Error en la consulta: " . $conn->error);
}