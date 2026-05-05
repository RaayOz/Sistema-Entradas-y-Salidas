<?php
$https = (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
    (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
);

ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'Lax');

if ($https) {
    ini_set('session.cookie_secure', '1');
}

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => $https,
    'httponly' => true,
    'samesite' => 'Lax',
]);

session_start();
require_once("../config/conexion.php");

/** @var mysqli $conn */
if (!isset($conn) || !($conn instanceof mysqli)) {
    header("Location: ../index.php?error=credenciales");
    exit;
}

const MAX_INTENTOS_LOGIN = 5;
const TIEMPO_BLOQUEO_SEGUNDOS = 300;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

$ahora = time();

if (isset($_SESSION['bloqueado_hasta']) && $ahora < (int) $_SESSION['bloqueado_hasta']) {
    header("Location: ../index.php?error=bloqueado");
    exit;
}

$nocontrol = trim($_POST['nocontrol'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

if ($nocontrol === '' || $contrasena === '' || !preg_match('/^[0-9]{1,10}$/', $nocontrol)) {
    registrarFallo($ahora);
}

$stmt = $conn->prepare("
    SELECT ID_Usuario, Nombres, Apellidos, NoControl, Correo, Telefono, Contrasena, ID_Rol
    FROM Usuario
    WHERE NoControl = ?
    LIMIT 1
");

if (!$stmt) {
    header("Location: ../index.php?error=credenciales");
    exit;
}

$stmt->bind_param("s", $nocontrol);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
$stmt->close();

if (!$usuario) {
    registrarFallo($ahora);
}

$contrasenaGuardada = (string) ($usuario['Contrasena'] ?? '');
$autenticado = false;

$infoHash = password_get_info($contrasenaGuardada);
$esHash = !empty($infoHash['algo']);

if ($esHash) {
    if (password_verify($contrasena, $contrasenaGuardada)) {
        $autenticado = true;

        if (password_needs_rehash($contrasenaGuardada, PASSWORD_DEFAULT)) {
            actualizarHashUsuario($conn, (int) $usuario['ID_Usuario'], $contrasena);
        }
    }
} else {
    if (hash_equals($contrasenaGuardada, $contrasena)) {
        $autenticado = true;
        actualizarHashUsuario($conn, (int) $usuario['ID_Usuario'], $contrasena);
    }
}

if (!$autenticado) {
    registrarFallo($ahora);
}

session_regenerate_id(true);

$_SESSION['intentos_login'] = 0;
unset($_SESSION['bloqueado_hasta']);

$_SESSION['usuario'] = $usuario['Nombres'];
$_SESSION['apellidos'] = $usuario['Apellidos'];
$_SESSION['nocontrol'] = $usuario['NoControl'];
$_SESSION['correo'] = $usuario['Correo'];
$_SESSION['telefono'] = $usuario['Telefono'];
$_SESSION['rol'] = (int) $usuario['ID_Rol'];

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