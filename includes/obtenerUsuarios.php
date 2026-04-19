<?php

require_once __DIR__ . '/../config/conexion.php';

$sql = "SELECT 
u.ID_Usuario,
u.NoControl,
u.Nombres,
u.Apellidos,
u.Correo,
u.Telefono,
r.NombreRol
FROM Usuario u
INNER JOIN Rol r
ON u.ID_Rol = r.ID_Rol";

$resultUsuarios = $conn->query($sql);

if(!$resultUsuarios){
    die("Error en la consulta: " . $conn->error);
}

?>