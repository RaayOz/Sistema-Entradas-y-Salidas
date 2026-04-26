<?php

require_once __DIR__ . '/../config/conexion.php';

$dueno = $_GET['dueno'] ?? '';
$matricula = $_GET['matricula'] ?? '';
$marca = $_GET['marca'] ?? '';
$modelo = $_GET['modelo'] ?? '';
$color = $_GET['color'] ?? '';

$sql = "SELECT 
c.ID_Carro,
c.Matricula,
c.Marca,
c.Modelo,
c.Color,
u.NoControl AS NoControl
FROM Carro c
INNER JOIN Usuario u ON c.ID_Usuario = u.ID_Usuario
WHERE 1=1";

if (!empty($dueno)) {
    $sql .= " AND u.NoControl LIKE '%$dueno%'";
}

if (!empty($matricula)) {
    $sql .= " AND c.Matricula LIKE '%$matricula%'";
}

if (!empty($marca)) {
    $sql .= " AND c.Marca LIKE '%$marca%'";
}

if (!empty($modelo)) {
    $sql .= " AND c.Modelo LIKE '%$modelo%'";
}

if (!empty($color)) {
    $sql .= " AND c.Color LIKE '%$color%'";
}

$resultVehiculos = $conn->query($sql);

if (!$resultVehiculos) {
    die("Error en la consulta: " . $conn->error);
}