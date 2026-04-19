<header class="main-navbar">
    <div class="navbar-left">
        <button id="toggleSidebar" class="toggle-btn">☰</button>
        <img src="../../assets/img/logoblanco.png" alt="Logo" class="nav-logo">
        <img src="../../assets/img/textlogoblanco.png" alt="Logo" class="nav-logo">
    </div>

    <div class="navbar-right" style="max-width: 250px; overflow: hidden;">
        <span class="user-display" style="white-space: nowrap; text-overflow: ellipsis; display: block; overflow: hidden;" title="<?php echo $_SESSION['usuario']; ?>"><strong><?php echo $_SESSION['usuario']; ?></strong>
        </span>
    </div>
</header>