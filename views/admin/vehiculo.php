<?php
session_start();

if(!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 1){
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro de Vehiculo</title>
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/button.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/background.css"> 
</head>
<body>
    <?php include("navbar.php"); ?>
    <?php include("sidebar.php"); ?>

    <div class="main-container" id="main-content">
        <div class="card">
            <h1>Ingreso de Datos</h1>
            <form action="../../includes/registrarVehiculo.php" method="POST">

                <label>Número de Control del Propietario</label>
                <input type="text" name="nocontrol" placeholder="Número de Control" maxlength="10" pattern="[A-Za-z0-9]{1,10}" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" title="El número de control debe tener máximo 10 caracteres (letras y números)" required>

                <label>Matricula de Carro</label>
                <input type="text" name="matricula" placeholder="Matrícula del Carro" maxlength="8" pattern="[A-Za-z0-9]{1,8}" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" title="La matrícula debe tener máximo 8 caracteres (letras y números)" required>

                <label>Marca</label>
                <input type="text" name="marca" placeholder="Marca del Carro" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>
            
                <label>Modelo</label>
                <input type="text" name="modelo" placeholder="Modelo del Carro" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

                <label>Color</label>
                <input type="text" name="color" placeholder="Color del Carro" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

                <button class="botonc">Registrar Vehiculo</button>
            </form>
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