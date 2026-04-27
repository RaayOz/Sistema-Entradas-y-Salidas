<?php

require_once __DIR__ . '/../config/conexion.php';

$metodo = $_GET['metodo'] ?? '';
$fecha = $_GET['fecha'] ?? '';
$hora = $_GET['hora'] ?? '';
$usuario = $_GET['usuario'] ?? '';
$matricula = $_GET['matricula'] ?? '';

$sql = "SELECT 
r.ID_Registro, 
u.NoControl AS NoControl, 
r.EntradaSalida AS EntradaSalida, 
r.MetodoAcceso AS MetodoAcceso, 
c.Matricula AS Matricula, 
r.Fecha AS Fecha, 
r.Hora AS Hora, 
r.Lugar AS Lugar, 
r.Motivo AS Motivo
FROM Registro r
INNER JOIN Usuario u ON r.ID_Usuario = u.ID_Usuario
LEFT JOIN Carro c ON r.ID_Carro = c.ID_Carro
WHERE 1=1
ORDER BY r.Fecha DESC, r.Hora DESC";

if (!empty($metodo)) {
    $sql .= " AND r.MetodoAcceso = '$metodo'";
}

if (!empty($fecha)) {
    $sql .= " AND r.Fecha = '$fecha'";
}

if (!empty($hora)) {
    $sql .= " AND r.Hora LIKE '$hora%'";
}

if (!empty($usuario)) {
    $sql .= " AND u.NoControl LIKE '%$usuario%'";
}

if (!empty($matricula)) {
    $sql .= " AND c.Matricula LIKE '%$matricula%'";
}

$resultRegistros = $conn->query($sql);

if (!$resultRegistros) {
    die("Error en la consulta: " . $conn->error);
}
