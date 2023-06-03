<?php
require_once '../reseniaDao.php';

// Obtener los datos de la reseña enviados por POST
$nombre = $_POST['nombre'];
$ocupacion = $_POST['ocupacion'];
$resena = $_POST['resena'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha'];

// Crear una instancia de la clase ReseniaDao
$daoResenias = new ReseniaDao();

// Insertar la reseña en la base de datos
$insercionExitosa = $daoResenias->insertarResenia($nombre, $ocupacion, $resena, $correo, $fecha);

// Verificar si la inserción fue exitosa
if ($insercionExitosa) {
    // Devolver respuesta de éxito
    echo 'success';
} else {
    // Devolver respuesta de error
    echo 'error';
}
?>
