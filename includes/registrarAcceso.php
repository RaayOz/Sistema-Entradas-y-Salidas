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

function redirigir($metodo)
{
	if (!empty($motivo)) {
		if ($metodo == "Peatonal") {
			header("Location: ../views/guardia/peatonal.php");
		} else {
			header("Location: ../views/guardia/vehicular.php");
		}
	} else {
		if ($metodo == "Peatonal") {
			header("Location: ../views/guardia/peatonalV.php");
		} else {
			header("Location: ../views/guardia/vehicularV.php");
		}
	}
	exit;
}

$sqlUsuario = "SELECT ID_Usuario FROM Usuario WHERE NoControl='$nocontrol'";
$result = $conn->query($sqlUsuario);

if ($result->num_rows == 0) {
	setMensaje("error", "No existe ese usuario");
	redirigir($metodoacceso);
}

$usuario = $result->fetch_assoc();
$id_usuario = $usuario['ID_Usuario'];

$sqlRegistro = "SELECT EntradaSalida FROM Registro WHERE ID_Usuario='$id_usuario' AND Fecha='$fecha' ORDER BY ID_Registro DESC LIMIT 1";
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

if (!empty($motivo)) {
		if (!empty($matricula)) {
		$sql = "INSERT INTO Carro (ID_Usuario, Matricula) VALUES ('$id_usuario', '$matricula')";
		if ($conn->query($sql) === TRUE) {
			$id_carro = $conn->insert_id;
		} else {
			setMensaje("error", "Error al registrar el vehículo");
			redirigir($metodoacceso);
		}
	}
} else {
	if (!empty($matricula)) {
		$sqlCarro = "SELECT ID_Carro FROM Carro WHERE Matricula='$matricula'";
		$resultCarro = $conn->query($sqlCarro);

		if ($resultCarro->num_rows > 0) {
			$carro = $resultCarro->fetch_assoc();
			$id_carro = $carro['ID_Carro'];
		} else {
			setMensaje("error", "No existe un carro con esa matrícula");
			redirigir($metodoacceso);
		}
	} else {
		$id_carro = null;
	}
}

$sql = "INSERT INTO Registro (ID_Usuario, ID_Carro, EntradaSalida, MetodoAcceso, Fecha, Hora, Lugar, Motivo)
VALUES ('$id_usuario','$id_carro','$entradasalida','$metodoacceso','$fecha','$hora','$lugar','$motivo')";

if ($conn->query($sql) === TRUE) {
	setMensaje("exito", "Acceso registrado correctamente");
	redirigir($metodoacceso);
} else {
	setMensaje("error", "Error al registrar el acceso");
	redirigir($metodoacceso);
}