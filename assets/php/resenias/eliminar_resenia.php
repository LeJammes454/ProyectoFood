<?php
require_once '../reseniaDao.php';

// Obtener el ID de la reseña enviado por POST
$reseniaID = $_POST['id'];

// Crear una instancia de la clase ReseniaDao
$daoResenias = new ReseniaDao();

// Eliminar la reseña de la base de datos
$eliminacionExitosa = $daoResenias->eliminarResenia($reseniaID);

// Verificar si la eliminación fue exitosa
if ($eliminacionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
