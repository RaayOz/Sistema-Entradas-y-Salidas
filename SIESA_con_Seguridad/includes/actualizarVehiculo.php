<?php

require_once "../config/conexion.php";

$id = $_POST['id'];
$matricula = $_POST['matricula'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];

$sql = "UPDATE Carro SET 
Matricula='$matricula',
Marca='$marca',
Modelo='$modelo',
Color='$color'
WHERE ID_Carro='$id'";

if ($conn->query($sql)) {
    header("Location: ../views/admin/verVehiculos.php");
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>