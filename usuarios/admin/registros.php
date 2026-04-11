<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../../desing/styles.css">
</head>
<body>

    <div class="container">
        <div class="card">
        <h2>Ingreso de datos</h2>

        <form action="../../includes/registrar_usuario.php" method="POST">
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
                <option type="radio" name="rol" value="1" required>Administrador</option>
                <option type="radio" name="rol" value="2" required>Guardia</option>
                <option type="radio" name="rol" value="3" required>Alumno</option>
            </select>
                
            <label>Telefono</label>
            <input type="number" name="telefono" placeholder="xxx-xxx-xxxx" required>
            
            <button class="boton">Registrar usuario</button>

            <button class="boton" onclick="window.location.href='inicio.php'">
                Volver al Inicio
            </button>
        </form>
        </div>
    </div>

</body>
</html>