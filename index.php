<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SIESA</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <div class="card">

        <div class="logo">
            <img src="img/logo.png" alt="Logo SIESA">
        </div>

        <h2>Sistema de Información de Entrada y Salida de Alumnos</h2>

        <p class="subtitle">
            Ingresar credenciales para acceder
        </p>

        <form action="includes/login.php" method="POST">

            <label>Número de Control</label>
            <input 
                type="text"
                name="nocontrol"
                id="numero_control"
                placeholder="Número de Control"
                required
            >

            <label>Contraseña</label>
            <input 
                type="password"
                name="contrasena"
                id="password"
                placeholder="Contraseña"
                required
            >
            
            <button type="submit" class="boton">
                Iniciar Sesión
            </button>

        </form>

    </div>
</div>

</body>
</html>