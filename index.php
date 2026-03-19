
<!DOCTYPE html>
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

                <form action="includes/formHandler.inc.php" method="post">
                    <label>Nombre</label>
                    <input type="text" name="nombreUsuario" placeholder="Nombre" required>

                    <label for="apellidos">Apellido Paterno</label>
                    <input type="text" name="apellidos" placeholder="Apellidos" required>
                

                <p class="subtitle">
                    Datos Escolares del usuario.
                </p>

                    <label for="numeroControl">Numero de control</label>
                    <input type="number" name="numeroControl" placeholder="Numero de control" required>
                    <label for="curp">CURP</label>
                    <input type="text" name="curp" placeholder="curp" required>
                    <--CHECAR!!!! No estoy muy seguro si esto funciona bien---!>
                    <input type="radio" name="tipo_usuario" value="Alumno"> Alumno
                    <input type="radio" name="tipo_usuario" value="Docente"> Docente
                    <input type="radio" name="tipo_usuario" value="Administrador"> Admnistrador
                    <input type="radio" name="tipo_usuario" value="Guardia"> Guardia

                <p class="subtitle">
                    Datos opcionales del alumno.
                </p>

                    <label for="numeroEmergencia">Numero de contacto para emergencia.</label>
                    <input type="number" name="numeroEmergencia" placeholder="xxx-xxx-xx-xx">

                <button class="boton"> Registrar datos</button>
</form>
            </div>
        </div>
        <script src="" async defer>
        </script>
    </body>
</html>
