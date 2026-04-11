<?php
session_start();

if(!isset($_SESSION['usuario'], $_SESSION['nocontrol'])){ //Si no hay una sesion iniciada, manda a index.php
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Panel</title>
</head>

<body>

<h1>Bienvenido <?php echo $_SESSION['usuario']; ?></h1>

<p>Numero de Control: <?php echo $_SESSION['nocontrol']; ?></p>

<a href="registros.php">Registrar Usuario</a>

<a href="../../includes/logout.php">Cerrar sesión</a>

</body>
</html>