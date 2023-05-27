<?php
require_once 'coneccionBD.php';

// Crear una instancia de la clase Database
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $email = $_POST["email"];
    $numberOfGuests = $_POST["numberOfGuests"];
    $time = $_POST["time"];
    $date = $_POST["date"];

    // Guardar la reservación utilizando la función de la clase Database
    if ($db->guardarReservacion($email, $numberOfGuests, $time, $date)) {
        echo "Reservación realizada con éxito";
    } else {
        echo "Error al realizar la reservación";
    }
}
// Cerrar la conexión
$db->cerrarConexion();

?>
