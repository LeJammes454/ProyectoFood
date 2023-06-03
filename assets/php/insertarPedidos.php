<?php
require_once 'configuracionBD.php';

// Establecer la conexión a la base de datos utilizando mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener el correo de la sesión
session_start();
$correo = $_SESSION['correo'];

// Recibir los datos enviados por AJAX
$datos = $_POST['data'];

// Resto de tu código de verificación de inicio de sesión

$data = json_decode($datos, true);
$fechaHoraActual = date('Y-m-d H:i:s');
// Recorrer los datos y ejecutar la consulta para insertar cada fila
foreach ($data as $row) {
    $nombre = $row[0];
    $precio = $row[1];
    $cantidad = $row[2];
    $precioTotal = $row[3];
    $totalSum += $precioTotal;


    // Consulta SQL para insertar la compra
    $sql = "CALL InsertarCompra('$correo', '$nombre', $precio, $cantidad, $precioTotal,'$fechaHoraActual')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente en la base de datos.";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>