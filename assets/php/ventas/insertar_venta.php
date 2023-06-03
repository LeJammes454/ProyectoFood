<?php
require_once '../compraDao.php';

// Obtener los datos de la compra enviados por POST
$usuarioID = $_POST['usuario_id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$precioTotal = $_POST['precio_total'];
$fechaHora = $_POST['fecha_hora'];

// Crear una instancia de la clase CompraDao
$daoCompras = new CompraDao();

// Insertar la compra en la base de datos
$insercionExitosa = $daoCompras->insertarCompra($usuarioID, $nombre, $precio, $cantidad, $precioTotal, $fechaHora);

// Verificar si la inserción fue exitosa
if ($insercionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
