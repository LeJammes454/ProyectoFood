<?php
require_once '../menuDao.php';

// Obtener los datos del platillo enviados por POST
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$url = $_POST['url'];

// Crear una instancia de la clase DAOplatillos
$daoPlatillos = new menuDao();

// Insertar el platillo en la base de datos
$insercionExitosa = $daoPlatillos->insertarPlatillo($nombre, $descripcion, $precio, $url);

// Verificar si la inserción fue exitosa
if ($insercionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
