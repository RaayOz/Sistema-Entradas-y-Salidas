<?php
/**
 * Exporta los registros filtrados a CSV.
 *
 * Recibe parámetros opcionales por GET para aplicar filtros sobre los
 * registros, luego envía el resultado como descarga CSV.
 */
require_once __DIR__ . '/../config/conexion.php';

// Leer los parámetros de filtro desde GET.
$metodo    = $_GET['metodo']    ?? '';
$fecha     = $_GET['fecha']     ?? '';
$hora      = $_GET['hora']      ?? '';
$usuario   = $_GET['usuario']   ?? '';
$matricula = $_GET['matricula'] ?? '';

// Construir la cláusula WHERE según los filtros aplicados.
$where = "WHERE 1=1";
if (!empty($metodo))    $where .= " AND r.MetodoAcceso = '$metodo'";
if (!empty($fecha))     $where .= " AND r.Fecha = '$fecha'";
if (!empty($hora))      $where .= " AND r.Hora LIKE '$hora%'";
if (!empty($usuario))   $where .= " AND u.NoControl LIKE '%$usuario%'";
if (!empty($matricula)) $where .= " AND c.Matricula LIKE '%$matricula%'";

// Consulta SQL para obtener los registros filtrados.
$sql = "SELECT 
    u.NoControl, r.EntradaSalida, r.MetodoAcceso,
    c.Matricula, r.Fecha, r.Hora, r.Lugar, r.Motivo
FROM Registro r
INNER JOIN Usuario u ON r.ID_Usuario = u.ID_Usuario
LEFT JOIN Carro c ON r.ID_Carro = c.ID_Carro
$where
ORDER BY r.Fecha DESC, r.Hora DESC";

// Ejecutar la consulta y preparar la salida CSV.
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa.
$nombreArchivo = 'registros_' . date('Y-m-d') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');

$output = fopen('php://output', 'w');
fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

fputcsv($output, ['No. Control', 'Tipo Acceso', 'Método', 'Matrícula', 'Fecha', 'Hora', 'Lugar', 'Motivo']);

// Escribir cada fila del resultado en el archivo CSV.
while ($fila = $result->fetch_assoc()) {
    fputcsv($output, [
        $fila['NoControl'],
        $fila['EntradaSalida'],
        $fila['MetodoAcceso'],
        $fila['Matricula'],
        $fila['Fecha'],
        $fila['Hora'],
        $fila['Lugar'],
        $fila['Motivo'],
    ]);
}

fclose($output);
exit;