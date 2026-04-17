<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location: ../../index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SIESA - Inicio</title>
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/styles.css"> </head>
<body>

    <?php include("navbar.php"); ?>
    <?php include("sidebar.php"); ?>

    <div class="main-container" id="main-content">
        <div class="card">
            <h1>Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
            <p>Número de Control: <?php echo $_SESSION['nocontrol']; ?></p>
        </div>
    </div>

<script>
    const btn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('main-content');

    btn.addEventListener('click', () => {
        // 'active' mueve el sidebar de -250px a 0
        sidebar.classList.toggle('active');
        // 'pushed' mueve el contenido de 0 a 250px
        content.classList.toggle('pushed');
    });
</script>

<style>
    .main-container {
        /* Empieza pegado a la izquierda porque el sidebar está oculto */
        margin-left: 0; 
        margin-top: 70px;
        padding: 40px;
        transition: margin-left 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 70px);
    }

    /* Cuando el sidebar aparece, empujamos el contenido 250px */
    .main-container.pushed {
        margin-left: 250px;
    }
</style>
</body>
</html>