<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Datos de usuario</title>
<link rel="stylesheet" href="../styles.css">
</head>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Datos usuario</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <div class="card">

                <h2>Ingreso de datos</h2>

                <p class="subtitle">
                    Datos personales del usuario.
                </p>

                <form action="includes/formHandler.inc.php" method="POST">
                    <label>Nombre</label>
                    <input type="text" name="nombre" placeholder="nombre" required>

                    <label for="apellidos">Apellido Paterno</label>
                    <input type="text" name="apellidos" placeholder="apellidos" required>
                

                <p class="subtitle">
                    Datos Escolares del usuario.
                </p>
                    <!--Correo-->
                    <label for="correo">Correo</label>
                    <input type="text" name="correo" placeholder="correo" required>
                    <!--Numero De Control-->
                    <label for="nocontrol">Numero de control</label>
                    <input type="number" name="nocontrol" placeholder="nocontrol" required>
                    <!--Contraseña-->
                    <label for="contrasena">Contraseña</label>
                    <input type="text" name="contrasena" placeholder="contrasena" required>
                    <!--Rol-->
                    <input type="radio" name="rol" value=1> Administrador
                    <input type="radio" name="rol" value="2"> Guardia
                    <input type="radio" name="rol" value="3"> Alumno
                    <!--Telefono-->
                    <label for="telefono">Numero de teléfono</label>
                    <input type="number" name="telefono" placeholder="1234567890">

                <button class="boton"> Registrar datos</button>
</form>
            </div>
        </div>
        <script src="" async defer>
        </script>
    </body>
</html>