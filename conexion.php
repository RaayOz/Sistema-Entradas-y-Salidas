<?php
$serverName = "SEISA";

$connectionOptions = [
    "Database" => "SIESA",
    "Authentication" => "Windows"
];

$conexion = sqlsrv_connect($serverName, $connectionOptions);

if (!$conexion) {
    die(print_r(sqlsrv_errors(), true));
}
?>