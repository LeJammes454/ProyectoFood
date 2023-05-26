<?php
require_once 'coneccionBD.php';

$database = new Database();

$email = $_POST['email'];
$numeroPersona = $_POST['numberOfGuests'];
$hora = $_POST['time'];
$dia = $_POST['date'];

if ($database->guardarReservacion($email, $numeroPersona, $hora, $dia)) {
    echo "Reservación guardada exitosamente.";
} else {
    echo "Error al guardar la reservación.";
}

$database->cerrarConexion();
?>
