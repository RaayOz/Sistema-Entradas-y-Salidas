<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registrar Acceso</title>
    <link rel="stylesheet" href="../../desing/styles.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h1>Registrar Acceso</h1>
        <form action="../../includes/accesos.php" method="POST">
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

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required>

            <label for="lugar">Lugar:</label>
            <input type="text" id="lugar" name="lugar" required>

            <button class="boton">Registrar Acceso</button>
        <button class="boton" onclick="window.location.href='inicio.php'">Volver al Inicio</button>
    </div>

</body>
</html>