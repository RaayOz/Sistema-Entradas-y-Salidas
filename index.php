
<form action="login.php" method="POST">
    <label>Número Control</label>
    <input type="text" name="numero_control" placeholder="Número Control" required>

    <label>Contraseña</label>
    <input type="password" name="password" placeholder="Contraseña" required>

    <button type="submit">Iniciar sesión</button>
</form>

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
            ingresar credenciales para acceder
        </p>

        <form id="loginForm">
            <label>Número Control</label>
            <input type="text" id="numero_control" placeholder="Número Control" required>

            <label>Contraseña</label>
            <input type="password" id="password" placeholder="Contraseña" required>

            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
