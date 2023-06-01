<?php
// Obtén el código del cupón enviado como parámetro GET
$cuponCodigo = $_GET['cupon'];


require_once 'configuracionBD.php';


// Crea la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si la conexión es exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Escapa el código del cupón para evitar inyecciones SQL
$cuponCodigo = $conn->real_escape_string($cuponCodigo);

// Realiza la consulta para obtener el descuento correspondiente al código del cupón
$query = "SELECT DESCUENTO FROM CUPONES WHERE CODIGO = '$cuponCodigo'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $descuento = $row['DESCUENTO'];

    // Devuelve el descuento como respuesta
    echo $descuento;
} else {
    echo "Cupón no válido";
}

// Cierra la conexión a la base de datos
$conn->close();
?>
