<?php
session_start();

if(isset($_SESSION['usuario'])){

    switch ($_SESSION['rol']) {
        case 1:
            header("location: ../usuarios/admin/inicio.php");
            exit;

        case 2:
            header("location: ../usuarios/guardia/inicio.php");
            exit;

        case 3:
            header("location: ../usuarios/alumno/inicio.php");
            exit;

        default:
            header("location: views/login.php");
            exit;
    }

}else{
    header("Location: views/login.php");
    exit;
}
?>