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
                    <input type="text" name="nombreUsuario" placeholder="Nombre" required>

                    <label for="apellidos">Apellido Paterno</label>
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
                    <label for="curp">CURP</label>
                    <input type="text" name="curp" placeholder="curp" required>
                    <!--Rol-->
                    <input type="radio" name="tipo_usuario" value=1> Alumno
                    <input type="radio" name="tipo_usuario" value="2"> Docente
                    <input type="radio" name="tipo_usuario" value="3"> Admnistrador
                    <input type="radio" name="tipo_usuario" value="4"> Guardia

                <p class="subtitle">
                    Datos opcionales del alumno.
                </p>

                    <label for="numeroEmergencia">Numero de contacto para emergencia.</label>
                    <input type="number" name="numeroEmergencia" placeholder="1234">

                <button class="boton"> Registrar datos</button>
</form>
            </div>
        </div>
        <script src="" async defer>
        </script>
    </body>
</html>