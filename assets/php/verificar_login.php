<?php
// Conexión a la base de datos
require_once 'coneccionBD.php';

$db = new Database();

// Obtener los datos del formulario enviados por Ajax
//$correo = $_POST['correo'];
//$contrasenia = $_POST['contrasenia'];
// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}else{
    
}



$conn->close();