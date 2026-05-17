<?php
/**
 * Página para editar los datos de un vehículo.
 *
 * Verifica acceso de administrador, obtiene el vehículo por ID
 * y muestra un formulario para actualizar sus campos.
 */
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
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/button.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>

<body>

    <?php include("../components/navbar.php"); ?>
    <?php include("../components/sidebar.php"); ?>

    <!-- Contenedor principal: formulario de edición de vehículo -->
    <div class="main-container" id="main-content">
        <div class="card">
            <h1>Editar Vehículo</h1>

            <!-- Formulario que actualiza los datos del vehículo seleccionado -->
            <form action="../../includes/actualizarVehiculo.php" method="POST">

                <input type="hidden" name="id" value="<?php echo $vehiculo['ID_Carro']; ?>">

                <label>Matricula de Carro</label>
                <input type="text" name="matricula" value="<?php echo $vehiculo['Matricula']; ?>" placeholder="Matrícula del Carro" maxlength="8" pattern="[A-Za-z0-9]{1,8}" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" title="La matrícula debe tener máximo 8 caracteres (letras y números)" required>

                <label>Marca</label>
                <input type="text" name="marca" value="<?php echo $vehiculo['Marca']; ?>" placeholder="Marca del Carro" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

                <label>Modelo</label>
                <input type="text" name="modelo" value="<?php echo $vehiculo['Modelo']; ?>" placeholder="Modelo del Carro" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

                <label>Color</label>
                <input type="text" name="color" value="<?php echo $vehiculo['Color']; ?>" placeholder="Color del Carro" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" required>

                <button type="submit" class="botonc">Actualizar Vehículo</button>

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
