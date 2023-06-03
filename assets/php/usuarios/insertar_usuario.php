<?php
require_once '../usuarioDao.php';

// Obtener los datos del usuario enviados por POST
$nombre = $_POST['nombre'];
$apellidoM = $_POST['apellido_materno'];
$apellidoP = $_POST['apellido_paterno'];
$contrasenia = $_POST['contrasenia'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$ocupacion = $_POST['ocupacion'];
$rol = $_POST['rol'];

// Crear una instancia de la clase UsuarioDao
$daoUsuarios = new UsuarioDao();

// Insertar el usuario en la base de datos
$insercionExitosa = $daoUsuarios->insertarUsuario($nombre, $apellidoM, $apellidoP, $contrasenia, $telefono, $correo, $ocupacion, $rol);

// Verificar si la inserción fue exitosa
if ($insercionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
