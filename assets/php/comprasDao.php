<?php

require_once 'configuracionBD.php';

class CompraDao {
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

    public function insertarCompra($usuarioId, $nombre, $precio, $cantidad, $precioTotal, $fechaHora) {
        $usuarioId = $this->conn->real_escape_string($usuarioId);
        $nombre = $this->conn->real_escape_string($nombre);
        $precio = $this->conn->real_escape_string($precio);
        $cantidad = $this->conn->real_escape_string($cantidad);
        $precioTotal = $this->conn->real_escape_string($precioTotal);
        $fechaHora = $this->conn->real_escape_string($fechaHora);
    
        $sql = "INSERT INTO COMPRAS (usuario_id, nombre, precio, cantidad, precio_total, fechaHora) VALUES ('$usuarioId', '$nombre', '$precio', '$cantidad', '$precioTotal', '$fechaHora')";
    
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerCompras() {
        $sql = "SELECT COMPRAS.*, USUARIOS.NOMBRE, USUARIOS.APELLIDOP FROM COMPRAS INNER JOIN USUARIOS ON COMPRAS.usuario_id = USUARIOS.ID";
        $result = $this->conn->query($sql);

        $compras = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $compras[] = $row;
            }
        }

        return $compras;
    }

    public function obtenerCompraPorId($id) {
        $sql = "SELECT COMPRAS.*, USUARIOS.NOMBRE, USUARIOS.APELLIDOP FROM COMPRAS INNER JOIN USUARIOS ON COMPRAS.usuario_id = USUARIOS.ID WHERE COMPRAS.id = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function actualizarCompra($id, $usuarioId, $nombre, $precio, $cantidad, $precioTotal, $fechaHora) {
        $sql = "UPDATE COMPRAS SET usuario_id = '$usuarioId', nombre = '$nombre', precio = '$precio', cantidad = '$cantidad', precio_total = '$precioTotal', fechaHora = '$fechaHora' WHERE id = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al actualizar la compra: " . $this->conn->error;
            return false;
        }
    }

    public function eliminarCompra($id) {
        $sql = "DELETE FROM COMPRAS WHERE id = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al eliminar la compra: " . $this->conn->error;
            return false;
        }
    }
}
?>
