<?php
/**
 * Controlador de inicio de sesión.
 *
 * Este archivo gestiona la autenticación de usuarios mediante un formulario POST.
 * Se encarga de:
 * - asegurar la sesión con cookies de sólo lectura y SameSite Lax
 * - validar el método HTTP y los datos de entrada
 * - limitar intentos de acceso y bloquear temporalmente tras varios fallos
 * - verificar la contraseña usando hash y migrar hashes antiguos a PASSWORD_DEFAULT
 * - almacenar datos de usuario en la sesión
 * - redirigir al usuario según su rol
 */

$https = (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
    (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
);

// Configuración de sesión segura.
ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'Lax');

// Si la conexión es HTTPS, asegurar que las cookies de sesión se transmitan solo por HTTPS.
if ($https) {
    ini_set('session.cookie_secure', '1');
}

// Configurar parámetros de la cookie de sesión para mayor seguridad.
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => $https,
    'httponly' => true,
    'samesite' => 'Lax',
]);

// Iniciar la sesión después de configurar los parámetros.
session_start();
require_once("../config/conexion.php");

/** @var mysqli $conn */
if (!isset($conn) || !($conn instanceof mysqli)) {
    // Si no hay conexión válida, redirigir con error.
    header("Location: ../index.php?error=credenciales");
    exit;
}

// Definir constantes para el manejo de intentos de login y bloqueo temporal.
const MAX_INTENTOS_LOGIN = 5;
const TIEMPO_BLOQUEO_SEGUNDOS = 300;

// Solo permitir solicitudes POST desde el formulario de login.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

// Obtener el timestamp actual para gestionar bloqueos temporales.
$ahora = time();

// Verificar si el usuario está bloqueado temporalmente por intentos fallidos previos.
if (isset($_SESSION['bloqueado_hasta']) && $ahora < (int) $_SESSION['bloqueado_hasta']) {
    header("Location: ../index.php?error=bloqueado");
    exit;
}

// Validar y sanitizar los datos de entrada del formulario de login.
$nocontrol = trim($_POST['nocontrol'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

// Validar que el campo NoControl sea numérico y que la contraseña no esté vacía.
if ($nocontrol === '' || $contrasena === '' || !preg_match('/^[0-9]{1,10}$/', $nocontrol)) {
    registrarFallo($ahora);
}

// Preparar la consulta SQL para obtener el usuario por NoControl usando una declaración preparada para evitar inyección SQL.
$stmt = $conn->prepare("\n    SELECT ID_Usuario, Nombres, Apellidos, NoControl, Correo, Telefono, Contrasena, ID_Rol\n    FROM Usuario\n    WHERE NoControl = ?\n    LIMIT 1\n");

// Si no se pudo preparar la declaración, redirigir con error.
if (!$stmt) {
    header("Location: ../index.php?error=credenciales");
    exit;
}

// Ejecutar la consulta con el NoControl proporcionado y obtener los datos del usuario.
$stmt->bind_param("s", $nocontrol);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
$stmt->close();

// Si no existe el usuario, tratar como intento fallido.
if (!$usuario) {
    registrarFallo($ahora);
}

// Obtener la contraseña almacenada y verificarla contra la proporcionada por el usuario.
$contrasenaGuardada = (string) ($usuario['Contrasena'] ?? '');
$autenticado = false;

// Determinar si la contraseña almacenada es un hash válido.
$infoHash = password_get_info($contrasenaGuardada);
$esHash = !empty($infoHash['algo']);

if ($esHash) {
    // Verificar contra hash moderno.
    if (password_verify($contrasena, $contrasenaGuardada)) {
        $autenticado = true;

        // Si el hash está desactualizado, re-hashear la contraseña.
        if (password_needs_rehash($contrasenaGuardada, PASSWORD_DEFAULT)) {
            actualizarHashUsuario($conn, (int) $usuario['ID_Usuario'], $contrasena);
        }
    }
} else {
    // Compatibilidad con contraseñas guardadas en texto plano.
    if (hash_equals($contrasenaGuardada, $contrasena)) {
        $autenticado = true;
        actualizarHashUsuario($conn, (int) $usuario['ID_Usuario'], $contrasena);
    }
}

// Si no se autenticó, registrar el fallo.
if (!$autenticado) {
    registrarFallo($ahora);
}

// Cambiar el ID de sesión después de autenticación Exitosa.
session_regenerate_id(true);

$_SESSION['intentos_login'] = 0;
unset($_SESSION['bloqueado_hasta']);

// Guardar datos principales del usuario en la sesión.
$_SESSION['usuario'] = $usuario['Nombres'];
$_SESSION['apellidos'] = $usuario['Apellidos'];
$_SESSION['nocontrol'] = $usuario['NoControl'];
$_SESSION['correo'] = $usuario['Correo'];
$_SESSION['telefono'] = $usuario['Telefono'];
$_SESSION['rol'] = (int) $usuario['ID_Rol'];

// Redirigir al usuario según su rol.
switch ((int) $usuario['ID_Rol']) {
    case 1:
        header("Location: ../views/admin/inicio.php");
        exit;
    case 2:
        header("Location: ../views/guardia/inicio.php");
        exit;
    case 3:
        header("Location: ../views/alumno/inicio.php");
        exit;
    case 4:
        header("Location: ../views/guardia/inicio.php");
        exit;
    default:
        session_unset();
        session_destroy();
        header("Location: ../index.php?error=credenciales");
        exit;
}

/**
 * Registra un intento fallido de inicio de sesión y bloquea temporalmente si se excede el límite.
 *
 * @param int $ahora Timestamp actual para calcular el bloqueo.
 * @return void
 */
function registrarFallo(int $ahora): void
{
    $_SESSION['intentos_login'] = (int) ($_SESSION['intentos_login'] ?? 0) + 1;

    if ($_SESSION['intentos_login'] >= MAX_INTENTOS_LOGIN) {
        $_SESSION['bloqueado_hasta'] = $ahora + TIEMPO_BLOQUEO_SEGUNDOS;
        $_SESSION['intentos_login'] = 0;
        usleep(500000);
        header("Location: ../index.php?error=bloqueado");
        exit;
    }

    usleep(500000);
    header("Location: ../index.php?error=credenciales");
    exit;
}

/**
 * Actualiza la contraseña del usuario en la base de datos como hash seguro.
 *
 * @param mysqli $conn Conexión activa a la base de datos.
 * @param int $idUsuario Identificador del usuario.
 * @param string $contrasenaPlana Contraseña en texto plano.
 * @return void
 */
function actualizarHashUsuario(mysqli $conn, int $idUsuario, string $contrasenaPlana): void
{
    $nuevoHash = password_hash($contrasenaPlana, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE Usuario SET Contrasena = ? WHERE ID_Usuario = ?");
    if (!$stmt) {
        return;
    }

    $stmt->bind_param("si", $nuevoHash, $idUsuario);
    $stmt->execute();
    $stmt->close();
}
?>