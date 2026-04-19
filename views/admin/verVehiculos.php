<?php
session_start();

if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../index.php");
    exit;
}

include("../../includes/obtenerVehiculos.php");
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>Vehículos Registrados</title>
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/button.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
    <link rel="stylesheet" href="../../assets/css/tableCheck.css">

</head>

<body>

    <?php include("../components/navbar.php"); ?>
    <?php include("../components/sidebar.php"); ?>

    <div class="main-container" id="main-content">
        <div class="contenedor-tabla">
            <h1>Vehículos Registrados</h1>

            <table class="tabla">

                <thead>
                    <tr>
                        <th>DUEÑO</th>
                        <th>MATRICULA</th>
                        <th>MARCA</th>
                        <th>MODELO</th>
                        <th>COLOR</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    if ($resultVehiculos->num_rows > 0) {

                        while ($fila = $resultVehiculos->fetch_assoc()) {
                    ?>

                            <tr>

                                <td><?php echo $fila['NoControl']; ?></td>
                                <td><?php echo $fila['Matricula']; ?></td>
                                <td><?php echo $fila['Marca']; ?></td>
                                <td><?php echo $fila['Modelo']; ?></td>
                                <td><?php echo $fila['Color']; ?></td>

                                <td>

                                    <a href="editarVehiculo.php?id=<?php echo $fila['ID_Carro']; ?>">
                                        <button class="botonc">Editar</button>
                                    </a>

                                    <a href="../../includes/eliminarVehiculo.php?id=<?php echo $fila['ID_Carro']; ?>" onclick="return confirm('¿Eliminar vehículo?')">
                                        <button class="botonc eliminar">Eliminar</button>
                                    </a>

                                </td>

                            </tr>

                    <?php
                        }
                    }
                    ?>

                </tbody>

            </table>
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