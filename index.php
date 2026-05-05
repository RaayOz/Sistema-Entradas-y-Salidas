<?php
$error = $_GET['error'] ?? '';

$mensajes = [
    'credenciales' => 'Numero de control o contrasena incorrectos.',
    'bloqueado' => 'Demasiados intentos fallidos. Intenta nuevamente en 5 minutos.',
];

$mensajeError = $mensajes[$error] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SIESA</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/button.css">
    <style>
        .error-login {
            margin: 0 0 15px 0;
            padding: 12px 14px;
            border-radius: 8px;
            background: #ffe3e3;
            color: #8a1c1c;
            border: 1px solid #f5b5b5;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="logo">
                <img src="assets/img/logo.png" alt="Logo SIESA">
            </div>
            <h2>Sistema de Informacion de Entrada y Salida de Alumnos</h2>

            <p class="subtitle">
                Ingresar credenciales para acceder
            </p>

            <?php if ($mensajeError !== ''): ?>
                <div class="error-login">
                    <?php echo htmlspecialchars($mensajeError, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form action="controllers/loginControl.php" method="POST" autocomplete="on">
                <label>Numero de Control</label>
                <input 
                    type="text" 
                    name="nocontrol"
                    id="numero_control"
                    placeholder="Numero de Control"
                    maxlength="10"
                    inputmode="numeric"
                    pattern="[0-9]{1,10}"
                    autocomplete="username"
                    required
                >

                <label>Contrasena</label>
                <input 
                    type="password" 
                    name="contrasena"
                    id="password"
                    placeholder="Contrasena"
                    autocomplete="current-password"
                    required
                >
            
                <button type="submit" class="botonc">Iniciar Sesion</button>
            </form>
        </div>
    </div>

</body>
</html>