<?php
/*TODO:
* Perfil - Listo :D
* Registrar nuevo usuario - Listo :D
* Registrar entradas y salidas - Siento que esto es innecesario para el admin, no? - Ontiv
* Ver historial de entradas y salidas.
* Lista e historial de usuarios.
* Descargar reportes.
*/ 
session_start();

$numeroControl = $_SESSION["sesionControl"];

try {
    require_once"../../includes/dbh.inc.php";
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
<link rel="stylesheet" href="../../styles.css">
</head>
<body> 
        <!-- Navegacion -->
        <!-- DISENO: La idea es que esto este en la barra de al lado. -->
        <div class="container">
        <div class="card">
            <div class="logo">
                <img src="../../img/logo.png">
            </div>

            <div class="nav" id="navAdmin">
                <p><a href="buscar.php">Buscar usuario</a>
                <p></p><a href="registrar.php">Registrar nuevo usuario</a>
                <p></p><a href="">Historial de entradas y salidas</a>
                <p></p><a href="">Lista de usuarios</a>
            </div>

            <div class="logout">
                <button onclick="../../includes/logout.php">Cerrar Sesion</button>
            </div>
        </div>
        </div>

        <!-- Perfil del usuario -->
        <div class="container">
        <div class="card">
            <h2>Datos del usuario.</h2>
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
            <br>
            <button>Modificar datos</button> <!--Falta implementar lol-->
        </div>
        </div>
    </aside>
</body>