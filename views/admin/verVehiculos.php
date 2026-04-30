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
    <link rel="stylesheet" href="../../assets/css/filtros.css">
    <link rel="stylesheet" href="../../assets/css/paginacion.css">
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

                <input type="text" name="dueno" placeholder="Dueño" value="<?= $_GET['dueno'] ?? '' ?>">

                <input type="text" name="matricula" placeholder="Matrícula" value="<?= $_GET['matricula'] ?? '' ?>">

                <input type="text" name="marca" placeholder="Marca" value="<?= $_GET['marca'] ?? '' ?>">

                <input type="text" name="modelo" placeholder="Modelo" value="<?= $_GET['modelo'] ?? '' ?>">

                <input type="text" name="color" placeholder="Color" value="<?= $_GET['color'] ?? '' ?>">

                <button class="botonc" type="submit">Filtrar</button>
                <a href="verUsuarios.php"><button class="botonc eliminar">Limpiar</button></a>

            </form>

            <div class="info-pagina">
                Mostrando página <?= isset($pagina) ? $pagina : 1 ?> de <?= isset($totalPaginas) ? $totalPaginas : 1 ?>
                (<?= isset($totalRegistros) ? $totalRegistros : 0 ?> registros totales)
            </div>

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
                    if (isset($resultVehiculos) && $resultVehiculos->num_rows > 0) {

                        while ($fila = $resultVehiculos->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= $fila['NoControl']; ?></td>
                                <td><?= $fila['Matricula']; ?></td>
                                <td><?= $fila['Marca']; ?></td>
                                <td><?= $fila['Modelo']; ?></td>
                                <td><?= $fila['Color']; ?></td>

                                <td>
                                    <a href="editarVehiculo.php?id=<?= $fila['ID_Carro']; ?>">
                                        <button class="botonc">Editar</button>
                                    </a>

                                    <a href="../../includes/eliminarVehiculo.php?id=<?= $fila['ID_Carro']; ?>" onclick="return confirm('¿Eliminar vehículo?')">
                                        <button class="botonc eliminar">Eliminar</button>
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay vehículos registrados</td></tr>";
                    }
                    ?>

                </tbody>

            </table>

                        <?php if (isset($totalPaginas) && $totalPaginas > 1): ?>
                <div class="paginacion">

                    <?php
                    $filtros = http_build_query([
                        'nocontrol' => $_GET['nocontrol'] ?? '',
                        'matricula' => $_GET['matricula'] ?? '',
                        'marca'     => $_GET['marca']     ?? '',
                        'modelo'    => $_GET['modelo']    ?? '',
                        'color'     => $_GET['color']     ?? '',
                    ]);
                    ?>

                    <?php if (isset($pagina) && $pagina > 1): ?>
                        <a href="?<?= $filtros ?>&pagina=<?= $pagina - 1 ?>">← Anterior</a>
                    <?php endif; ?>

                    <?php
                    $pagina = $pagina ?? 1;
                    $totalPaginas = $totalPaginas ?? 1;
                    $inicio = max(1, $pagina - 2);
                    $fin    = min($totalPaginas, $pagina + 2);

                    if ($inicio > 1) echo '<span>...</span>';

                    for ($i = $inicio; $i <= $fin; $i++):
                    ?>
                        <?php if ($i == $pagina): ?>
                            <span class="actual"><?= $i ?></span>
                        <?php else: ?>
                            <a href="?<?= $filtros ?>&pagina=<?= $i ?>"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($fin < $totalPaginas) echo '<span>...</span>'; ?>

                    <?php if ($pagina < $totalPaginas): ?>
                        <a href="?<?= $filtros ?>&pagina=<?= $pagina + 1 ?>">Siguiente →</a>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

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