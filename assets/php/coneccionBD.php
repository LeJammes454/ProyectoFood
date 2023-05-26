<?php
require_once 'configuracionBD.php';

class Database {
    private $conn;

    public function __construct() {
        // Crear la conexión
        $this->conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function getDatosMenu() {
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

    public function guardarReservacion($email, $numeroPersona, $hora, $dia) {
        $sql = "INSERT INTO RESERVACION (EMAIL, NUMEROPERSONA, HORA, DIA) VALUES ('$email', $numeroPersona, '$hora', '$dia')";

        if ($this->conn->query($sql) === TRUE) {
            return true; // Éxito al guardar la reservación
        } else {
            return false; // Error al guardar la reservación
        }
    }

    public function cerrarConexion() {
        $this->conn->close();
    }
}
?>