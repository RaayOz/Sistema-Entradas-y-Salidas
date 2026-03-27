<?php
//ini_set('display_errors', 1); // Esto solo se usa para debugging, imprime cualquier error de php.

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Requiere que los datos ingresados sean mediante el metodo POST para seguridad.

    //Datos personales del usuario.
    $numeroControl = $_POST["numeroControl"];
    $contrasena = $_POST["contrasena"];

    try {

        $query = "SELECT * FROM Usuario WHERE NoControl = :numeroControl; "; //Consulta que lee el Numero de control y manda los datos del usuario.

        $stmt = $pdo->prepare($query); //Prepara la consulta.

        $stmt->bindParam(":numeroControl", $numeroControl); //Manda a la consulta el numero de control
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Manda todos los datos de la consulta a un arreglo para utilizarlo en php.

        if ((count($result)) > 0) 
            {
                foreach ($result as $row) {
                    if ($row["Contrasena"] == $contrasena){
                        switch ($row["ID_Rol"]) {
                            case 1: //Manda a pagina para admin
                                {   //Porfa NO muevan los nombres de los archivos
                                    header("location: ../usuarios/buscar_registrar.php");
                                    break;
                                }
                            case 2: //Manda a Guardia
                                {
                                    header("location: ../usuarios/guardia.php");
                                    break;
                                }
                                case 3: //Manda a Alumno.
                                {
                                    header("location: ../usuarios/alumno.php");
                                    break;
                                }
                            default: //Por si hay errores.
                            {
                                echo "Error no previsto...";
                                break;
                            }
                        }
                    }
                    else { //Cuando no exista el numero de control
                        //TODO: Hacer que esto se vea bonito.
                        echo "Usuario no encontrado...";
                    }
                }

                exit();

            } else {
                echo "Número de control o contraseña incorrectos";
            }
            

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {

        die("Query fallida: " . $e->getMessage());

    }
}
else {
    header("location: ../index.php"); //Regresa a index si se intenta ingresar datos malos.
}
?>