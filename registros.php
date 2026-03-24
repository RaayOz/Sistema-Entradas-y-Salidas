<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registro de usuario</title>
<link rel="stylesheet" href="styles.css">
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

<label>Apellido</label>
<input type="text" name="apellidos" placeholder="Apellidos" required>


<p class="subtitle">
Datos escolares del usuario
</p>

<label>Número de control</label>
<input type="text" name="nocontrol" placeholder="Número de control" required>

<label>CURP</label>
<input type="text" name="curp" placeholder="CURP" required>

<label>Contraseña</label>
<input type="password" name="contrasena" placeholder="Contraseña" required>

<label>Tipo de usuario</label>

<input type="radio" name="rol" value="2" required> Alumno
<input type="radio" name="rol" value="3"> Docente
<input type="radio" name="rol" value="1"> Administrador
<input type="radio" name="rol" value="4"> Guardia


<p class="subtitle">
Datos opcionales del alumno
</p>

<label>Número de emergencia</label>
<input type="text" name="numeroEmergencia" placeholder="xxx-xxx-xxxx">

<button class="boton">Registrar usuario</button>

</form>

</div>
</div>

</body>
</html>