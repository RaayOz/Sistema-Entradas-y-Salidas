<?php
include(__DIR__ . "/../config/conexion.php");

$nocontrol = $_SESSION['nocontrol'];

$sqlUser = "SELECT ID_Usuario FROM Usuario WHERE NoControl = '$nocontrol'";
$resUser = $conn->query($sqlUser);

if($resUser && $resUser->num_rows > 0){

    $user = $resUser->fetch_assoc();
    $id_usuario = $user['ID_Usuario'];

$sql = "SELECT 
            r.Fecha,
            r.Hora,
            r.EntradaSalida,
            r.MetodoAcceso,
            r.ID_Carro,
            r.ID_Guardia,
            u.NoControl,
            CONCAT(u.Apellidos, ' ', u.Nombres) AS NombreCompleto
        FROM Registro r
        INNER JOIN Usuario u ON r.ID_Usuario = u.ID_Usuario
        WHERE r.ID_Usuario = '$id_usuario'
        ORDER BY r.Fecha DESC, r.Hora DESC";

    $result = $conn->query($sql);

}else{
    $result = false;
}
?>