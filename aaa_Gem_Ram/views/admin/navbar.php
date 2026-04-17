<header class="main-navbar">
    <div class="navbar-left">
        <button id="toggleSidebar" class="toggle-btn">☰</button>
        <img src="../../assets/img/logoblanco.png" alt="Logo" class="nav-logo">
        <h1 class="brand-name">SIESA</h1>
    </div>
    
    <div class="navbar-right" style="max-width: 250px; overflow: hidden;">
    <span class="user-display" style="white-space: nowrap; text-overflow: ellipsis; display: block; overflow: hidden;" title="<?php echo $_SESSION['usuario']; ?>">
        Usuario: <strong><?php echo $_SESSION['usuario']; ?></strong>
    </span>
</div>
</header>