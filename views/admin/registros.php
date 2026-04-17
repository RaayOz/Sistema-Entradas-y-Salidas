<?php
session_start();

// Si quieres que solo el Admin entre aquí, deja tu validación:
if(!isset($_SESSION['usuario'])){
    header("Location: ../../index.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/button.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
</head>
<body>
    
    <?php include("sidebar.php"); ?>
    <?php include("navbar.php"); ?>

    <div class="container">
        <div class="card">
            <h1>Ingreso de Datos</h1>
            <form action="../../includes/usuarios.php" method="POST">

                <label>Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre" required>
            
                <label>Apellidos</label>
                <input type="text" name="apellidos" placeholder="Apellidos" required>
            
                <label>Número de control</label>
                <input type="number" name="nocontrol" placeholder="Número de control" required>
            
                <label>Correo electrónico</label>
                <input type="email" name="correo" placeholder="Correo electrónico" required>

                <label>Contraseña</label>
                <input type="password" name="contrasena" placeholder="Contraseña" required>

                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="">Selecciona un rol</option>
                    <option value="1" required>Administrador</option>
                    <option value="2" required>Guardia</option>
                    <option value="3" required>Alumno</option>
                </select>
                
                <label>Telefono</label>
                <input type="number" name="telefono" placeholder="xxx-xxx-xxxx" required>
            
                <button class="botonc">Registrar Usuario</button>
            </form>
        </div>
    </div>


    <script>
        const btn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('main-content');

        btn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            content.classList.toggle('pushed');
        });
    </script>

</body>
</html>