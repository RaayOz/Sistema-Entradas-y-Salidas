
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Inicio de Sesión</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="container">
<div class="card">

<div class="logo">
<img src="img/logo.png">
</div>

<h2>Inicio de Sesión</h2>
<p class="subtitle">Sistema SIESA</p>

<form action="includes/login.php" method="POST">

    <label>Numero De Control</label>
    <input type="number" name="numeroControl" required>

    <label>CURP</label>
    <input type="password" name="contrasena" required>

    <button class="boton" type="submit">Iniciar Sesión</button>

</form>

</div>
</div>

</body>
</html>
