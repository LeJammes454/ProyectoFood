<?php
require_once 'configuracionBD.php';

class Database
{
    private $conn;

    public function __construct()
    {
        // Crear la conexión
        $this->conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function getDatosMenu()
    {
        $sql = "SELECT nombre, url FROM MENU";
        $result = $this->conn->query($sql);

        $datos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = $row;
            }
        }

        return $datos;
    }

    public function guardarReservacion($email, $numeroPersona, $hora, $dia)
    {
        $sql = "INSERT INTO RESERVACION (EMAIL, NUMEROPERSONA, HORA, DIA) VALUES ('$email', $numeroPersona, '$hora', '$dia')";

        if ($this->conn->query($sql) === TRUE) {
            return true; // Éxito al guardar la reservación
        } else {
            return false; // Error al guardar la reservación
        }
    }
    public function registrarUsuario(
        $nombre,
        $apellido_paterno,
        $apellido_materno,
        $contrasenia,
        $numero_telefonico,
        $direccion,
        $codigo_postal,
        $correo
    ) {
        // Verificar si el correo ya existe en la base de datos
        $sql_verificar = "SELECT * FROM USUARIOS WHERE CORREO = '$correo'";
        $result_verificar = $this->conn->query($sql_verificar);

        if ($result_verificar->num_rows > 0) {
            return false; // Error al registrar usuario
        } else {
            // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla
            $sql = "INSERT INTO USUARIOS (NOMBRE, APELLIDOM, APELLIDOP, CONTRASENIA, TELEFONO, DIRECCION, CODIGOPOSTAL, CORREO)
        VALUES ('$nombre', '$apellido_materno', '$apellido_paterno', '$contrasenia', '$numero_telefonico', '$direccion', '$codigo_postal', '$correo')";

            if ($this->conn->query($sql) === TRUE) {
                return true; // Éxito al registrar usuario
            } else {
                return false; // Error al registrar usuario
            }
        }
    }

    public function loginVerificarCorreo($contrasenia, $correo)
    {

        $sql="SELECT * FROM usuarios WHERE contrasenia = '$contrasenia' AND correo = '$correo';";
        $result_verificar = $this->conn->query($sql);

        if ($result_verificar->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cerrarConexion()
    {
        $this->conn->close();
    }
}