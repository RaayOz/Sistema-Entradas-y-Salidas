<?php
/**
 * Registra un nuevo vehículo en la base de datos.
 *
 * Verifica la existencia del usuario propietario y la unicidad de la matrícula
 * antes de insertar el registro en la tabla Carro.
 */
require_once __DIR__ . '/../config/conexion.php';

// Obtener los datos del formulario enviados por POST.
$nocontrol = $_POST['nocontrol'];
$matricula = $_POST['matricula'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];

// Buscar el usuario por NoControl.
$sqlUsuario = "SELECT ID_Usuario FROM Usuario WHERE NoControl = '$nocontrol'";
$result = $conn->query($sqlUsuario);

// Verificar que se encontró un usuario con el NoControl proporcionado.
if ($result->num_rows == 0) {
    echo "No existe un usuario con ese número de control";
    exit;
}

// Obtener el ID del usuario para asociar el vehículo.
$usuario = $result->fetch_assoc();
$id_usuario = $usuario['ID_Usuario'];

// Verificar que la matrícula no exista ya registrada.
$sqlCarro = "SELECT Matricula FROM Carro WHERE Matricula = '$matricula'";
$resultCarro = $conn->query($sqlCarro);

// Si se encuentra un vehículo con la misma matrícula, mostrar mensaje de error.
if ($resultCarro->num_rows > 0) {
    echo "Ya existe un vehículo con esa matrícula";
    exit;
}

// Preparar la consulta SQL para insertar el nuevo vehículo.
$sql = "INSERT INTO Carro (ID_Usuario, Matricula, Marca, Modelo, Color) VALUES ('$id_usuario', '$matricula', '$marca', '$modelo', '$color')";

// Ejecutar la consulta y mostrar el resultado.
if ($conn->query($sql) === TRUE) {
    echo "Vehículo registrado correctamente";
    echo '<button class="boton" onclick="window.location.href=\'../views/admin/vehiculo.php\'">Volver</button>';
} else {
    echo "Error: " . $conn->error;
}
?>