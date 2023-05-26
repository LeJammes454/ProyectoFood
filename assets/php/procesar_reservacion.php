<?php
require_once 'coneccionBD.php';

/*
// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conexión exitosa a la base de datos.";

// Cerrar la conexión
$conn->close();
*/


// Crear una instancia de la clase Database
$db = new Database();

// Verificar si se ha enviado el formulario


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
