<?php
session_start();

if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../index.php");
    exit;
}

require_once "../../config/conexion.php";

$id = $_GET['id'];

$sql = "SELECT * FROM Carro WHERE ID_Carro = '$id'";
$result = $conn->query($sql);
$vehiculo = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Vehículo</title>
    <link rel="stylesheet" href="../../assets/css/edit.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>

<body>

    <?php include("../components/navbar.php"); ?>
    <?php include("../components/sidebar.php"); ?>

    <div class="container">

        <h1>Editar Vehículo</h1>

        <form action="../../includes/actualizarVehiculo.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $vehiculo['ID_Carro']; ?>">

            <label>Matricula de Carro</label>
            <input type="text" name="matricula" placeholder="Matrícula del Carro" maxlength="8" pattern="[A-Za-z0-9]{1,8}" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" title="La matrícula debe tener máximo 8 caracteres (letras y números)" required>

            <label>Marca</label>
            <input type="text" name="marca" placeholder="Marca del Carro" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

            <label>Modelo</label>
            <input type="text" name="modelo" placeholder="Modelo del Carro" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

            <label>Color</label>
            <input type="text" name="color" placeholder="Color del Carro" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

            <button type="submit">Actualizar Vehículo</button>

        </form>

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


</body>

</html>