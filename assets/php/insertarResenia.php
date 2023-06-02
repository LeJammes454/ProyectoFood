<?php
require_once 'coneccionBD.php';
session_start();

$db = new Database();

$correo = $_SESSION["correo"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//$db->loginVerificarCorreo($contrasenia,$correo)
    $resenia = $_POST['resenia'];

      if ($db->InsertarResenia($resenia ,$correo)) {
        echo "Se inserto correctamente la reseña, gracias";
    } else {
        echo "error al intentar ingresar la reseña";
    }
}

// Cerrar la conexión
$db->cerrarConexion();
?>