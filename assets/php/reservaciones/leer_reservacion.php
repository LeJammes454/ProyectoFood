<?php
require_once '../menuDao.php';

// Obtener el ID del platillo enviado por POST
$platilloID = $_POST['id'];

// Crear una instancia de la clase DAOplatillos
$daoPlatillos = new menuDao();

// Obtener el platillo por su ID
$platillo = $daoPlatillos->obtenerPlatilloPorId($platilloID);

// Verificar si se encontró el platillo
if ($platillo) {
    // Convertir el platillo a formato JSON y devolverlo como respuesta
    echo json_encode($platillo);
} else {
    // Si no se encontró el platillo, devolver un mensaje de error
    echo 'error';
}
?>
