<?php
session_start();

if(!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 2){
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro de Acceso</title>
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/button.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/access.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>
<body>
    <?php include("../components/navbar.php"); ?>
    <?php include("../components/sidebar.php"); ?>
    
    <div class="selector">
        <a class="opcion" href="peatonalV.php"><span class="icono">🚶</span>Acceso Peatonal</a>
        
        <a class="opcion" href="vehicularV.php"><span class="icono">🚗</span>Acceso Vehicular</a>
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