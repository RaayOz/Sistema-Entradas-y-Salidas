<header class="main-navbar">
    <div class="navbar-left">
        <button id="toggleSidebar" class="toggle-btn">☰</button>
        <img src="../../assets/img/logoblanco.png" alt="Logo" class="nav-logo">
        <img src="../../assets/img/textlogoblanco.png" alt="Logo" class="nav-logo">
    </div>

    <div class="navbar-right">
        <span class="user-display" title="<?php echo $_SESSION['usuario']; ?>">
            <strong><?php echo $_SESSION['usuario']; ?></strong>
        </span>
    </div>
</header>