<?php
if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol'])) {
    header("Location: ../../index.php");
    exit;
}
?>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2 style="color: white; text-align: center;"></h2>
    </div>

    <?php if ($_SESSION['rol'] == 1): ?>

        <nav class="sidebar-menu" style="display: flex; flex-direction: column;">
            <button class="boton-sidebar" onclick="window.location.href='../admin/inicio.php'">
                <span class="icon">🏠</span> <span class="text">Inicio</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../admin/registros.php'">
                <span class="icon">📝</span> <span class="text">Registrar</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../admin/verVehiculos.php'">
                <span class="icon">🚗</span> <span class="text">Vehículos</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../admin/verUsuarios.php'">
                <span class="icon">👥</span> <span class="text">Usuarios</span>
            </button>
        </nav>

    <?php elseif ($_SESSION['rol'] == 2): ?>

        <nav class="sidebar-menu" style="display: flex; flex-direction: column;">
            <button class="boton-sidebar" onclick="window.location.href='../guardia/inicio.php'">
                <span class="icon">🏠</span> <span class="text">Inicio</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../guardia/acceso.php'">
                <span class="icon">📝</span> <span class="text">Registrar</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../guardia/visitante.php'">
                <span class="icon">📝</span> <span class="text">Visitante</span>
            </button>
        </nav>

    <?php elseif ($_SESSION['rol'] == 3): ?>

        <nav class="sidebar-menu" style="display: flex; flex-direction: column;">
            <button class="boton-sidebar" onclick="window.location.href='../alumno/inicio.php'">
                <span class="icon">🏠</span> <span class="text">Inicio</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../alumno/historial.php'">
                <span class="icon">📖</span> <span class="text">Historial</span>
            </button>
        </nav>

    <?php endif; ?>

    <nav class="sidebar-menu" style="display: flex; flex-direction: column;">
        <button class="boton-sidebar" onclick="window.location.href='../../controllers/logoutControl.php'">
            <span class="icon">🚪</span> <span class="text">Salir</span>
        </button>
    </nav>

</div>