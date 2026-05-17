<?php
/**
 * Menú lateral compartido para navegación según el rol.
 *
 * Muestra botones de acceso rápido para administrador, guardia o alumno,
 * más la opción de cerrar sesión.
 */
if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol'])) {
    header("Location: ../../index.php");
    exit;
}
?>

<!-- Menu lateral compartido, con opciones según rol de usuario -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2 style="color: white; text-align: center;"></h2>
    </div>

    <?php if ($_SESSION['rol'] == 1): ?>

        <!-- Navegación para administrador -->
        <nav class="sidebar-menu" style="display: flex; flex-direction: column;">
            <button class="boton-sidebar" onclick="window.location.href='../admin/inicio.php'">
                <img src="../../assets/icons/home.png" class="icon"></img> <span class="text">Inicio</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../admin/registros.php'">
                <img src="../../assets/icons/add.png" class="icon"></img> <span class="text">Registrar</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../admin/verVehiculos.php'">
                <img src="../../assets/icons/car.png" class="icon"></img> <span class="text">Vehículos</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../admin/verUsuarios.php'">
                <img src="../../assets/icons/users.png" class="icon"></img> <span class="text">Usuarios</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../admin/verRegistros.php'">
                <img src="../../assets/icons/register.png" class="icon"></img> <span class="text">Registros</span>
            </button>
        </nav>

    <?php elseif ($_SESSION['rol'] == 2): ?>

        <!-- Navegación para guardia -->
        <nav class="sidebar-menu" style="display: flex; flex-direction: column;">
            <button class="boton-sidebar" onclick="window.location.href='../guardia/inicio.php'">
                <img src="../../assets/icons/home.png" class="icon"></img> <span class="text">Inicio</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../guardia/acceso.php'">
                <img src="../../assets/icons/add.png" class="icon"></img> <span class="text">Registrar</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../guardia/verRegistros.php'">
                <img src="../../assets/icons/register.png" class="icon"></img> <span class="text">Registros</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../guardia/visitante.php'">
                <img src="../../assets/icons/add-person.png" class="icon"></img> <span class="text">Visitante</span>
            </button>
        </nav>

    <?php elseif ($_SESSION['rol'] == 3): ?>

        <!-- Navegación para alumno -->
        <nav class="sidebar-menu" style="display: flex; flex-direction: column;">
            <button class="boton-sidebar" onclick="window.location.href='../alumno/inicio.php'">
                <img src="../../assets/icons/home.png" class="icon"></img> <span class="text">Inicio</span>
            </button>
            <button class="boton-sidebar" onclick="window.location.href='../alumno/historial.php'">
                <img src="../../assets/icons/register.png" class="icon"></img> <span class="text">Historial</span>
            </button>
        </nav>

    <?php endif; ?>

    <!-- Botón de cerrar sesión siempre visible -->
    <nav class="sidebar-menu" style="display: flex; flex-direction: column;">
        <button class="boton-sidebar" onclick="window.location.href='../../controllers/logoutControl.php'">
            <img src="../../assets/icons/logout.png" class="icon"></img> <span class="text">Salir</span>
        </button>
    </nav>

</div>
