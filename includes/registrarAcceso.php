<?php
/**
 * Registra el acceso de un usuario por peatonal o vehicular.
 *
 * Valida el usuario, determina si la acción es entrada o salida, controla
 * el cupo de vehículos y guarda el registro en la tabla Registro.
 */
session_start();

require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/mensajes.php';

// Leer los parámetros enviados por POST.
$nocontrol = $_POST['nocontrol'];
$matricula = $_POST['matricula'] ?? null;
$metodoacceso = $_POST['metodoacceso'];
$motivo = $_POST['motivo'] ?? null;

// Configurar fecha, hora, lugar y cupo máximo.
$fecha = date("Y-m-d");
$hora = date("H:i:s");
$lugar = "Unidad Tomas de Aquino";
$cupo_maximo = 50;

/**
 * Redirige según el método de acceso.
 *
 * @param string $metodo 'Peatonal' o 'Vehicular'.
 * @return void
 */
function redirigir($metodo)
{
    if ($metodo == "Peatonal") {
        header("Location: ../views/guardia/peatonal.php");
    } else {
        header("Location: ../views/guardia/vehicular.php");
    }
    exit;
}

// Si no se especifica motivo, usar valor predeterminado.
if (empty($motivo)) {
    $motivo = "HORARIO ESCOLAR";
}

// Buscar el usuario por NoControl.
$sqlUsuario = "SELECT ID_Usuario FROM Usuario WHERE NoControl='$nocontrol'";
$result = $conn->query($sqlUsuario);

// Verificar si el usuario existe.
if ($result->num_rows == 0) {
    setMensaje("error", "No existe ese usuario");
    redirigir($metodoacceso);
}

// Obtener el ID del usuario para registrar el acceso.
$usuario = $result->fetch_assoc();
$id_usuario = $usuario['ID_Usuario'];

// Determinar si se trata de entrada o salida según el último registro del día.
$sqlRegistro = "SELECT EntradaSalida FROM Registro 
WHERE ID_Usuario='$id_usuario' AND Fecha='$fecha' 
ORDER BY ID_Registro DESC LIMIT 1";
$resultRegistro = $conn->query($sqlRegistro);

// Si no hay registros previos, asumimos que es una entrada. De lo contrario, alternamos entre entrada y salida.
if ($resultRegistro->num_rows == 0) {
    $entradasalida = "Entrada";
} else {
    $ultimo = $resultRegistro->fetch_assoc();
    $entradasalida = ($ultimo['EntradaSalida'] == "Entrada") ? "Salida" : "Entrada";
}

// Contar vehículos dentro para limitar el cupo.
$sqlConteo = "
SELECT 
    COALESCE(SUM(CASE WHEN EntradaSalida = 'Entrada' THEN 1 ELSE 0 END),0) -
    COALESCE(SUM(CASE WHEN EntradaSalida = 'Salida' THEN 1 ELSE 0 END),0) 
    AS total
FROM Registro
WHERE MetodoAcceso = 'Vehicular'
";

// Ejecutar la consulta para contar los vehículos dentro.
$resultConteo = $conn->query($sqlConteo);
$filaConteo = $resultConteo->fetch_assoc();
$autos_dentro = $filaConteo['total'] ?? 0;

// Si es una entrada vehicular y el cupo está lleno, mostrar mensaje de error.
if ($metodoacceso == "Vehicular" && $entradasalida == "Entrada" && $autos_dentro >= $cupo_maximo) {
    setMensaje("error", "Estacionamiento lleno");
    redirigir($metodoacceso);
}

// Buscar el carro asociado a la matrícula si se provee.
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

// Preparar el valor de ID_Carro para la inserción, usando NULL si no se encontró o no se proporcionó.
$id_carro_sql = ($id_carro === null) ? "NULL" : "'$id_carro'";

// Insertar el registro de acceso en la tabla Registro.
$sql = "INSERT INTO Registro 
    (ID_Usuario, ID_Carro, EntradaSalida, MetodoAcceso, Fecha, Hora, Lugar, Motivo)
VALUES 
    ('$id_usuario',$id_carro_sql,'$entradasalida','$metodoacceso','$fecha','$hora','$lugar','$motivo')";

// Ejecutar la consulta para insertar el registro.
if ($conn->query($sql) === TRUE) {
    setMensaje("exito", "Acceso registrado correctamente");
    redirigir($metodoacceso);
} else {
    setMensaje("error", "Error al registrar el acceso");
    redirigir($metodoacceso);
}
