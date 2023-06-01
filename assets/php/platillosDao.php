<?php
require_once 'coneccionBD.php';

// Verificar la acción solicitada
if (isset($_POST['action'])) {
    $id = $_POST['id'];

    if ($_POST['action'] === 'modificar') {
        // Lógica para modificar el elemento con el ID proporcionado
        modificarElemento($id);
    } elseif ($_POST['action'] === 'eliminar') {
        // Lógica para eliminar el elemento con el ID proporcionado
        eliminarElemento($id);
    } elseif ($_POST['action'] === 'obtenerPlatiilo') {
        // Lógica para eliminar el elemento con el ID proporcionado
        obtenerPlatillo($id);
    }
}

// Función para modificar el elemento
function modificarElemento($id)
{
    // Tu código para modificar el elemento con el ID proporcionado
    // ...
    // Puedes devolver una respuesta al archivo JavaScript si es necesario
    echo "Elemento modificado correctamente";
}

// Función para eliminar el elemento
function eliminarElemento($id)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica si se recibió el parámetro "id" en la solicitud
        if (isset($_POST["id"])) {
            $id = $_POST["id"];

            // Aquí puedes implementar la lógica para eliminar el elemento de la base de datos utilizando el ID recibido
            // Asegúrate de tener una instancia de la clase Database y su respectiva implementación para ejecutar la eliminación

            $database = new Database();
            $eliminado = $database->eliminarPlato($id);

            if ($eliminado) {
                // El elemento se eliminó correctamente
                // Puedes enviar una respuesta de confirmación al cliente
                echo "Elemento eliminado correctamente";
            } else {
                // Ocurrió un error al eliminar el elemento
                // Puedes enviar una respuesta de error al cliente
                echo "Error al eliminar el elemento";
            }

            $database->cerrarConexion();
        } else {
            // No se recibió el parámetro "id" en la solicitud
            // Puedes enviar una respuesta de error al cliente
            echo "Parámetro 'id' no recibido";
        }
    } else {
        // La solicitud no es de tipo POST
        // Puedes enviar una respuesta de error al cliente
        echo "Acceso no válido";
    }
}
function obtenerPlatillo($id)
{
    // Verificar si se recibió el ID del elemento
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Realizar la lógica para obtener los datos del elemento según su ID desde la base de datos
        // Aquí debes usar tu propia lógica y consultas a la base de datos

        // Ejemplo: Supongamos que tienes una función llamada getDatosElemento() en tu clase Database
        $database = new Database();
        $elemento = $database->getPlatillo($id);

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
}