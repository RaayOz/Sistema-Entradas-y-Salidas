<?php
// 1. CONEXIÓN A LA BASE DE DATOS
// (Servidor, Usuario, Contraseña, Nombre de la BD)
$conexion = new mysqli("localhost", "root", "", "siesa-itt");

// Verificamos si la conexión falló
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 2. RECIBIR LOS DATOS DEL FORMULARIO HTML
// "usuario" y "password" son los 'names' que le pusimos a los inputs en el HTML
$numero_control = $_POST['usuario']; 
$contrasena = $_POST['password'];

// 3. CONSULTA SEGURA (Previene hackers básicos)
// Le preguntamos a la BD: "¿Existe alguien con este ID y esta contraseña?"
$sql = "SELECT * FROM usuarios WHERE id_usuario = ? AND contrasena = ?";

// Preparamos la orden (esto es como usar parámetros en C#)
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $numero_control, $contrasena); // "ss" significa que son dos Strings
$stmt->execute();
$resultado = $stmt->get_result();

// 4. VERIFICAR RESULTADO
if ($resultado->num_rows > 0) {
    // ¡SÍ EXISTE!
    $fila = $resultado->fetch_assoc();
    
    // Aquí es donde decidimos qué pasa. Por ahora, mostramos un mensaje bonito.
    echo "<div style='text-align:center; margin-top:50px; font-family:Arial;'>";
    echo "<h1 style='color:green;'>¡Acceso Correcto!</h1>";
    echo "<h3>Bienvenido al sistema SIESA, " . $fila['nombre'] . "</h3>";
    echo "<p>Tu rol es: " . $fila['rol'] . "</p>";
    
   // Cambiaremos esto para que te mande al menú principal
   
    echo "</div>";

} else {
    // NO EXISTE O CONTRASEÑA MAL
    echo "<div style='text-align:center; margin-top:50px; font-family:Arial;'>";
    echo "<h1 style='color:red;'>Error de Acceso</h1>";
    echo "<h3>Usuario o contraseña incorrectos.</h3>";
    echo "<a href='index.html'>Intentar de nuevo</a>";
    echo "</div>";
}

// Cerramos la conexión para ahorrar memoria
$stmt->close();
$conexion->close();
?>