<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registro de usuario</title>
<link rel="stylesheet" href="styles.css">

<style>
.roles-box{
    border:1px solid #ccc;
    padding:10px;
    border-radius:5px;
    margin-bottom:15px;
}
</style>

</head>

<body>

<div class="container">
<div class="card">

<h2>Ingreso de datos</h2>

<p class="subtitle">
Datos personales del usuario
</p>

<form action="registrar_usuario.php" method="POST">

<label>Nombre</label>
<input type="text" name="nombre" placeholder="Nombre" required>

<label>Apellidos</label>
<input type="text" name="apellidos" placeholder="Apellidos" required>


<p class="subtitle">
Datos escolares del usuario
</p>

<label>Número de control</label>
<input type="number" name="nocontrol" placeholder="Número de control" required>

<label>Contraseña</label>
<input type="password" name="contrasena" placeholder="Contraseña" required>


<p class="subtitle">
Tipo de usuario
</p>

<div class="roles-box">

<label>
<input type="radio" name="rol" value="1" required>
Administrador
</label>
<br>

<label>
<input type="radio" name="rol" value="2">
Guardia
</label>
<br>

<label>
<input type="radio" name="rol" value="3">
Alumno
</label>

</div>


<p class="subtitle">
Datos opcionales
</p>

<label>Número de emergencia</label>
<input type="number" name="numeroEmergencia" placeholder="xxx-xxx-xxxx">


<button class="boton">Registrar usuario</button>

</form>

</div>
</div>

<a href="logout.php">Cerrar sesión</a>

</body>
</html>