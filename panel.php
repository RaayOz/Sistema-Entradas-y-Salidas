<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}
?>

<?php
session_start();

if(!isset($_SESSION['nocontrol'])){
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

<button class="boton"><a href="logout.php">Cerrar sesión</a></button>

</body>
</html>