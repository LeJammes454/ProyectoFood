<?php
// Conexión a la base de datos
require_once 'coneccionBD.php';
require_once 'configuracionBD.php';
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario enviados por Ajax
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    $contrasenia = hash('sha512', $contrasenia);

    // Crear una conexión a la base de datos utilizando MySQLi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar si hay errores en la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Preparar la consulta SQL
    $query = "SELECT NOMBRE,ROL FROM USUARIOS WHERE CORREO = '$correo'";

    // Ejecutar la consulta
    $result = $conn->query($query);

    // Verificar si se encontró un usuario con el correo proporcionado
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rol = $row['ROL'];
        $nombre = $row['NOMBRE'];
      //  echo "El usuario con el correo $correo tiene el rol: $rol";
    } else {
       // echo "No se encontró ningún usuario con el correo $correo";
    }
    $rol = $row['ROL'];
    $nombre = $row['NOMBRE'];

    // Guardar la reservación utilizando la función de la clase Database
    if ($db->loginVerificarCorreo($contrasenia, $correo)) {
        session_start(); // Iniciar sesión
        $_SESSION['correo'] = $correo; // Guardar el correo en la sesión
        $_SESSION['rol'] = $rol; // Guardar el rol en la sesión
        $_SESSION['nombre'] = $nombre; // Guardar el nombre en la sesión
        echo "ok";
    } else {
        echo "error";
    }
}

// Cerrar la conexión
$db->cerrarConexion();