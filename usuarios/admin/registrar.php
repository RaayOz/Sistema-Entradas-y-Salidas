<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registrar usuario.</title>
<link rel="stylesheet" href="">
</head>

<body> 
    <div class="card" name="registrarUsuario">
        <p class="subtitle">
                Datos personales del usuario.
            </p>

            <form action="../../includes/formHandler.inc.php" method="POST">
                <label>Nombre</label>
                <input type="text" name="nombreUsuario" placeholder="Nombre" required>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" placeholder="Apellidos" required>
            

            <p class="subtitle">
                Datos Escolares del usuario.
            </p>
                <!--Correo-->
                <label for="correo">Correo</label>
                <input type="text" name="correo" placeholder="Correo" required>
                <!--Numero De Control-->
                <label for="numeroControl">Numero de control</label>
                <input type="number" name="numeroControl" placeholder="Numero de control" required>
                <!--CURP-->
                <label for="contrasena">Contrasena</label>
                <input type="text" name="contrasena" placeholder="Contrasena" required>
                <!--Rol-->
                <input type="radio" name="tipo_usuario" value="1"> Administrador
                <input type="radio" name="tipo_usuario" value="2"> Guardia
                <input type="radio" name="tipo_usuario" value="3"> Alumno

            <p class="subtitle">
                Datos opcionales del alumno.
            </p>

                <label for="numeroEmergencia">Numero de contacto para emergencia.</label>
                <input type="number" name="numeroEmergencia" placeholder="1234">

            <button class="boton"> Registrar datos</button>
            </form>
    </div>
</body>