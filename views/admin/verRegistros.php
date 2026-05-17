<?php
/**
 * Vista de registros de acceso para administrador.
 *
 * Carga el conjunto de registros filtrados y paginados y muestra
 * la tabla con resultados, filtros y opción de exportar CSV.
 */
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
    <title>Accesos Registrados</title>
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/button.css">
    <link rel="stylesheet" href="../../assets/css/filtros.css">
    <link rel="stylesheet" href="../../assets/css/paginacion.css">
    <link rel="stylesheet" href="../../assets/css/exportar.css">
    <link rel="stylesheet" href="../../assets/css/tableCheck.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>

<body>

    <?php include("../components/navbar.php"); ?>
    <?php include("../components/sidebar.php"); ?>

    <!-- Contenedor principal: vista de registros con filtros y exportación CSV -->
    <div class="main-container" id="main-content">
        <div class="contenedor-tabla">
            <h1>Accesos Registrados</h1>

            <!-- Formulario de filtros para buscar registros y generar exportaciones -->
            <form method="GET" class="filtros">

                <input type="text" name="usuario" placeholder="No. Control" value="<?= $_GET['usuario'] ?? '' ?>">
                <input type="text" name="matricula" placeholder="Matrícula" value="<?= $_GET['matricula'] ?? '' ?>">

                <select name="metodo">
                    <option value="">Método Acceso</option>
                    <option value="Vehicular" <?= (($_GET['metodo'] ?? '') == 'Vehicular') ? 'selected' : '' ?>>Vehicular</option>
                    <option value="Peatonal" <?= (($_GET['metodo'] ?? '') == 'Peatonal')  ? 'selected' : '' ?>>Peatonal</option>
                </select>

                <input type="date" name="fecha" value="<?= $_GET['fecha'] ?? '' ?>">
                <input type="time" name="hora" value="<?= $_GET['hora']  ?? '' ?>">

                <button class="botonc" type="submit">Filtrar</button>
                <a href="verRegistros.php"><button class="botonc eliminar" type="button">Limpiar</button></a>

                <?php
                $params = http_build_query([
                    'usuario'   => $_GET['usuario']   ?? '',
                    'matricula' => $_GET['matricula'] ?? '',
                    'metodo'    => $_GET['metodo']    ?? '',
                    'fecha'     => $_GET['fecha']     ?? '',
                    'hora'      => $_GET['hora']      ?? '',
                ]);
                ?>

                <a href="../../includes/exportarRegistros.php?<?= $params ?>&tipo=csv">
                    <button class="botonc" type="button">⬇ Descargar CSV</button>
                </a>
            </form>

            <div class="info-pagina">
                Mostrando página <?= isset($pagina) ? $pagina : 1 ?> de <?= isset($totalPaginas) ? $totalPaginas : 1 ?>
                (<?= isset($totalRegistros) ? $totalRegistros : 0 ?> registros totales)
            </div>

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
                    <?php if (isset($resultRegistros) && $resultRegistros->num_rows > 0): ?>
                        <?php while ($fila = $resultRegistros->fetch_assoc()): ?>
                            <tr>
                                <td><?= $fila['NoControl'] ?></td>
                                <td><?= $fila['EntradaSalida'] ?></td>
                                <td><?= $fila['MetodoAcceso'] ?></td>
                                <td><?= $fila['Matricula'] ?></td>
                                <td><?= $fila['Fecha'] ?></td>
                                <td><?= $fila['Hora'] ?></td>
                                <td><?= $fila['Lugar'] ?></td>
                                <td><?= $fila['Motivo'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No hay registros</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php if (isset($totalPaginas) && $totalPaginas > 1): ?>
                <div class="paginacion">

                    <?php
                    $filtros = http_build_query([
                        'usuario'   => $_GET['usuario']   ?? '',
                        'matricula' => $_GET['matricula'] ?? '',
                        'metodo'    => $_GET['metodo']    ?? '',
                        'fecha'     => $_GET['fecha']     ?? '',
                        'hora'      => $_GET['hora']      ?? '',
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
