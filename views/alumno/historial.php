<?php
session_start();

if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 3) {
    header("Location: ../../index.php");
    exit;
}

include("../../includes/verHistorial.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historial</title>
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>

<body>
    <?php include("../components/navbar.php"); ?>
    <?php include("../components/sidebar.php"); ?>

    <div class="main-container" id="main-content">

        <table>
            <tr>
                <th>FECHA</th>
                <th>HORA</th>
                <th>NOMBRE COMPLETO</th>
                <th>NUMERO DE CONTROL</th>
                <th>TIPO DE ACCESO</th>
                <th>METODO DE ACCESO</th>
                <th>ID CARRO</th>
                <th>ID GUARDIA</th>
            </tr>

            <?php if ($result && $result->num_rows > 0) { ?>

                <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <td><?= $row['Fecha'] ?></td>
                        <td><?= $row['Hora'] ?></td>
                        <td><?= $row['NombreCompleto'] ?></td>
                        <td><?= $row['NoControl'] ?></td>
                        <td><?= $row['EntradaSalida'] ?></td>
                        <td><?= $row['MetodoAcceso'] ?></td>

                        <td><?= $row['ID_Carro'] ?></td>

                        <td><?= $row['ID_Guardia'] ?></td>
                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="6">No hay registros</td>
                </tr>

            <?php } ?>

        </table>

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