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
    <title>Registro de Acceso</title>
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

    <input
        type="text"
        id="scanner"
        autocomplete="off"
        style="position:absolute; left:-9999px; opacity:0;">

    <div class="main-container" id="main-content">

        <div class="card">

            <form action="../../includes/registrarAcceso.php" method="POST" id="formAcceso">

                <h1>Registrar Acceso</h1>

                <label>Número de control</label>
                <input
                    type="text"
                    name="nocontrol"
                    placeholder="Número de control"
                    maxlength="10"
                    pattern="[0-9]{1,10}"
                    style="text-transform: uppercase;"
                    oninput="this.value = this.value.toUpperCase()"
                    required>

                <label for="motivo">Motivo de Visita</label>
                <select id="motivo" name="motivo">
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
        const scanner = document.getElementById("scanner");
        const form = document.getElementById("formAcceso");
        const nocontrol = document.querySelector("input[name='nocontrol']");

        function mantenerFoco() {

            const activo = document.activeElement;
            const esInputNormal =
                activo && (
                    activo.name === "nocontrol" ||
                    activo.tagName === "SELECT" ||
                    activo.tagName === "INPUT" && activo.id !== "scanner"
                );

            if (!esInputNormal) {
                scanner.focus();
            }
        }

        setInterval(mantenerFoco, 1000);

        scanner.addEventListener("keydown", function(e) {
            if (e.key === "Enter") {

                const value = scanner.value.trim();

                if (value.length > 0) {
                    nocontrol.value = value;
                    scanner.value = "";
                    form.submit();
                }
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const modal = document.getElementById("modalMensaje");

            if (!modal) return;

            let removed = false;

            function cerrarMensaje() {
                if (removed) return;
                removed = true;

                modal.style.opacity = "0";

                setTimeout(() => {
                    if (modal.parentNode) {
                        modal.remove();
                    }
                }, 300);
            }

            setTimeout(cerrarMensaje, 3000);

            document.addEventListener("click", cerrarMensaje);
        });
    </script>

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
