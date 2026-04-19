<?php

require_once __DIR__ . '/../config/conexion.php';

$sql = "SELECT 
c.ID_Carro,
c.Matricula,
c.Marca,
c.Modelo,
c.Color,
u.NoControl
FROM Carro c
INNER JOIN Usuario u
ON c.ID_Usuario = u.ID_Usuario";

$resultVehiculos = $conn->query($sql);

if(!$resultVehiculos){
    die("Error en la consulta: " . $conn->error);
}

?>