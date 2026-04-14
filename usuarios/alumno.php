<?php
/*TODO:
* Perfil y datos 
* RLista de los 10 ultimos registros
* Descargar reportes 
* Logout
*/ 
session_start();

$numeroControl = $_SESSION["sesionControl"];

try {
    require_once"../includes/dbh.inc.php";
    //Consulta para los datos del usuario.
    $query = "SELECT * FROM Usuario WHERE NoControl = :numeroControl";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":numeroControl", $numeroControl);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    
    //Consulta para los registros del usuario.
    $queryEntradas = "SELECT EntradaSalida, MetodoAcceso, Fecha, Hora, Lugar FROM Registro 
    WHERE ID_Usuario = (SELECT ID_Usuario FROM Usuario WHERE NoControl = :numeroControl);";

    $stmt = $pdo->prepare($queryEntradas);

    $stmt->bindParam(":numeroControl", $numeroControl);
    $stmt->execute();
    $resultEntradas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;
} catch (PDOException $e) {
    die ("Consulta fallida" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Datos de usuario</title>
<link rel="stylesheet" href="">
</head>

<body>
    <h1>Alumno</h1>
    <h2>Datos del alumno.</h2>

    <?php 
    //Imprime los datos del usuario
    if (!empty($result)) {
        foreach ($result as $row) {
            echo "<p>" . "Nombres: " . ($row["Nombres"]);
            echo "<p>" . "Apellidos: " . ($row["Apellidos"]);
            echo "<p>" . "Correo: " . ($row["Correo"]);
            echo "<p>" . "Agregar los demas datos <3";
            }
    } else {
        echo "Ni idea que paso lol";
    }
    ?>

    <h2>Entradas recientes</h2>
    <?php
    //Imprime todos los ingresos del usuario.
    if (!empty($resultEntradas)) {
        foreach ($resultEntradas as $row) {
            echo "<p>" . ' ' . $row["EntradaSalida"] . " " .  $row["Fecha"] .  " " . $row["Hora"] . " " . $row["Lugar"];
        } 
    } else {
            echo "<p>" . "No hay registros.";
        }
    ?>
</body>
</html>