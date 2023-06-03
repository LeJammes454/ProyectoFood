<?php
require_once '../menuDao.php';

// Obtener los datos del platillo enviados por POST
$platilloID = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$url = $_POST['url'];

// Crear una instancia de la clase DAOplatillos
$daoPlatillos = new menuDao();

// Actualizar los datos del platillo en la base de datos
$actualizacionExitosa = $daoPlatillos->actualizarPlatillo($platilloID, $nombre, $descripcion, $precio, $url);

// Verificar si la actualización fue exitosa
if ($actualizacionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
