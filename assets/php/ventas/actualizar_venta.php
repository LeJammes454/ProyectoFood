<?php
require_once '../compraDao.php';

// Obtener los datos de la compra enviados por POST
$compraID = $_POST['id'];
$usuarioID = $_POST['usuario_id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$precioTotal = $_POST['precio_total'];
$fechaHora = $_POST['fecha_hora'];

// Crear una instancia de la clase CompraDao
$daoCompras = new CompraDao();

// Actualizar los datos de la compra en la base de datos
$actualizacionExitosa = $daoCompras->actualizarCompra($compraID, $usuarioID, $nombre, $precio, $cantidad, $precioTotal, $fechaHora);

// Verificar si la actualización fue exitosa
if ($actualizacionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
