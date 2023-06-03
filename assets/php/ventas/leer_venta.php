<?php
require_once '../compraDao.php';

// Obtener el ID de la compra enviado por POST
$compraID = $_POST['id'];

// Crear una instancia de la clase CompraDao
$daoCompras = new CompraDao();

// Obtener la compra por su ID
$compra = $daoCompras->obtenerCompraPorId($compraID);

// Verificar si se encontró la compra
if ($compra) {
    // Convertir la compra a formato JSON y devolverla como respuesta
    echo json_encode($compra);
} else {
    // Si no se encontró la compra, devolver un mensaje de error
    echo 'error';
}
?>
