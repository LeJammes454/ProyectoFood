<?php
require_once '../reseniaDao.php';

// Obtener los datos de la visibilidad enviados por POST
$id = $_POST['id'];
$visibilidad = $_POST['visibilidad'];

// Crear una instancia de la clase ReseniaDao
$reseniaDao = new ReseniaDao();

// Actualizar la visibilidad de la reseña en la base de datos
$actualizacionExitosa = $reseniaDao->actualizarVisibilidadResenia($id, $visibilidad);

// Verificar si la actualización fue exitosa
if ($actualizacionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
