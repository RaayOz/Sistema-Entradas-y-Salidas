<?php
session_start();
if (!isset($_SESSION['usuario'], $_SESSION['nocontrol'], $_SESSION['rol']) || $_SESSION['rol'] != 2) {
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/button.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/mensajes.css">
    <link rel="stylesheet" href="../../assets/css/background.css">
</head>

<body>

    <?php include("../components/navbar.php"); ?>
    <?php include("../components/sidebar.php"); ?>
    <?php include("../../includes/mensajes.php");
    mostrarMensaje(); ?>

    <div class="main-container" id="main-content">
        <div class="card">
            <form action="../../includes/registrarAcceso.php" method="POST">
                <h1>Registrar Acceso</h1>

                <label>Número de control</label>
                <input type="text" name="nocontrol" placeholder="Número de control" maxlength="10" pattern="[0-9]{1,10}" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" title="El número de control debe tener entre 1 y 10 caracteres numericos" required>

                <label for="motivo">Motivo de Visita</label>
                <select id="motivo" name="motivo" required>
                    <option value="">Seleccionar motivo</option>
                    <option value="VISITA ACADEMICA">Visita académica</option>
                    <option value="ENTREGA DOCUMENTOS">Entrega de documentos</option>
                    <option value="REUNION">Reunión</option>
                    <option value="EVENTO">Evento</option>
                </select>

                <input type="hidden" name="metodoacceso" value="Peatonal">

                <button class="botonc">Registrar Acceso</button>
            </form>
        </div>
    </div>

    <script>
        const btn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('main-content');

        if (btn) {
            btn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                content.classList.toggle('pushed');
            });
        }

        const modal = document.getElementById("modalMensaje");

        if (modal) {
            setTimeout(() => {
                modal.style.opacity = "0";
                modal.style.transition = "opacity 0.4s";
                setTimeout(() => {
                    modal.remove();
                }, 400);
            }, 3000);
            modal.addEventListener("click", () => {
                modal.style.opacity = "0";
                setTimeout(() => {
                    modal.remove();
                }, 300);
            });
        }
    </script>

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
</body>

</html>