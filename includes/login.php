<?php
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Requiere que los datos ingresados sean mediante el metodo POST para seguridad.
    //Datos personales del usuario.
    $numeroControl = $_POST["numeroControl"];
    $contrasena = $_POST["contrasena"];

    try {
        require_once "dbh.inc.php"; //Checa que la base de datos este conectada.

        $query = "SELECT * FROM Usuario WHERE NoControl = :numeroControl; ";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":numeroControl", $numeroControl);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ((count($result)) > 0) 
            {
                foreach ($result as $row) {
                    if ($row["Contrasena"] == $contrasena){
                        switch ($row["ID_Rol"]) {
                            case 3:
                                {
                                    header("location: ../Usuarios/alumno.php");
                                    break;
                                }
                            case 4:
                                {
                                    header("location: ../Usuarios/Docente.php");
                                    break;
                                }
                            case 1:
                                {
                                    header("location: ../Usuarios/buscar_registrar.php");
                                    break;
                                }
                            case 2:
                                {
                                    header("location: ../Usuarios/Guardia.php");
                                    break;
                                }
                            default:
                            {
                                echo "Error no previsto...";
                                break;
                            }
                        }
                    }
                    else {
                        echo "Failure";
                    }
                }
        }


        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query Fallada" . $e->getMessage());
    }
}
else {
    header("location: ../index.php");//Regresa a index si se intenta ingresar datos malos.
}
?>