<?php
require_once 'coneccionBD.php';

$db = new Database();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario enviados por Ajax
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $contrasenia = $_POST['contrasenia'];
    $numero_telefonico = $_POST['numero_telefonico'];
    $direccion = $_POST['direccion'];
    $codigo_postal = $_POST['codigo_postal'];
    $correo = $_POST['correo'];
    $contrasenia = hash('sha512',$contrasenia);
    //$hashed_password = password_hash($contrasenia, PASSWORD_DEFAULT);


    // Guardar la reservación utilizando la función de la clase Database
    if ($db->registrarUsuario(
        $nombre,
        $apellido_paterno,
        $apellido_materno,
        $contrasenia,
        $numero_telefonico,
        $direccion,
        $codigo_postal,
        $correo
    )) {
        echo "ok";
    } else {
        echo "error";
    }
}


// Cerrar la conexión
$db->cerrarConexion();
