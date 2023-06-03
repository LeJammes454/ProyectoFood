<?php

require_once 'configuracionBD.php';

class ReservacionDao {
    private $conn;

    public function __construct() {
        global $servername, $username, $password, $dbname;
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function desconectar() {
        $this->conn->close();
    }

    public function insertarReservacion($email, $numeroPersona, $hora, $dia) {
        $email = $this->conn->real_escape_string($email);
        $numeroPersona = $this->conn->real_escape_string($numeroPersona);
        $hora = $this->conn->real_escape_string($hora);
        $dia = $this->conn->real_escape_string($dia);
    
        $sql = "INSERT INTO RESERVACION (EMAIL, NUMEROPERSONA, HORA, DIA) VALUES ('$email', '$numeroPersona', '$hora', '$dia')";
    
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerReservaciones() {
        $sql = "SELECT * FROM RESERVACION";
        $result = $this->conn->query($sql);

        $reservaciones = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reservaciones[] = $row;
            }
        }

        return $reservaciones;
    }

    public function obtenerReservacionPorId($id) {
        $sql = "SELECT * FROM RESERVACION WHERE ID = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function actualizarReservacion($id, $email, $numeroPersona, $hora, $dia) {
        $sql = "UPDATE RESERVACION SET EMAIL = '$email', NUMEROPERSONA = '$numeroPersona', HORA = '$hora', DIA = '$dia' WHERE ID = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al actualizar la reservación: " . $this->conn->error;
            return false;
        }
    }

    public function eliminarReservacion($id) {
        $sql = "DELETE FROM RESERVACION WHERE ID = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al eliminar la reservación: " . $this->conn->error;
            return false;
        }
    }
}

?>
