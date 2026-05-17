<?php
/**
 * Registra un nuevo usuario en la base de datos.
 *
 * Inserta un registro en la tabla Usuario y muestra un mensaje simple
 * de resultado junto con un botón para volver a la página correspondiente.
 */
require_once __DIR__ . '/../config/conexion.php';

// Obtener los datos del formulario enviados por POST.
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nocontrol = $_POST['nocontrol'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$rol = $_POST['rol'];
$telefono = $_POST['telefono'];

// Verificar si ya existe un usuario con el mismo número de control.
$sqlUsuario = "SELECT ID_Usuario FROM Usuario WHERE NoControl = '$nocontrol'";
$result = $conn->query($sqlUsuario);

// Si se encuentra un usuario con el mismo NoControl, mostrar mensaje de error.
if ($result && $result->num_rows > 0) {
    echo "Ya existe un usuario con ese número de control";
    exit;
}

// Preparar la consulta SQL para insertar el nuevo usuario.
$sql = "INSERT INTO Usuario 
    (Nombres, Apellidos, NoControl, Correo, Contrasena, ID_Rol, Telefono)
    VALUES 
    ('$nombre','$apellidos','$nocontrol','$correo','$contrasena','$rol','$telefono')";

// Ejecutar la consulta y mostrar el resultado.
if ($conn->query($sql) === TRUE) {
    $sqlrol = "SELECT NombreRol FROM Rol WHERE ID_Rol = '$rol'";
    $resultrol = $conn->query($sqlrol);

// Obtener el nombre del rol para mostrar en el mensaje de éxito.
    $nombrerol = "Usuario";
    if ($resultrol && $resultrol->num_rows > 0) {
        $fila = $resultrol->fetch_assoc();
        $nombrerol = $fila['NombreRol'];
    }

// Mostrar mensaje de éxito y botón para volver a la página correspondiente según el rol.
    echo "$nombrerol Registrado Correctamente";
    if ($rol == 4) {
        echo '<button class="boton" onclick="window.location.href=\'../views/guardia/visitante.php\'">Volver</button>';
    } else {
        echo '<button class="boton" onclick="window.location.href=\'../views/admin/registros.php\'">Volver</button>';
    }
} else {
    echo "Error: " . $conn->error;
}
