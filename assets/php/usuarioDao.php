<?php

require_once 'configuracionBD.php';

class usuarioDao {
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

    public function insertarUsuario($nombre, $apellidoM, $apellidoP, $contrasenia, $telefono, $correo, $ocupacion, $rol) {
        $nombre = $this->conn->real_escape_string($nombre);
        $apellidoM = $this->conn->real_escape_string($apellidoM);
        $apellidoP = $this->conn->real_escape_string($apellidoP);
        $contrasenia = $this->conn->real_escape_string($contrasenia);
        $telefono = $this->conn->real_escape_string($telefono);
        $correo = $this->conn->real_escape_string($correo);
        $ocupacion = $this->conn->real_escape_string($ocupacion);
        $rol = $this->conn->real_escape_string($rol);
    
        $sql = "INSERT INTO USUARIOS (NOMBRE, APELLIDOM, APELLIDOP, CONTRASENIA, TELEFONO, CORREO, OCUPACION, ROL) VALUES ('$nombre', '$apellidoM', '$apellidoP', '$contrasenia', '$telefono', '$correo', '$ocupacion', '$rol')";
    
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerUsuarios() {
        $sql = "SELECT * FROM USUARIOS";
        $result = $this->conn->query($sql);

        $usuarios = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }

        return $usuarios;
    }

    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT * FROM USUARIOS WHERE ID = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function actualizarUsuario($id, $nombre, $apellidoM, $apellidoP, $contrasenia, $telefono, $correo, $ocupacion, $rol) {
        $sql = "UPDATE USUARIOS SET NOMBRE = '$nombre', APELLIDOM = '$apellidoM', APELLIDOP = '$apellidoP', CONTRASENIA = '$contrasenia', TELEFONO = '$telefono', CORREO = '$correo', OCUPACION = '$ocupacion', ROL = '$rol' WHERE ID = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al actualizar el usuario: " . $this->conn->error;
            return false;
        }
    }

    public function eliminarUsuario($id) {
        $sql = "DELETE FROM USUARIOS WHERE ID = $id";
        
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error al eliminar el usuario: " . $this->conn->error;
            return false;
        }
    }
}
?>
