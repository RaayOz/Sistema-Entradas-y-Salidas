<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Requiere que los datos ingresados sean mediante el metodo POST para seguridad.
    //Datos personales del usuario.
    $nombre = $_POST["nombreUsuario"];
    $apellidos = $_POST["apellidos"];
    //Datos Escolares del alumno.
    $correo = $_POST["correo"];
    $numeroControl = $_POST["numeroControl"];
    $curp = $_POST["curp"];
    $tipo_usuario = $_POST["tipo_usuario"];
    //Datos extras
    $telefono = $_POST["numeroEmergencia"];

    try {
        require_once "dbh.inc.php"; //Checa que la base de datos este conectada.

        $query = "INSERT INTO Usuario (NoControl, Nombres, Apellidos, Correo, Contrasena, Telefono, Foto, ID_Rol)
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$numeroControl, $nombre, $apellidos, $correo, $curp, $telefono, "Esta es una foto.", $tipo_usuario]);

        $pdo = null;
        $stmt = null;
        header("location: ../registros.php");
    } catch (PDOException $e) {
        die("Query Fallada" . $e->getMessage());
    }
}
else {
    header("location: ../index.php");//Regresa a index si se intenta ingresar datos malos.
}