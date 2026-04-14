<?php
/*TODO:
* Perfil
* Registrar entradas y salidas 
* Ver historial de entradas y salidas del dia.
* Descargar reportes del dia.
*/

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Datos de usuario</title>
<!link rel="stylesheet" href="../styles.css">
</head>

<body>
    <h1>Pagina para hacer registros de entradas y salidas</h1>
    
        <form action="../includes/registrar_entrada_salida.php" method="post">
            <div class="card" name="datosEntradaSalida"></div>
                <!--Boton radio para elegir entre entrada y salida-->
                <label for="tipoRegistro">Entrada o Salida?</label>
                <input type="radio" name="tipoRegistro" value="Entrada">Entrada
                <input type="radio" name="tipoRegistro" value="Salida">Salida
        `       <p></p>
                <!--Boton radio para elegir el lugar de entrada-->
                <label for="lugarEntrada">Lugar de entrada</label>
                <input type="radio" name="lugarEntrada" value="Entrada Principal">Entrada Principal
                <input type="radio" name="lugarEntrada" value="estacionamientoAlum">Estacionamiento Alumnos
                <input type="radio" name="lugarEntrada" value="estacionamientoDoc">Estacionamiento Docentes
                <p></p>
                <!--Boton radio para elegir el tipo de entrada
                <label for"metodoAcceso">Metodo Acceso</label>
                <input type="radio" name="metodoAcceso" value="Pie"> Pie
                <input type="radio" name="metodoAcceso" value="Pie"> Pie
                <input type="radio" name="metodoAcceso" value="Pie"> Pie-->
            </div>

            <div class="card" name="registrarEntradaSalida">
                <label for="numeroControl">Numero de control</label>
                <input type="number" name="numeroControl" placeholder="Numero de control" required>
                <button class="boton" type="submit">Registrar</button>
            </div>


        </form>

</body>