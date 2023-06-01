<?php

require_once 'configuracionBD.php';

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay algún error en la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Datos a insertar en la tabla
$data = json_decode($_GET['data'], true);

// Insertar los datos en la tabla
foreach ($data as $row) {
    $platillo = $row['platillo'];
    $precioU = $row['precioU'];
    $cantidad = $row['cantidad'];
    $precioT = $row['precioT'];

    $sql = "INSERT INTO nombre_tabla (platillo, precioU, cantidad, precioT) VALUES ('$platillo', $precioU, $cantidad, $precioT)";

    if ($conn->query($sql) === true) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar los datos: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
