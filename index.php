<?php
/**
 * Página de inicio de sesión del sistema.
 *
 * Muestra el formulario de autenticación y, en caso de error,
 * despliega un mensaje amigable según el código de error recibido
 * por query string.
 */

$error = $_GET['error'] ?? '';

// Mensajes de error disponibles para mostrar en pantalla.
$mensajes = [
    'credenciales' => 'Numero de control o contrasena incorrectos.',
    'bloqueado' => 'Demasiados intentos fallidos. Intenta nuevamente en 5 minutos.',
];

// Seleccionar mensaje según el código de error; si no existe, dejar cadena vacía.
$mensajeError = $mensajes[$error] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SIESA</title>
    <!-- Carga los estilos principales de la aplicación y los botones -->
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/button.css">
    <style>
        /* Estilos específicos para el mensaje de error de login */
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

    <!-- Contenedor central de la tarjeta de inicio de sesión -->
    <div class="container">
        <div class="card">
            <div class="logo">
                <!-- Logo del sistema visible en la pantalla de login -->
                <img src="assets/img/logo.png" alt="Logo SIESA">
            </div>
            <h2>Sistema de Informacion de Entrada y Salida de Alumnos</h2>

            <p class="subtitle">
                Ingresar credenciales para acceder
            </p>

            <!-- Mensaje de error mostrado cuando el login falla -->
            <?php if ($mensajeError !== ''): ?>
                <div class="error-login">
                    <?php echo htmlspecialchars($mensajeError, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <!-- Formulario de autenticación que envía datos al controlador de login -->
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
