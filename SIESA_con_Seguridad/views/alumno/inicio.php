<?php
session_start();

if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 3) {
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/tableCheck.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>

<body>
    <?php include("../components/navbar.php"); ?>
    <?php include("../components/sidebar.php"); ?>

    <div class="main-container" id="main-content">
        <div class="card">
            <h1>Bienvenido</h1>

            <table class="tabla">
                <tr>
                    <td><strong>Nombre completo</strong></td>
                    <td><?php echo $_SESSION['usuario'] . ' ' . $_SESSION['apellidos']; ?></td>
                </tr>
                <tr>
                    <td><strong>Número de Control</strong></td>
                    <td><?php echo $_SESSION['nocontrol']; ?></td>
                </tr>
                <tr>
                    <td><strong>Correo</strong></td>
                    <td><?php echo $_SESSION['correo']; ?></td>
                </tr>
                <tr>
                    <td><strong>Contraseña</strong></td>
                    <td>***********</td>
                </tr>

                <tr>
                    <td><strong>Teléfono</strong></td>
                    <td><?php echo $_SESSION['telefono']; ?></td>
                </tr>
                <tr>
                    <td><strong>Rol</strong></td>
                    <td>
                        <?php
                        switch ($_SESSION['rol']) {
                            case 1:
                                echo 'Administrador';
                                break;
                            case 2:
                                echo 'Guardia';
                                break;
                            case 3:
                                echo 'Alumno';
                                break;
                            default:
                                echo 'Visitante';
                        }
                        ?>
                    </td>
                </tr>
            </table>

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