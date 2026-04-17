<?php
include("../config/conexion.php");

$nocontrol = $_POST['nocontrol'];
$matricula = $_POST['matricula'];
$entradasalida = $_POST['entradasalida'];
$metodoacceso = $_POST['metodoacceso'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$lugar = $_POST['lugar'];

$sqlUsuario = "SELECT ID_Usuario FROM Usuario WHERE NoControl = '$nocontrol'";
$result = $conn->query($sqlUsuario);

if (!empty($matricula)) {
    $sqlCarro = "SELECT ID_Carro FROM Carro WHERE Matricula = '$matricula'";
    $resultCarro = $conn->query($sqlCarro);

    if ($resultCarro->num_rows > 0) {
        $carro = $resultCarro->fetch_assoc();
        $id_carro = $carro['ID_Carro'];
    } else {
        echo "No existe un carro con esa matrícula";
        exit;
    }
} else {
    $id_carro = null;
}

if($result->num_rows > 0){

    $usuario = $result->fetch_assoc();
    $id_usuario = $usuario['ID_Usuario'];

    $sql = "INSERT INTO Registro 
    (ID_Usuario, ID_Carro, EntradaSalida, MetodoAcceso, Fecha, Hora, Lugar)
    VALUES 
    ('$id_usuario','$id_carro','$entradasalida','$metodoacceso','$fecha','$hora','$lugar')";

    if ($conn->query($sql) === TRUE) {
        echo "Acceso registrado correctamente";
        echo '<button class="boton" onclick="window.location.href=\'../views/guardia/inicio.php\'">Volver al Inicio</button>';
    } else {
        echo "Error: " . $conn->error;
    }

}else{
    echo "No existe un usuario con ese número de control";
}
?>