<?php //Archivo para conectar a la base de datos.

$dsn = "mysql:host=localhost;dbname=SIESA" //Conecta a un driver de mysql con localhost a la base de datos SIESA.
$dbusername = "Luggsmi"; //Nombre del usuario de Mysql
$dbpassword = "Luxemburgo01"; //Password del usario de Mysql

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword); //Conecta con php data objects con las parametros anteriores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION )
} catch (PDOException $e) { //Manda un error si no se puede conectar a la base de datos.
    echo "Conexion fracasada: " . $e->getMessage();
}

