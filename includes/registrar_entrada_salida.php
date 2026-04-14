 <?php
 ini_set('display_errors', 1);
//TODO: Verificar que el usuario existe antes de registrar entrada. !!!LISTO
//TODO: Agregar ingreso de vehiculos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Variables de el registro de entrada
    $tipoRegistro = $_POST["tipoRegistro"];
    $lugarEntrada = $_POST["lugarEntrada"];
    //$metodoAcceso = $_POST["metodoAcceso];
    $numeroControl = $_POST["numeroControl"];

    //Codig
    try {
        require_once "dbh.inc.php";

        //Checa que el usuario este en la base de datos.
        $query_usuario = "SELECT NoControl FROM Usuario WHERE NoControl = :numeroControl";

        $stmt = $pdo->prepare($query_usuario);
        $stmt->bindParam(":numeroControl", $numeroControl, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

        if  (!empty( $resultado )) {
            //Codigo para registrar a la base de datos la entrada/salida.
            $query = "INSERT INTO Registro(ID_Usuario, EntradaSalida, Lugar)
                    VALUES (
                    (SELECT ID_Usuario FROM Usuario WHERE NoControl = :numeroControl),
                    :tipoRegistro,
                    :lugarEntrada);";

            $stmt = $pdo->prepare($query);
            
            //Ingresa los datos a la consulta
            $stmt->bindParam(":numeroControl", $numeroControl);
            $stmt->bindParam(":tipoRegistro", $tipoRegistro);
            $stmt->bindParam(":lugarEntrada", $lugarEntrada);

            $stmt->execute();

            echo "<p>Ingresado a la base de datos!";
            $pdo = null;
            $stmt = null;
        } else {
            echo "<p>Usuario no existe...";
        }
} catch (PDOException $e) {
    die("Query fallada" . $e->getMessage());
}}
else {
    header("location: ../index.php");
}
?>