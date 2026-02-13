<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Requiere que los datos ingresados sean mediante el metodo POST para seguridad.
    //Datos personales del usuario.
    $nombre = $_POST["nombreUsuario"];
    $apellidoPat = $_POST["apellidoPaterno"];
    $apellidoMat = $_POST["apellidoMaterno"];
    //Datos Escolares del alumno.
    $numeroControl = $_POST["numeroControl"];
    $curp = $_POST["curp"];

    try {
        require_once "dbh.inc.php"; //Checa que la base de datos este conectada.

        $query = "INSERT INTO usuarios (nombre, numero_control, apellido_pat, apellido_mat, contra, tipo_usuario)
        VALUES 
        (?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$nombre,$numeroControl,$apellidoPat,$apellidoMat,$curp,"Alumno"]);

        $pdo = null;
        $stmt = null;
        header("location: ../Registro_Alumno.php");
    } catch (PDOException $e) {
        die("Query Fallada" . $e->getMessage());
    }
}
else {
    header("location: ../index.php");//Regresa a index si se intenta ingresar datos malos.
}