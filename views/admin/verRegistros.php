```php
<?php
session_start();

if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../index.php");
    exit;
}

require_once("../../includes/obtenerRegistros.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Vehículos Registrados</title>

    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/button.css">
    <link rel="stylesheet" href="../../assets/css/tableCheck.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>

<body>

    <?php include("../components/navbar.php"); ?>
    <?php include("../components/sidebar.php"); ?>

    <div class="main-container" id="main-content">
        <div class="contenedor-tabla">

            <h1>Vehículos Registrados</h1>

            <form method="GET" class="filtros">

                <input type="text" name="usuario" placeholder="No. Control" value="<?= $_GET['usuario'] ?? '' ?>">

                <input type="text" name="matricula" placeholder="Matrícula" value="<?= $_GET['matricula'] ?? '' ?>">

                <select name="metodo">
                    <option value="">Método Acceso</option>
                    <option value="Vehicular" <?= (($_GET['metodo'] ?? '') == 'Vehiculart') ? 'selected' : '' ?>>Vehicular</option>
                    <option value="Peatonal" <?= (($_GET['metodo'] ?? '') == 'Peatonal') ? 'selected' : '' ?>>Peatonal</option>
                </select>

                <input type="date" name="fecha" value="<?= $_GET['fecha'] ?? '' ?>">

                <input type="time" name="hora" value="<?= $_GET['hora'] ?? '' ?>">

                <button class="botonc" type="submit">Filtrar</button>
                <a href="verUsuarios.php"><button class="botonc eliminar">Limpiar</button></a>

            </form>

            <table class="tabla">

                <thead>
                    <tr>
                        <th>NUMERO DE CONTROL</th>
                        <th>TIPO DE ACCESO</th>
                        <th>METODO DE ACCESO</th>
                        <th>MATRICULA</th>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>LUGAR</th>
                        <th>MOTIVO</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    if (isset($resultRegistros) && $resultRegistros->num_rows > 0) {

                        while ($fila = $resultRegistros->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= $fila['NoControl']; ?></td>
                                <td><?= $fila['EntradaSalida']; ?></td>
                                <td><?= $fila['MetodoAcceso']; ?></td>
                                <td><?= $fila['Matricula']; ?></td>
                                <td><?= $fila['Fecha']; ?></td>
                                <td><?= $fila['Hora']; ?></td>
                                <td><?= $fila['Lugar']; ?></td>
                                <td><?= $fila['Motivo']; ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>No hay registros</td></tr>";
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