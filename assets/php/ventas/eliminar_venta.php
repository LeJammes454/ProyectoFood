<?php
require_once '../compraDao.php';

// Obtener el ID de la compra enviado por POST
$compraID = $_POST['id'];

// Crear una instancia de la clase CompraDao
$daoCompras = new CompraDao();

// Eliminar la compra de la base de datos
$eliminacionExitosa = $daoCompras->eliminarCompra($compraID);

// Verificar si la eliminación fue exitosa
if ($eliminacionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
