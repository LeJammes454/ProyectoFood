<?php

require_once 'configuracionBD.php';

class menuDao {
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

    public function insertarPlatillo($nombre, $descripcion, $precio, $url) {
        $nombre = $this->conn->real_escape_string($nombre);
        $descripcion = $this->conn->real_escape_string($descripcion);
        $precio = $this->conn->real_escape_string($precio);
        $url = $this->conn->real_escape_string($url);
    
        $sql = "INSERT INTO MENU (NOMBRE, DESCRIPCION, PRECIO, URL) VALUES ('$nombre', '$descripcion', '$precio', '$url')";
    
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    

    public function obtenerPlatillos() {
        $sql = "SELECT * FROM MENU";
        $result = $this->conn->query($sql);

        $platillos = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $platillos[] = $row;
            }
        }

        return $platillos;
    }

    public function obtenerPlatilloPorId($id) {
        $sql = "SELECT * FROM MENU WHERE ID = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function actualizarPlatillo($id, $nombre, $descripcion, $precio, $url) {
        $sql = "UPDATE MENU SET NOMBRE = '$nombre', DESCRIPCION = '$descripcion', PRECIO = '$precio', URL = '$url' WHERE ID = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al actualizar el platillo: " . $this->conn->error;
            return false;
        }
    }

    public function eliminarPlatillo($id) {
        $sql = "DELETE FROM MENU WHERE ID = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al eliminar el platillo: " . $this->conn->error;
            return false;
        }
    }
}
?>