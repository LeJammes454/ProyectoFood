<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos (ejemplo)
    // Conexión a la base de datos (ejemplo)
    require_once 'configuracionBD.php';

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("La conexión falló: " . $conn->connect_error);
    }
    // Obtener los datos del formulario
    $correo = $_SESSION['correo'];
    $nombre = $_POST["inputName"];
    $ocupacion = $_POST["inputOcupacion"];
    $resenia = $_POST["inputResenia"];
    $fechaActual = date('Y-m-d');

    // Insertar los datos en la tabla "RESENIAS"
    $sql = "INSERT INTO RESENIAS (nombre, ocupacion, resena,correo, fecha)
            VALUES ('$nombre','$ocupacion','$resenia','$correo','$fechaActual')";

    if ($conn->query($sql) === TRUE) {
        echo "Reseña agregada exitosamente.";
    } else {
        echo "Error al agregar la reseña: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>

