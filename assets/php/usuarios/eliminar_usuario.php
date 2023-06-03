<?php
require_once '../usuarioDao.php';

// Obtener el ID del usuario enviado por POST
$usuarioID = $_POST['id'];

// Crear una instancia de la clase UsuarioDao
$daoUsuarios = new UsuarioDao();

// Eliminar el usuario de la base de datos
$eliminacionExitosa = $daoUsuarios->eliminarUsuario($usuarioID);

// Verificar si la eliminación fue exitosa
if ($eliminacionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
