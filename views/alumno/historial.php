<?php
session_start();

if(!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol'])){
    header("Location: ../../index.php");
    exit;
}

include("../../includes/historial.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="table-container">

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

    <?php if($result && $result->num_rows > 0){ ?>

        <?php while($row = $result->fetch_assoc()){ ?>

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

</body>
</html>