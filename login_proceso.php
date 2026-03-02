<?php
// 1. Conexión a base de datos 
$conexion = new mysqli("localhost", "root", "", "sistema_itt");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 2. Recibir los datos 
$numero_control = $_POST['numero_control']; 
$password = $_POST['password'];

// 3. Buscar en la tabla 
$sql = "SELECT * FROM alumno WHERE no_control = ? AND contrasena = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $numero_control, $password);
$stmt->execute();
$resultado = $stmt->get_result();

// 4. desplegar
if ($resultado->num_rows > 0) {
    $datos = $resultado->fetch_assoc();
    echo "<div style='text-align:center; font-family:Arial; margin-top:50px;'>";
    echo "<h1 style='color:#1800ad;'>¡Acceso Correcto!</h1>";
    echo "<h3>Bienvenido, " . $datos['nombre'] . "</h3>";
    echo "<p>Número de control: " . $datos['no_control'] . "</p>";
    echo "</div>";
} else {
    echo "<div style='text-align:center; font-family:Arial; margin-top:50px;'>";
    echo "<h1 style='color:red;'>Error de Acceso</h1>";
    echo "<p>Usuario o contraseña incorrectos.</p>";
    echo "<a href='index.html'>Volver a intentar</a>";
    echo "</div>";
}

$stmt->close();
$conexion->close();
?>
