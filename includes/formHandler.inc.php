<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Requiere que los datos ingresados sean mediante el metodo POST para seguridad.
    //Datos personales del usuario.
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    //Datos Escolares del alumno.
    $correo = $_POST["correo"];
    $nocontrol = $_POST["nocontrol"];
    $contrasena = $_POST["contrasena"];
    $rol = $_POST["rol"];
    $telefono = $_POST["telefono"];

    try {
        require_once "dbh.inc.php"; //Checa que la base de datos este conectada.

        if ($pdo === null) {
            throw new PDOException("Database connection failed.");
        }

        $query = "INSERT INTO Usuario (NoControl, Nombres, Apellidos, Correo, Contrasena, Telefono, Foto, ID_Rol)
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$nocontrol, $nombre, $apellidos, $correo, $contrasena, $telefono, "Esta es una foto.", $rol]);

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