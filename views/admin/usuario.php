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
    <title>Registro de Usuario</title>
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
            <form action="../../includes/registrarUsuario.php" method="POST">

                <label>Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>
            
                <label>Apellidos</label>
                <input type="text" name="apellidos" placeholder="Apellidos" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>
            
                <label>Número de control</label>
                <input type="text" name="nocontrol" placeholder="Número de control" maxlength="10" pattern="[0-9]{1,10}"  style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" title="El número de control debe tener entre 1 y 10 caracteres numericos" required>
            
                <label>Correo electrónico</label>
                <input type="email" name="correo" placeholder="Correo electrónico" pattern="^[a-zA-Z0-9._%+-]+@tectijuana\.edu\.mx$" title="Solo correos institucionales @tectijuana.edu.mx" required>

                <label>Contraseña</label>
                <input type="password" name="contrasena" placeholder="Contraseña" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="">Selecciona un rol</option>
                    <option value="1" required>Administrador</option>
                    <option value="2" required>Guardia</option>
                    <option value="3" required>Alumno</option>
                </select>
            
                <label>Telefono</label>
                <input type="text" name="telefono" placeholder="xxx-xxx-xxxx" maxlength="10" pattern="[0-9]{1,10}"  style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" title="El número debe tener entre 1 y 10 caracteres numericos" required>
                
                <button class="botonc">Registrar Usuario</button>
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