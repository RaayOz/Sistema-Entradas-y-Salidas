<?php
ini_set('display_errors', 1);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nocontrol = $_POST["nocontrol"];
    $contrasena = $_POST["contrasena"];

    try {

        require_once "dbh.inc.php";

        if (!$pdo) {
            throw new PDOException("Database connection failed");
        }

        $query = "SELECT * FROM Usuario WHERE NoControl = :nocontrol";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":nocontrol", $nocontrol);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            if ($result["Contrasena"] == $contrasena) {

                $_SESSION["nombre"] = $result["Nombres"];
                $_SESSION["nocontrol"] = $result["NoControl"];
                $_SESSION["rol"] = $result["ID_Rol"];

                switch ($result["ID_Rol"]) {

                    case 1:
                        header("location: ../usuarios/admin.php");
                        break;

                    case 2:
                        header("location: ../usuarios/guardia.php");
                        break;

                    case 3:
                        header("location: ../usuarios/alumno.php");
                        break;

                    default:
                        echo "Error no previsto...";
                        break;
                }

                exit();

            } else {
                echo "Número de control o contraseña incorrectos";
            }

        } else {
            echo "Usuario no encontrado";
        }

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query fallida: " . $e->getMessage());
    }

} else {
    header("location: ../index.php");
}
?>