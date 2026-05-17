<?php
/**
 * Barra de navegación superior compartida por todas las vistas.
 *
 * Muestra el logo y nombre del usuario conectado, y cambia el enlace
 * principal según el rol actual.
 */
if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol'])) {
    header("Location: ../../index.php");
    exit;
}
?>

<!-- Barra de navegación superior compartida por todas las vistas -->
<header class="main-navbar">
    <div class="navbar-left">
        <!-- Botón que alterna la visibilidad del sidebar -->
        <button id="toggleSidebar" class="toggle-btn">☰</button>
        <?php if ($_SESSION['rol'] == 1): ?>
            <a href="../admin/inicio.php">
                <img src="../../assets/img/logoblanco.png" alt="Logo" class="nav-logo">
            </a>
        <?php elseif ($_SESSION['rol'] == 2): ?>
            <a href="../guardia/inicio.php">
                <img src="../../assets/img/logoblanco.png" alt="Logo" class="nav-logo">
            </a>
        <?php elseif ($_SESSION['rol'] == 3): ?>
            <a href="../alumno/inicio.php">
                <img src="../../assets/img/logoblanco.png" alt="Logo" class="nav-logo">
            </a>
        <?php endif; ?>
        <!-- Imagen de texto del logo, siempre visible junto al icono -->
        <img src="../../assets/img/textlogoblanco.png" alt="Logo" class="nav-logo">
    </div>

    <div class="navbar-right">
        <!-- Nombre de usuario mostrado en la esquina derecha -->
        <span class="user-display" title="<?php echo $_SESSION['usuario']; ?>">
            <strong><?php echo $_SESSION['usuario']; ?></strong>
        </span>
    </div>
</header>
