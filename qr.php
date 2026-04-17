<?php
include_once("includes/dbh.inc.php");
$control = $_GET['control'] ?? null;

// Checa que sea un numero
if (!is_numeric($control)) {
    die("No es numero!");
}

$stmt = $pdo->prepare("SELECT * FROM Usuario WHERE NoControl= :control");
$stmt->bindParam(":control", $control, PDO::PARAM_INT);
$stmt -> execute();

$result = $stmt->fetchAll();
?>

<h1>Datos del usuario.</h1>

<?php
foreach ($result as $row) {
    echo "Nombres: " . $row["Nombres"] . "<br>";
    echo "Apellidos: " . $row["Apellidos"] . "<br>";
    echo "Numero de control: " . $row["NoControl"] . "<br>";
    echo "Telefono: " . $row["Telefono"] . "<br>";

    echo "hola" . $control;
}
?>