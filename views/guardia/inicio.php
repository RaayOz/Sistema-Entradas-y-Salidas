<?php
session_start();

if(!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 2){
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>
<body>

    <?php include("sidebar.php"); ?>

    <div class="container">
        <div class="card">
            <h1>Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
        
            <p>Numero de Control: <?php echo $_SESSION['nocontrol']; ?></p>
        </div>
    </div>

</body>
</html>