<?php
if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol'])) {
    header("Location: ../../index.php");
    exit;
}
?>

<header class="main-navbar">
    <div class="navbar-left">
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
        <img src="../../assets/img/textlogoblanco.png" alt="Logo" class="nav-logo">
    </div>

    <div class="navbar-right">
        <span class="user-display" title="<?php echo $_SESSION['usuario']; ?>">
            <strong><?php echo $_SESSION['usuario']; ?></strong>
        </span>
    </div>
</header>
