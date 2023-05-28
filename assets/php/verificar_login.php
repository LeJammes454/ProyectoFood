<?php
// Conexión a la base de datos
require_once 'coneccionBD.php';

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario enviados por Ajax
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    $contrasenia = hash('sha512',$contrasenia);

    // Guardar la reservación utilizando la función de la clase Database
    if ($db->loginVerificarCorreo($contrasenia,$correo)) {
        session_start(); // Iniciar sesión
        $_SESSION['correo'] = $correo; // Guardar el correo en la sesión
        echo "ok";
    } else {
        echo "error";
    }
}

// Cerrar la conexión
$db->cerrarConexion();