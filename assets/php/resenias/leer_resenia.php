<?php
require_once '../reseniaDao.php';

// Obtener el ID de la reseña enviado por POST
$reseniaID = $_POST['id'];

// Crear una instancia de la clase ReseniaDao
$daoResenias = new ReseniaDao();

// Obtener la reseña por su ID
$resenia = $daoResenias->obtenerReseniaPorId($reseniaID);

// Verificar si se encontró la reseña
if ($resenia) {
    // Convertir la reseña a formato JSON y devolverla como respuesta
    echo json_encode($resenia);
} else {
    // Si no se encontró la reseña, devolver un mensaje de error
    echo 'error';
}
?>
