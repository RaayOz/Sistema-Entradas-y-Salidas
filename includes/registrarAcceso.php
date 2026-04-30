<?php
session_start();

include("../config/conexion.php");
include("mensajes.php");

$nocontrol = $_POST['nocontrol'];
$matricula = $_POST['matricula'] ?? null;
$metodoacceso = $_POST['metodoacceso'];
$motivo = $_POST['motivo'] ?? null;

$fecha = date("Y-m-d");
$hora = date("H:i:s");
$lugar = "Unidad Tomas de Aquino";

$cupo_maximo = 50;

function redirigir($metodo)
{
	if ($metodo == "Peatonal") {
		header("Location: ../views/guardia/peatonal.php");
	} else {
		header("Location: ../views/guardia/vehicular.php");
	}
	exit;
}

if (!empty($motivo)) {
	$motivo = $_POST['motivo'];
} else {
	$motivo = "HORARIO ESCOLAR";
}

$sqlUsuario = "SELECT ID_Usuario FROM Usuario WHERE NoControl='$nocontrol'";
$result = $conn->query($sqlUsuario);

if ($result->num_rows == 0) {
	setMensaje("error", "No existe ese usuario");
	redirigir($metodoacceso);
}

$usuario = $result->fetch_assoc();
$id_usuario = $usuario['ID_Usuario'];

$sqlRegistro = "SELECT EntradaSalida FROM Registro 
WHERE ID_Usuario='$id_usuario' AND Fecha='$fecha' 
ORDER BY ID_Registro DESC LIMIT 1";

$resultRegistro = $conn->query($sqlRegistro);

if ($resultRegistro->num_rows == 0) {
	$entradasalida = "Entrada";
} else {
	$ultimo = $resultRegistro->fetch_assoc();

	if ($ultimo['EntradaSalida'] == "Entrada") {
		$entradasalida = "Salida";
	} else {
		$entradasalida = "Entrada";
	}
}

$sqlConteo = "
SELECT 
    COALESCE(SUM(CASE WHEN EntradaSalida = 'Entrada' THEN 1 ELSE 0 END),0) -
    COALESCE(SUM(CASE WHEN EntradaSalida = 'Salida' THEN 1 ELSE 0 END),0) 
    AS total
FROM Registro
WHERE MetodoAcceso = 'Vehicular'
";

$resultConteo = $conn->query($sqlConteo);
$filaConteo = $resultConteo->fetch_assoc();
$autos_dentro = $filaConteo['total'] ?? 0;
$totalVehiculos = $cupo_maximo - $autos_dentro;

if ($metodoacceso == "Vehicular" && $entradasalida == "Entrada") {
	if ($autos_dentro >= $cupo_maximo) {
		setMensaje("error", "Estacionamiento lleno");
		redirigir($metodoacceso);
	}
}

$id_carro = null;

if (!empty($matricula)) {
	$sqlBuscarCarro = "SELECT ID_Carro FROM Carro WHERE Matricula='$matricula'";
	$resultCarro = $conn->query($sqlBuscarCarro);

	if ($resultCarro->num_rows > 0) {
		$id_carro = $resultCarro->fetch_assoc()['ID_Carro'];
	} else {
		setMensaje("error", "La matrícula no está registrada");
		redirigir($metodoacceso);
	}
}

$sql = "INSERT INTO Registro 
(ID_Usuario, ID_Carro, EntradaSalida, MetodoAcceso, Fecha, Hora, Lugar, Motivo)
VALUES 
('$id_usuario','$id_carro','$entradasalida','$metodoacceso','$fecha','$hora','$lugar','$motivo')";

if ($conn->query($sql) === TRUE) {
	setMensaje("exito", "Acceso registrado correctamente");
	redirigir($metodoacceso);
} else {
	setMensaje("error", "Error al registrar el acceso");
	redirigir($metodoacceso);
}
