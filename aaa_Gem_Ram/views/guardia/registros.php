<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/button.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>
<body>

    <?php include("sidebar.php"); ?>

    <div class="container">
        <div class="card">
            <form action="../../includes/accesos.php" method="POST">
                <h1>Registrar Acceso</h1>

                <label>Número de control</label>
                <input type="number" name="nocontrol" placeholder="Número de control" required>

                <label for="entradasalida">Tipo de Acceso:</label>
                <select id="entradasalida" name="entradasalida" required>
                    <option value="">Selecciona una opción</option>
                    <option value="Entrada">Entrada</option>
                    <option value="Salida">Salida</option>
                </select>

                <label for="metodoacceso">Método de Acceso:</label>
                <select id="metodoacceso" name="metodoacceso" required>
                    <option value="">Selecciona una opción</option>
                    <option value="Vehicular">Vehicular</option>
                    <option value="Peatonal">Peatonal</option>
                </select>  

                <label>Matricula de Carro</label>
                <input type="number" name="matricula" placeholder="Matricula de Carro">

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>

                <label for="lugar">Lugar:</label>
                <select id="lugar" name="lugar" required>
                    <option value="">Selecciona una opción</option>
                    <option value="Entrada">Unidad Tomas de Aquino</option>
                    <option value="Salida">Unidad de Otay</option>
                </select>

                <button class="botonc">Registrar Acceso</button>
            </form>
        </div>
    </div>

</body>
</html>