<?php
require_once '../php/menuDao.php';

// Crear una instancia de la clase DAOplatillos
$daoPlatillos = new menuDao();

// Obtener los platillos
$platillos = $daoPlatillos->obtenerPlatillos();

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


// Verificar el rol del usuario
if (isset($_SESSION['rol']) && $_SESSION['rol'] !== 'admin') {
    // El usuario no tiene el rol de 'admin', redirigir a otra página o mostrar un mensaje de error
    header("Location: ../../index.php");
    exit();
}
// Resto del código
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin - Menu</title>
    <link href="../vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item active">
                <a class="nav-link" href="adminMenu.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Menu</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="adminResenias.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Reseñas</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="adminVentas.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Ventas</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="adminUsuarios.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Usuarios</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="adminReservas.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Reservaciones</span></a>
            </li>
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?php 
                                echo $sesionNombre;
                                ?>
                                </span>
                                <img class="img-profile rounded-circle" src="#">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../../index.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Inicio
                                </a>
                                <a class="dropdown-item" href="menu.php">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Menu
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Tabla Menu</h1>
                    <p class="mb-4">En estq tabla estaan todos los plantillos</p>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos del menu</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-success" data-toggle="modal"
                                        data-target="#modalInsertar">Insertar Platillo</button>
                                </div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBER</th>
                                            <th>DESCRIPCION</th>
                                            <th>PRECIO</th>
                                            <th>URL IMG</th>
                                            <th>ACCIONES</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBER</th>
                                            <th>DESCRIPCION</th>
                                            <th>PRECIO</th>
                                            <th>URL IMG</th>
                                            <th>ACCIONES</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $platillos = $daoPlatillos->obtenerPlatillos();

                                        foreach ($platillos as $platillo) {
                                            echo "<tr>";
                                            echo "<td>" . $platillo['ID'] . "</td>";
                                            echo "<td>" . $platillo['NOMBRE'] . "</td>";
                                            echo "<td>" . $platillo['DESCRIPCION'] . "</td>";
                                            echo "<td>" . $platillo['PRECIO'] . "</td>";
                                            echo "<td>" . $null . "</td>";
                                            echo "<td><button class='btn btn-primary btn-modificar' data-id='" . $platillo['ID'] . "' data-toggle='modal' data-target='#modalModificar'>Modificar</button></td>";
                                            echo "<td><button class='btn btn-danger btn-eliminar' data-id='" . $platillo['ID'] . "'>Eliminar</button></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <p class="mb-0 py-3 text-muted small">&copy; Copyright
                            <script>
                                document.write(new Date().getFullYear())
                            </script> hecho por <i class="ti-heart text-danger"></i> Tacos <a
                                href="https://youtu.be/mCdA4bJAGGk">ITSUR</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal Cerrar sesion-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../php/cerrar_sesion.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para modificar platillo -->
    <div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="modalModificarLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModificarLabel">Modificar Platillo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario de modificación -->
                    <form id="formModificar">
                        <!-- Campos del formulario -->
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control" id="precio" name="precio">
                        </div>
                        <div class="form-group">
                            <label for="url">URL IMG</label>
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                        <input type="hidden" id="platilloId" name="platilloId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarModificacion">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para insertar platillo -->
    <div class="modal fade" id="modalInsertar" tabindex="-1" role="dialog" aria-labelledby="modalInsertarLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInsertarLabel">Insertar Platillo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario de inserción -->
                    <form id="formInsertarPlatillo">
                        <!-- Campos del formulario -->
                        <div class="form-group">
                            <label for="nombreInsert">Nombre</label>
                            <input type="text" class="form-control" id="nombreInsert" name="nombreInsert">
                        </div>
                        <div class="form-group">
                            <label for="descripcionInsert">Descripción</label>
                            <textarea class="form-control" id="descripcionInsert" name="descripcionInsert"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precioInsert">Precio</label>
                            <input type="text" class="form-control" id="precioInsert" name="precioInsert">
                        </div>
                        <div class="form-group">
                            <label for="urlInsert">URL IMG</label>
                            <input type="text" class="form-control" id="urlInsert" name="urlInsert">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnInsertar">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../vendors/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendors/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Resto del código HTML y JavaScript -->
    <script>
        $(document).ready(function () {
            // Función para manejar el evento click en el botón "Insertar Platillo"
            $('#btnInsertar').click(function () {
                // Obtener los valores de los campos del formulario
                var nombre = document.getElementById("nombreInsert").value;
                var descripcion = document.getElementById("descripcionInsert").value;
                var precio = document.getElementById("precioInsert").value;
                var url = document.getElementById("urlInsert").value;

                // Realizar la inserción del platillo mediante una petición Ajax
                $.ajax({
                    url: '../php/insertar_platillo.php',
                    type: 'POST',
                    data: {
                        nombre: nombre,
                        descripcion: descripcion,
                        precio: precio,
                        url: url
                    },
                    success: function (response) {
                        // Verificar la respuesta del servidor
                        if (response == 'success') {
                            // Inserción exitosa, cerrar el modal y recargar la página
                            $('#modalInsertar').modal('hide');
                            location.reload();
                        } else {
                            // Error en la inserción, mostrar mensaje de error
                            alert('Error al insertar el platillo. Inténtalo de nuevo.');
                        }
                    },
                    error: function () {
                        // Error en la petición Ajax, mostrar mensaje de error
                        alert('Error en la petición. Inténtalo de nuevo.');
                    }
                });
            });

            // Función para manejar el evento click en el botón Modificar
            $('.btn-modificar').click(function () {
                // Obtener el ID del platillo desde el atributo data-id del botón
                var platilloID = $(this).data('id');

                // Obtener los datos del platillo mediante una petición Ajax
                $.ajax({
                    url: '../php/obtenerPlatilloDao.php',
                    type: 'POST',
                    data: { id: platilloID },
                    success: function (response) {
                        // Verificar la respuesta del servidor
                        if (response != 'error') {
                            // Parsear la respuesta como un objeto JSON
                            var platillo = JSON.parse(response);

                            // Mostrar los datos del platillo en el formulario de modificación
                            $('#nombre').val(platillo.NOMBRE);
                            $('#descripcion').val(platillo.DESCRIPCION);
                            $('#precio').val(platillo.PRECIO);
                            $('#url').val(platillo.URL);

                            // Establecer el ID del platillo en un campo oculto para enviarlo al guardar los cambios
                            $('#platilloId').val(platillo.ID);

                            // Abrir el modal de modificación
                            $('#modalModificar').modal('show');
                        } else {
                            // Error al obtener los datos del platillo, mostrar mensaje de error
                            alert('Error al obtener los datos del platillo. Inténtalo de nuevo.');
                        }
                    },
                    error: function () {
                        // Error en la petición Ajax, mostrar mensaje de error
                        alert('Error en la petición. Inténtalo de nuevo.');
                    }
                });
            });
            // Función para manejar el evento click en el botón "Guardar Cambios"
            $('#btnGuardarModificacion').click(function () {
                // Obtener los valores del formulario de modificación
                var nombre = $('#nombre').val();
                var descripcion = $('#descripcion').val();
                var precio = $('#precio').val();
                var url = $('#url').val();
                var platilloID = $('#platilloId').val();

                // Realizar la actualización del platillo mediante una petición Ajax
                $.ajax({
                    url: '../php/actualizar_platillo.php',
                    type: 'POST',
                    data: {
                        id: platilloID,
                        nombre: nombre,
                        descripcion: descripcion,
                        precio: precio,
                        url: url
                    },
                    success: function (response) {
                        // Verificar la respuesta del servidor
                        if (response == 'success') {
                            // Actualización exitosa, cerrar el modal y recargar la página
                            $('#modalModificar').modal('hide');
                            location.reload();
                        } else {
                            // Error en la actualización, mostrar mensaje de error
                            alert('Error al guardar los cambios del platillo. Inténtalo de nuevo.');
                        }
                    },
                    error: function () {
                        // Error en la petición Ajax, mostrar mensaje de error
                        alert('Error en la petición. Inténtalo de nuevo.');
                    }
                });
            });

            // Función para manejar el evento click en el botón Eliminar
            $('.btn-eliminar').click(function () {
                // Obtener el ID del platillo desde el atributo data-id del botón
                var platilloID = $(this).data('id');

                // Confirmar la eliminación del platillo
                if (confirm('¿Estás seguro de eliminar este platillo?')) {
                    // Realizar la eliminación mediante Ajax
                    $.ajax({
                        url: '../php/eliminar_platillo.php',
                        type: 'POST',
                        data: { id: platilloID },
                        success: function (response) {
                            // Verificar la respuesta del servidor
                            if (response == 'success') {
                                // Eliminación exitosa, recargar la página
                                location.reload();
                            } else {
                                // Error en la eliminación, mostrar mensaje de error
                                alert('Error al eliminar el platillo. Inténtalo de nuevo.');
                            }
                        },
                        error: function () {
                            // Error en la petición Ajax, mostrar mensaje de error
                            alert('Error en la petición. Inténtalo de nuevo.');
                        }
                    });
                }
            });
        });
    </script>

    <?php
    $daoPlatillos->desconectar();
    ?>

</body>

</html>