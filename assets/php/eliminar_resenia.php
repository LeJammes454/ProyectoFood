<?php
// Obtener el ID de la reseña a eliminar
$idResena = $_POST['idResena']; // Suponiendo que el ID se pasa a través de un formulario POST

// Realizar la conexión a la base de datos
require_once 'configuracionBD.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Consulta DELETE para eliminar la reseña
$sql = "DELETE FROM RESENIAS WHERE ID = $idResena";

if ($conn->query($sql) === TRUE) {
    echo "La reseña se ha eliminado correctamente.";
} else {
    echo "Error al eliminar la reseña: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
