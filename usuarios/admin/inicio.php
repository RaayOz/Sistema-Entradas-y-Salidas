<?php
session_start();
if(!isset($_SESSION['usuario'], $_SESSION['nocontrol'])){ //Si no hay una sesion iniciada, manda a index.php
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="../../desing/styles.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h1>Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
        
        <p>Numero de Control: <?php echo $_SESSION['nocontrol']; ?></p>
        
        <button class="boton" onclick="window.location.href='registros.php'">Registrar Usuario</button>

        <button class="boton" onclick="window.location.href='../../includes/logout.php'">Cerrar sesión</button>
    </div>
</div>

</body>
</html>