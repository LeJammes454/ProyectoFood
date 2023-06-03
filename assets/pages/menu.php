<?php
require_once '../php/coneccionBD.php';
// Incluir la función session_start() al comienzo del archivo
session_start();
// Verificar si la sesión está iniciada
$sesionIniciada = isset($_SESSION["correo"]);
$sesionRol = isset($_SESSION["rol"]);
$sesionNombre = isset($_SESSION["nombre"]);

// Verificar si la variable de sesión está establecida
if (!isset($_SESSION['correo'])) {
    // La sesión no está activa, redirigir al formulario de inicio de sesión o a otra página
    header("Location: ../../index.php");
    exit(); // Detener la ejecución del resto del código
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Menu - La mesa de los Sabores</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body class="dark-mode">
    <!-- Navegacion-->
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark " data-bs-theme="dark">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../../index.php">La Mesa de los Sabores</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                </ul>
                <form class="d-flex">
                    <button type="button" id="carritomamalonv2" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#carritomodal">
                        <i class="bi-cart-fill me-1"></i>
                        Carrito
                    </button>

                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small dark-mode">

                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#pedidosModal">Mis
                                compras</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#historialModal">Mis reseñas</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#reservacionModal">Mis reservaciones</a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($_SESSION['rol'] === 'admin') {
                                echo '<a class="dropdown-item" href="admin.php">Administracion</a>';
                            } ?>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../php/cerrar_sesion.php">Cerrar Sesion</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Bienvenida-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">¡Bienvenidos a La Mesa de los Sabores!</h1>
                <p class="lead fw-normal text-white-50 mb-0">Nuestro menú ha sido creado con pasión y dedicación,
                    combinando los
                    mejores ingredientes frescos de temporada con técnicas culinarias innovadoras. Desde platos clásicos
                    reinventados hasta creaciones contemporáneas, cada bocado es un homenaje a la diversidad y la
                    calidad.</p>
            </div>
        </div>
    </header>
    <!-- Cuerpo -->
    <section class="bg-dark py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php
                $database = new Database();
                $menuItems = $database->getMenu();


                if (!empty($menuItems)) {
                    foreach ($menuItems as $item) {
                        $id = $item["ID"];
                        $url = $item["URL"];
                        $nombre = $item["NOMBRE"];
                        $descripcion = $item["DESCRIPCION"];
                        $precio = $item["PRECIO"];
                        // Generar la tarjeta de menú con los datos obtenidos
                        echo '<div class="col mb-5 ">
                         <div class="card text-bg-dark border-warning text-bg-secondary h-100">
                            <!-- Imagen del Producto-->
                            <img class="card-img-top" src="' . $url . '" alt="..." />
                            <!-- Detalles del Producto-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Nombre del Producto-->
                                    <h5 class="fw-bolder">' . $nombre . '</h5>
                                    <!-- Descripcion del Producto-->
                                    <p>' . $descripcion . '</p>
                                    <!-- Precio del Producto -->
                                    ' . $precio . '
                                </div>
                            </div>
                            <div class="space-between">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <button class="btn btn-outline-danger quantity-buttons decreaseButton" data-action="decrease">-</button>
                                        </div>
                                        <div class="col-auto">
                                            <h4 class="text-center quantity">1</h4>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-outline-info quantity-buttons increaseButton" data-action="increase">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <!-- Boton del Producto-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                <a class="btn btn btn-outline-warning mt-auto purchaseButton" href="#" data-id="' . $id . '">Comprar</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    echo "No se encontraron elementos en el menú.";
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-3 my-4 ">
        <div class=" text-center border-top wow fadeIn">
            <p class="text-center text-white text-muted small">&copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> hecho por <i class="ti-heart text-danger"></i> Tacos <a
                    href="https://youtu.be/mCdA4bJAGGk">ITSUR</a>
            </p>
        </div>
    </footer>

    <!-- Modal de Carrito de Compras -->
    <div class="modal fade" id="carritomodal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Precio Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="cartTableBody"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="realizarPedidoBtn">Realizar Pedido</button>
                </div>
            </div>
        </div>
    </div>
    <?php

    $correoUsuario = $_SESSION['correo'];
    $database = new Database();
    $menuItems = $database->getMenu();

    if (!empty($menuItems)) {
        foreach ($menuItems as $item) {
            $id = $item["ID"];
            $url = $item["URL"];
            $nombre = $item["NOMBRE"];
            $descripcion = $item["DESCRIPCION"];
            $precio = $item["PRECIO"];
        }
    }

    ?>
    <!-- Modal de resenias -->
    <div class="modal fade bg-dark" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg bg-dark">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="historialModalLabel">Reseñas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <?php

                        $database = new Database();
                        // Crear la conexión
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("La conexión falló: " . $conn->connect_error);
                        }

                        // Obtener el correo de búsqueda
                        $correo = $_SESSION['correo'];

                        // Construir la consulta SQL
                        $sql = "SELECT nombre, apellidom, apellidop, ocupacion FROM USUARIOS WHERE correo = '$correo'";

                        // Ejecutar la consulta
                        $result = $conn->query($sql);

                        // Verificar si se encontraron resultados
                        if ($result->num_rows == 1) {
                            // Obtener el registro
                            $row = $result->fetch_assoc();

                            // Acceder a los datos
                            $nombre = $row["nombre"];
                            $apellidom = $row["apellidom"];
                            $apellidop = $row["apellidop"];
                            $ocupacion = $row["ocupacion"];

                        } else {
                            echo "No se encontró el registro o se encontraron múltiples registros.";
                        }
                        ?>
                        <form class="form_resenia" id="formResenia">
                            <div class="row">
                                <?php echo '
                                <div class="col-md-6 mb-3">
                                    <label for="inputEmail" class="form-label">Correo</label>
                                    <input type="text" readonly class="form-control" id="inputEmail"
                                        value="' . $correoUsuario . '">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="inputName" class="form-label">Nombre</label>
                                    <input type="text" readonly class="form-control" id="inputName"
                                        value="' . $nombre . " " . $apellidop . " " . $apellidom . '">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="inputOcupacion" class="form-label">Ocupacion</label>
                                <input type="text" readonly class="form-control" id="ocupacion"
                                    value="' . $ocupacion . '">
                            </div>' ?>

                                <div class="mb-3">
                                    <label for="resenia" class="form-label">Reseña</label>
                                    <textarea class="form-control" id="resenia" name="resenia" rows="3"></textarea>
                                </div>

                                <button type="button" class="btn btn-primary" onclick="enviarResenia()">Enviar
                                    Reseña</button>
                        </form>

                        <h2>Mis Reseñas</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Reseña</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT id, fecha, resena FROM RESENIAS WHERE correo = '$correo'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row["id"];
                                        $fecha = $row["fecha"];
                                        $resena = $row["resena"];
                                        echo '<tr>
                                                <td>' . $fecha . '</td>
                                                <td>' . $resena . '</td>
                                                <td><button class="btn btn-outline-danger" data-id="' . $id . '" onclick="eliminarResena(this)">Eliminar reseña</button></td>
                                            </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="3">No se encontraron reseñas.</td></tr>';
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>

                        <script>
                            function eliminarResena(button) {
                                var id = button.getAttribute("data-id");

                                // Confirmar si el usuario realmente desea eliminar la reseña
                                if (confirm("¿Estás seguro de que quieres eliminar esta reseña?")) {
                                    // Enviar la solicitud AJAX al servidor
                                    $.ajax({
                                        url: "../php/eliminar_resenia.php", // Ruta al archivo PHP que manejará la solicitud
                                        method: "POST",
                                        data: { idResena: id }, // Enviar el ID de la reseña al servidor
                                        success: function (response) {
                                            alert(response); // Mostrar el mensaje de respuesta del servidor
                                            // Aquí puedes realizar cualquier acción adicional después de eliminar la reseña
                                            window.location.reload();
                                        },
                                        error: function () {
                                            alert("Error al eliminar la reseña");
                                        }
                                    });
                                }
                            }
                        </script>

                    </div>
                    <script>
                        function enviarResenia() {
                            var resenia = $("#resenia").val();

                            $.ajax({
                                url: "../php/insertarResenia.php",
                                method: "POST",
                                data: { resenia: resenia },
                                success: function (response) {
                                    // Manejar la respuesta del servidor si es necesario
                                    alert(response);
                                    window.location.reload(); // Recargar la página completa

                                },
                                error: function (xhr, status, error) {
                                    // Manejar el error en caso de que la petición no se haya realizado correctamente
                                }
                            });
                        }

                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de compras -->
    <div class="modal fade" id="pedidosModal" tabindex="-1" aria-labelledby="pedidosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pedidosModalLabel">Pedidos Realizados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php


                // Establecer la conexión a la base de datos utilizando mysqli
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Error en la conexión a la base de datos: " . $conn->connect_error);
                }

                // Obtener los datos de compras
                $compras = array();

                $sql = "SELECT c.nombre, c.precio, c.cantidad, c.precio_total, c.fechaHora
                FROM COMPRAS c
                JOIN USUARIOS u ON c.usuario_id = u.ID
                WHERE u.CORREO = '$correo';";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Iterar sobre los resultados y almacenarlos en el array de compras
                    while ($row = $result->fetch_assoc()) {
                        $compras[] = $row;
                    }
                }

                // Cerrar la conexión
                $conn->close();
                ?>

                <div class="modal-body">
                    <div class="container">
                        <div class="search-container">
                            <input type="text" id="searchInput" placeholder="Buscar por nombre del platillo...">
                        </div>

                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Nombre platillo</th>
                                    <th>Precio U.</th>
                                    <th>Cantidad</th>
                                    <th>Precio T.</th>
                                    <th>Fecha de la compra</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Mostrar los datos de compras en el contenedor
                                foreach ($compras as $compra) {
                                    $nombre = $compra['nombre'];
                                    $precio = $compra['precio'];
                                    $cantidad = $compra['cantidad'];
                                    $precioTotal = $compra['precio_total'];
                                    $fechaHora = $compra['fechaHora'];

                                    echo '<tr>';
                                    echo '<td>' . $nombre . '</td>';
                                    echo '<td>' . $precio . '</td>';
                                    echo '<td>' . $cantidad . '</td>';
                                    echo '<td>' . $precioTotal . '</td>';
                                    echo '<td>' . $fechaHora . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                        <script>
                            // Obtener el elemento de entrada de búsqueda
                            var input = document.getElementById("searchInput");

                            // Agregar un evento de escucha para detectar cambios en la entrada de búsqueda
                            input.addEventListener("input", function () {
                                // Obtener el valor de búsqueda
                                var filter = input.value.toUpperCase();

                                // Obtener la tabla y las filas de la tabla
                                var table = document.getElementById("dataTable");
                                var rows = table.getElementsByTagName("tr");

                                // Iterar sobre las filas de la tabla y mostrar u ocultar según el filtro de búsqueda
                                for (var i = 0; i < rows.length; i++) {
                                    var row = rows[i];
                                    var cells = row.getElementsByTagName("td");
                                    var match = false;

                                    for (var j = 0; j < cells.length; j++) {
                                        var cell = cells[j];
                                        if (cell) {
                                            var cellText = cell.textContent || cell.innerText;
                                            if (cellText.toUpperCase().indexOf(filter) > -1) {
                                                match = true;
                                                break;
                                            }
                                        }
                                    }

                                    if (match) {
                                        row.style.display = "";
                                    } else {
                                        row.style.display = "none";
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de "Platillo agregado" -->
    <div class="modal fade" id="addedModal" tabindex="-1" aria-labelledby="addedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p>Platillo agregado</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de reservaciones-->
    <div class="modal fade" id="reservacionModal" tabindex="-1" aria-labelledby="reservacionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="reservacionModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scrip JS  -->
    <script src="../js/scripMenu.js"></script>
</body>

</html>