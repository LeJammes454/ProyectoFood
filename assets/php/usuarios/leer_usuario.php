<?php
require_once '../usuarioDao.php';

// Obtener el ID del usuario enviado por POST
$usuarioID = $_POST['id'];

// Crear una instancia de la clase UsuarioDao
$daoUsuarios = new UsuarioDao();

// Obtener el usuario por su ID
$usuario = $daoUsuarios->obtenerUsuarioPorId($usuarioID);

// Verificar si se encontró el usuario
if ($usuario) {
    // Convertir el usuario a formato JSON y devolverlo como respuesta
    echo json_encode($usuario);
} else {
    // Si no se encontró el usuario, devolver un mensaje de error
    echo 'error';
}
?>
