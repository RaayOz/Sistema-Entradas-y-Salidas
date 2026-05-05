<?php
session_start();

if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../index.php");
    exit;
}

include("../../includes/obtenerUsuarios.php");
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>Usuarios Registrados</title>
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
            <h1>Usuarios Registrados</h1>

            <form method="GET" class="filtros">

                <input type="text" name="nocontrol" placeholder="No Control" value="<?= $_GET['nocontrol'] ?? '' ?>">

                <select name="rol">
                    <option value="">Rol</option>
                    <option value="Administrador" <?= (($_GET['rol'] ?? '') == 'Administrador') ? 'selected' : '' ?>>Administrador</option>
                    <option value="Guardia" <?= (($_GET['rol'] ?? '') == 'Guardia') ? 'selected' : '' ?>>Guardia</option>
                    <option value="Alumno" <?= (($_GET['rol'] ?? '') == 'Alumno') ? 'selected' : '' ?>>Alumno</option>
                    <option value="Visitante" <?= (($_GET['rol'] ?? '') == 'Visitante') ? 'selected' : '' ?>>Visitante</option>
                </select>

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
                        <th>NUMERO DE CONTROL</th>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>CORREO</th>
                        <th>TELEFONO</th>
                        <th>ROL</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    if (isset($resultUsuarios) && $resultUsuarios->num_rows > 0) {

                        while ($fila = $resultUsuarios->fetch_assoc()) {
                    ?>

                            <tr>

                                <td><?php echo $fila['NoControl']; ?></td>
                                <td><?php echo $fila['Nombres']; ?></td>
                                <td><?php echo $fila['Apellidos']; ?></td>
                                <td><?php echo $fila['Correo']; ?></td>
                                <td><?php echo $fila['Telefono']; ?></td>
                                <td><?php echo $fila['NombreRol']; ?></td>

                                <td>

                                    <a href="editarUsuario.php?id=<?php echo $fila['ID_Usuario']; ?>">
                                        <button class="botonc">Editar</button>
                                    </a>

                                    <a href="../../includes/eliminarUsuario.php?id=<?php echo $fila['ID_Usuario']; ?>"
                                        onclick="return confirm('¿Eliminar usuario?')">

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

            <?php if (isset($totalPaginas) && $totalPaginas > 1): ?>
                <div class="paginacion">

                    <?php
                    $filtros = http_build_query([
                        'nocontrol' => $_GET['nocontrol'] ?? '',
                        'rol'       => $_GET['rol']       ?? '',
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