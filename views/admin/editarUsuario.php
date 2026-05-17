<?php
/**
 * Página para editar los datos de un usuario.
 *
 * Verifica que el usuario conectado sea administrador, carga
 * los datos del usuario seleccionado y presenta el formulario
 * de actualización.
 */
session_start();

if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../index.php");
    exit;
}

require_once "../../config/conexion.php";

if (!isset($_GET['id'])) {
    header("Location: verUsuarios.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM Usuario WHERE ID_Usuario = '$id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Usuario no encontrado";
    exit;
}

$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/button.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>

<body>

    <?php include("../components/navbar.php"); ?>
    <?php include("../components/sidebar.php"); ?>

    <!-- Contenedor principal: formulario de edición de usuario -->
    <div class="main-container" id="main-content">
        <div class="card">
            <h1>Editar Usuario</h1>

            <!-- Formulario que actualiza los datos del usuario seleccionado -->
            <form action="../../includes/actualizarUsuario.php" method="POST">

                <input type="hidden" name="id" value="<?php echo $usuario['ID_Usuario']; ?>">

                <label>Nombre</label>
                <input type="text" name="nombre" value="<?php echo $usuario['Nombres']; ?>" placeholder="Nombre" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

                <label>Apellidos</label>
                <input type="text" name="apellidos" value="<?php echo $usuario['Apellidos']; ?>" placeholder="Apellidos" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

                <label>Número de control</label>
                <input type="text" name="nocontrol" value="<?php echo $usuario['NoControl']; ?>" placeholder="Número de control" maxlength="10" pattern="[0-9]{1,10}" oninput="this.value = this.value.toUpperCase()" title="El número de control debe tener entre 1 y 10 caracteres numericos" required>

                <label>Correo electrónico</label>
                <input type="email" name="correo" value="<?php echo $usuario['Correo']; ?>" placeholder="Correo electrónico" pattern="^[a-zA-Z0-9._%+-]+@tectijuana\.edu\.mx$" title="Solo correos institucionales @tectijuana.edu.mx" required>

                <label>Telefono</label>
                <input type="text" name="telefono" value="<?php echo $usuario['Telefono']; ?>" placeholder="xxx-xxx-xxxx" maxlength="10" pattern="[0-9]{1,10}" oninput="this.value = this.value.toUpperCase()" title="El número debe tener entre 1 y 10 caracteres numericos" required>

                <button class="botonc">Actualizar Usuario</button>

            </form>

        </div>
    </div>

    <style>
        .main-container {
            margin-left: 0;
            margin-top: 70px;
            padding: 40px;
            transition: margin-left 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 70px);
        }

        .main-container.pushed {
            margin-left: 250px;
        }
    </style>

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

</body>

</html>
