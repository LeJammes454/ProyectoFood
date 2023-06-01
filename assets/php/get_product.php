<?php
require_once 'coneccionBD.php';

// Verificar si se recibió el ID del elemento
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realizar la lógica para obtener los datos del elemento según su ID desde la base de datos
    // Aquí debes usar tu propia lógica y consultas a la base de datos

    // Ejemplo: Supongamos que tienes una función llamada getDatosElemento() en tu clase Database
    $database = new Database();
    // Realiza la consulta a la base de datos utilizando la función getProductById
    $product = $database->getProductById($id);

    // Verifica si se encontró el producto y devuelve los datos en formato JSON
    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(['nombre' => 'No encontrado', 'precio' => 'No encontrado']);
    }

} else {
    // No se recibió el ID del elemento
    echo "ID del elemento no proporcionado";
}