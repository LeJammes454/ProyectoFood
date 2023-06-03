<?php
require_once '../menuDao.php';

// Obtener el ID del platillo enviado por POST
$platilloID = $_POST['id'];

// Crear una instancia de la clase DAOplatillos
$daoPlatillos = new menuDao();

// Eliminar el platillo de la base de datos
$eliminacionExitosa = $daoPlatillos->eliminarPlatillo($platilloID);

// Verificar si la eliminación fue exitosa
if ($eliminacionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
