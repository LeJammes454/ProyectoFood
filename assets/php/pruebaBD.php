<?php

require_once 'coneccionBD.php';

$db = new Database();


echo "Conexión exitosa a la base de datos.";

// Cerrar la conexión
$conn->close();


?>
