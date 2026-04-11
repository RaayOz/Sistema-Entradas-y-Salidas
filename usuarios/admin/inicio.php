<?php
session_start();

if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'])) {
    header("Location: ../../index.php");
    exit();
}

include("../../includes/conexion.php");

$sql = "SELECT Nombres, Apellidos, NoControl, Telefono, ID_Rol FROM Usuario ORDER BY Apellidos, Nombres";
$resultado = $conn->query($sql);

function obtenerRol($idRol)
{
    switch ((int)$idRol) {
        case 1:
            return "Administrador";
        case 2:
            return "Guardia";
        case 3:
            return "Alumno";
        default:
            return "No definido";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Inicio | Administrador</title>
<link rel="stylesheet" href="../../desing/inicio.css">
</head>
<body>
<div class="page">
    <header class="header">
        <div>
            <h1>Listado general de usuarios</h1>
            <p>Sesión iniciada como <?php echo htmlspecialchars($_SESSION['usuario']); ?> (<?php echo htmlspecialchars($_SESSION['nocontrol']); ?>)</p>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="registros.php">Registrar usuario</a>
            <a class="btn btn-light" href="../../includes/logout.php">Cerrar sesión</a>
        </div>
    </header>

    <section class="user-grid">
    <?php if ($resultado && $resultado->num_rows > 0): ?>
        <?php while ($usuario = $resultado->fetch_assoc()): ?>
            <article class="user-card">
                <div class="user-top">
                    <div class="avatar"><?php echo strtoupper(substr($usuario['Nombres'], 0, 1)); ?></div>
                    <div>
                        <h2 class="user-name"><?php echo htmlspecialchars($usuario['Nombres'] . ' ' . $usuario['Apellidos']); ?></h2>
                        <p class="user-line"><?php echo htmlspecialchars($usuario['NoControl']); ?> · <?php echo htmlspecialchars($usuario['NoControl']); ?>@tectijuana.edu.mx</p>
                    </div>
                </div>

                <div class="meta-grid">
                    <div class="meta-item"><span>Número de control</span><strong><?php echo htmlspecialchars($usuario['NoControl']); ?></strong></div>
                    <div class="meta-item"><span>Teléfono</span><strong><?php echo htmlspecialchars($usuario['Telefono'] ?: 'Sin registrar'); ?></strong></div>
                    <div class="meta-item"><span>Rol</span><strong><?php echo obtenerRol($usuario['ID_Rol']); ?></strong></div>
                    <div class="meta-item"><span>Estatus</span><strong>Vigente</strong></div>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="empty">No hay usuarios registrados aún.</div>
    <?php endif; ?>
    </section>
</div>
</body>
</html>
