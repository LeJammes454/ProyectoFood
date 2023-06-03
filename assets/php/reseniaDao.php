<?php

require_once 'configuracionBD.php';

class ReseniaDao
{
    private $conn;

    public function __construct()
    {
        global $servername, $username, $password, $dbname;
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function desconectar()
    {
        $this->conn->close();
    }

    public function insertarResenia($nombre, $ocupacion, $resena, $correo, $fecha)
    {
        $nombre = $this->conn->real_escape_string($nombre);
        $ocupacion = $this->conn->real_escape_string($ocupacion);
        $resena = $this->conn->real_escape_string($resena);
        $correo = $this->conn->real_escape_string($correo);
        $fecha = $this->conn->real_escape_string($fecha);

        $sql = "INSERT INTO RESENIAS (NOMBRE, OCUPACION, RESENA, CORREO, FECHA) VALUES ('$nombre', '$ocupacion', '$resena', '$correo', '$fecha')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerResenias()
    {
        $sql = "SELECT * FROM RESENIAS";
        $result = $this->conn->query($sql);

        $resenias = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resenias[] = $row;
            }
        }

        return $resenias;
    }

    public function obtenerReseniaPorId($id)
    {
        $sql = "SELECT * FROM RESENIAS WHERE ID = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function actualizarResenia($id, $nombre, $ocupacion, $resena, $correo, $fecha)
    {
        $sql = "UPDATE RESENIAS SET NOMBRE = '$nombre', OCUPACION = '$ocupacion', RESENA = '$resena', CORREO = '$correo', FECHA = '$fecha' WHERE ID = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al actualizar la reseña: " . $this->conn->error;
            return false;
        }
    }

    public function eliminarResenia($id)
    {
        $sql = "DELETE FROM RESENIAS WHERE ID = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al eliminar la reseña: " . $this->conn->error;
            return false;
        }
    }
    public function actualizarVisibilidadResenia($id, $visibilidad)
    {
        $sql = "UPDATE RESENIAS SET VISIBLE = $visibilidad WHERE ID = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al actualizar la visibilidad de la reseña: " . $this->conn->error;
            return false;
        }
    }
}
?>