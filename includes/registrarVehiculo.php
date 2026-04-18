<?php
include("../config/conexion.php");

$nocontrol = $_POST['nocontrol'];
$matricula = $_POST['matricula'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];

$sqlUsuario = "SELECT ID_Usuario FROM Usuario WHERE NoControl = '$nocontrol'";
$result = $conn->query($sqlUsuario);

if($result->num_rows == 0){
    echo "No existe un usuario con ese número de control";
    exit;
}

$usuario = $result->fetch_assoc();
$id_usuario = $usuario['ID_Usuario'];

$sql = "INSERT INTO Carro (ID_Usuario, Matricula, Marca, Modelo, Color) VALUES ('$id_usuario', '$matricula', '$marca', '$modelo', '$color')";

if ($conn->query($sql) === TRUE) {
    echo "Vehículo registrado correctamente";
    echo '<button class="boton" onclick="window.location.href=\'../views/admin/vehiculo.php\'">Volver</button>';
} else {
    echo "Error: " . $conn->error;
}
?>