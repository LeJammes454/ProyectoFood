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

    public function getOfertasDiaComida()
    {
        // Agreagar funcion para obtener el dia en español lunes
        // $diaSemana
        $sql = "SELECT * FROM OFERTACOMIDA WHERE TIPO = 'COMIDA' AND DIA = 'lunes' LIMIT 3";
        $result = $this->conn->query($sql);

        $datos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = $row;
            }
        }

        return $datos;
    }

    public function getOfertasDiaJugos()
    {
        // Agreagar funcion para obtener el dia en español lunes
        // $diaSemana
        $sql = "SELECT * FROM OFERTACOMIDA WHERE TIPO = 'jugo' AND DIA = 'lunes' LIMIT 3";
        $result = $this->conn->query($sql);

        $datos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = $row;
            }
        }

        return $datos;
    }

    public function getResenas()
    {
        // Agreagar funcion para obtener el dia en español lunes
        // $diaSemana
        $sql = "SELECT * FROM OFERTACOMIDA WHERE TIPO = 'jugo' AND DIA = 'lunes' LIMIT 3";
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
        $ocupacion,
        $correo
    ) {
        // Verificar si el correo ya existe en la base de datos
        $sql_verificar = "SELECT * FROM USUARIOS WHERE CORREO = '$correo'";
        $result_verificar = $this->conn->query($sql_verificar);

        if ($result_verificar->num_rows > 0) {
            return false; // Error al registrar usuario
        } else {
            // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla
            $sql = "INSERT INTO USUARIOS (NOMBRE, APELLIDOM, APELLIDOP, CONTRASENIA, TELEFONO, OCUPACION, CORREO)
        VALUES ('$nombre', '$apellido_materno', '$apellido_paterno', '$contrasenia', '$numero_telefonico', '$ocupacion', '$correo')";

            if ($this->conn->query($sql) === TRUE) {
                return true; // Éxito al registrar usuario
            } else {
                return false; // Error al registrar usuario
            }
        }
    }

    public function loginVerificarCorreo($contrasenia, $correo)
    {

        $sql = "SELECT * FROM usuarios WHERE contrasenia = '$contrasenia' AND correo = '$correo';";
        $result_verificar = $this->conn->query($sql);

        if ($result_verificar->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getTodoMenu()
    {
        $sql = "SELECT ID,NOMBRE,PRECIO FROM MENU";
        $result = $this->conn->query($sql);

        $datos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = $row;
            }
        }

        return $datos;
    }
    public function eliminarPlato($id)
    {

        $sql = "DELETE FROM MENU WHERE ID = '$id'";

        if ($this->conn->query($sql) === TRUE) {
            return true; // Éxito al elimnar plato
        } else {
            return false; // Error al elimnar plato
        }
    }
    public function getPlatillo($id)
    {
        $sql = "SELECT * FROM MENU WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        // Verificar si se encontraron resultados
        if ($stmt->num_rows > 0) {
            // Obtener los datos del elemento como un arreglo asociativo
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Devolver los datos del elemento
            return $row;
        } else {
            // No se encontraron datos del elemento
            return null;
        }
    }
    public function getProductById($id)
    {
        $query = "SELECT nombre, precio FROM MENU WHERE ID = $id";
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }


    public function getMenu()
    {
        $sql = "SELECT * FROM MENU";
        $result = $this->conn->query($sql);

        $datos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = $row;
            }
        }

        return $datos;

    }

    public function ejecutarQuery($query)
    {
        $result = $this->conn->query($query);

        $datos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = $row;
            }
        }

        return $datos;
    }

    public function getReseniasmamalonas()
    {
        $sql = "SELECT NOMBRE, OCUPACION, RESENA FROM RESENIAS ORDER BY FECHA DESC";
        $result = $this->conn->query($sql);

        $datos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = $row;
            }
        }

        return $datos;
    }
    public function InsertarResenia($resena, $correo)
    {
        // Llamar al procedimiento almacenado
        $sql = "CALL InsertarResenia('$correo', '$resena')";

        if ($this->conn->query($sql) === true) {
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