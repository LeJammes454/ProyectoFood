<?php
require_once 'coneccionBD.php';

// Verificar si se recibió el ID del elemento
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realizar la lógica para obtener los datos del elemento según su ID desde la base de datos
    // Aquí debes usar tu propia lógica y consultas a la base de datos

    // Ejemplo: Supongamos que tienes una función llamada getDatosElemento() en tu clase Database
    $database = new Database();
    $elemento = $database->eliminarPlato($id);
    
    // Verificar si se encontraron los datos del elemento
    if ($elemento) {
        // Devolver los datos del elemento en formato JSON
        echo json_encode($elemento);
    } else {
        // No se encontraron los datos del elemento
        echo "No se encontraron datos del elemento";
    }
} else {
    // No se recibió el ID del elemento
    echo "ID del elemento no proporcionado";
}