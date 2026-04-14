<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Requiere que los datos ingresados sean mediante el metodo POST para seguridad.
//Variables que reciben los datos del archivo buscar_registrar.php
    //Datos personales del usuario.
    $nombre = $_POST["nombreUsuario"];
    $apellidos = $_POST["apellidos"];
    //Datos Escolares del alumno.
    $correo = $_POST["correo"];
    $numeroControl = $_POST["numeroControl"];
    $contrasena = $_POST["contrasena"];
    $tipo_usuario = $_POST["tipo_usuario"];
    //Datos extras
    $telefono = $_POST["numeroEmergencia"];

    try {
        require_once "dbh.inc.php"; //Checa que la base de datos este conectada.

        $query = "INSERT INTO Usuario (NoControl, Nombres, Apellidos, Correo, Contrasena, Telefono, Foto, ID_Rol)
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?);"; //Crea una consulta para ingresar datos a la base.

        $stmt = $pdo->prepare($query);//Prepara la consulta.

        $stmt->execute([$numeroControl, $nombre, $apellidos, $correo, $contrasena, $telefono, "Esta es una foto.", $tipo_usuario]); //Asigna las variables a los datos.

        //Cierra la conexion por seguridad y reinicia la pagina.
        $pdo = null;
        $stmt = null;
        header("location: ../usuarios/admin/registrar.php");
    } catch (PDOException $e) { 
        //Por si hay un fallo en la conexion.
        die("Query Fallada" . $e->getMessage());
    }
}
else {
    header("location: ../index.php");//Regresa a index si se intenta ingresar datos malos.
}