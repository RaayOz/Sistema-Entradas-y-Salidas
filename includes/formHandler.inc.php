<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Requiere que los datos ingresados sean mediante el metodo POST para seguridad.
    //Datos personales del usuario.
    $nombre = $_POST["nombreUsuario"];
    $apellidos = $_POST["apellidos"];
    //Datos Escolares del alumno.
    $numeroControl = $_POST["numeroControl"];
    $curp = $_POST["curp"];
    $tipo_usuario = $_POST["tipo_usuario"];
    $telefono = $_POST["numeroEmergencia"];

    try {
        require_once "dbh.inc.php"; //Checa que la base de datos este conectada.

        $query = "INSERT INTO Usuario (NoControl, Nombres, Apellidos, CURP, Telefono, Foto, Categoria)
        VALUES 
        (?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$numeroControl, $nombre, $apellidos, $curp, $telefono,"Esta es una foto.", $tipo_usuario]);

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