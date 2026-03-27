<?php
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Requiere que los datos ingresados sean mediante el metodo POST para seguridad.
    //Datos personales del usuario.
    $numeroControl = $_POST["numeroControl"];

    try {
        require_once "dbh.inc.php"; //Checa que la base de datos este conectada.

        if (!$pdo) {
            throw new PDOException("Database connection failed");
        }

        $query = "SELECT * FROM Usuario WHERE NoControl = :numeroControl; ";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":numeroControl", $numeroControl);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query Fallada" . $e->getMessage());
    }
}
else {
    header("location: ../index.php");//Regresa a index si se intenta ingresar datos malos.
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Datos de usuario</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>
    <h1 text_align="center">Resultados</h2>

    <?php
    if (empty($result)) {
        echo "<div>";
        echo "<p>Usuario no existe...";
        echo "</div>";
    }
    else {
        foreach ($result as $row) {
            ?>
            <div class="container">
            <div class="card">
                <?php
                echo "<p>" . "Numero ID: " . ($row["ID_Usuario"]) . " ";
                echo "<p>" . "Nombres: " . ($row["Nombres"]) . " ";
                echo "<p>" . "Apellidos: " . ($row["Apellidos"]) . " ";
                echo "<p>" . "Correo: " . ($row["Correo"]) . " ";
                echo "<p>" . "Rol " . ($row["ID_Rol"]) . " ";
                ?>
            </div>
            </div>
            <?php
    }}
    ?>
</body>
</html>