<?php
/**
 * Controlador de cierre de sesión.
 *
 * Este archivo destruye la sesión actual y borra la cookie de sesión del navegador.
 * Luego redirige al usuario a la página de inicio de sesión.
 */
session_start();

// Limpiar todos los datos de sesión en el arreglo global.
$_SESSION = [];

// Si se usa cookie para la sesión, eliminarla en el navegador.
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destruir la sesión en el servidor.
session_destroy();

// Redirigir al inicio después de cerrar la sesión.
header("Location: ../index.php");
exit;
?>