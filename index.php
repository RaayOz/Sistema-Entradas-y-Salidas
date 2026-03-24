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
<img src="logo.png">
</div>

<h2>Inicio de Sesión</h2>
<p class="subtitle">Sistema SIESA</p>

<form action="login.php" method="POST">

<label>Correo</label>
<input type="email" name="correo" required>

<label>Contraseña</label>
<input type="password" name="contrasena" required>

<button class="boton" type="submit">Iniciar Sesión</button>

</form>

</div>
</div>

</body>
</html>