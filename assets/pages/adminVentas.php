<?php
require_once '../php/comprasDao.php';

// Crear una instancia de la clase DAOplatillos
$compraDao = new CompraDao();
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
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>PRECIO</th>
                                            <th>CANTIDAD</th>
                                            <th>PRECIO TOTAL</th>
                                            <th>FECHA</th>
                                            <th>NOMBRE</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>PRECIO</th>
                                            <th>CANTIDAD</th>
                                            <th>PRECIO TOTAL</th>
                                            <th>FECHA</th>
                                            <th>NOMBRE</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php

                                        $compras = $compraDao->obtenerCompras();
                                        foreach ($compras as $compra) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $compra['id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $compra['nombre']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $compra['precio']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $compra['cantidad']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $compra['precio_total']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $compra['fechaHora']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $compra['NOMBRE'] . " " . $compra['APELLIDOP']; ?>
                                                </td>
                                                
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class=" sticky-footer bg-white">
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
                <div class="modal-body">Select "Logout" below if you are ready to end your current
                    session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../php/cerrar_sesion.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para modificar compra -->
    <div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="modalModificarLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModificarLabel">Modificar Compra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario de modificación -->
                    <form id="formModificarCompra">
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
                        <input type="hidden" id="compraId" name="compraId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarModificacion">Guardar Cambios</button>
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
            // Función para manejar el evento click en el botón "Insertar Compra"
            $('#btnInsertar').click(function () {
                // Obtener los valores de los campos del formulario
                var nombre = document.getElementById("nombreInsert").value;
                var descripcion = document.getElementById("descripcionInsert").value;
                var precio = document.getElementById("precioInsert").value;
                var url = document.getElementById("urlInsert").value;

                // Realizar la inserción de la compra mediante una petición Ajax
                $.ajax({
                    url: 'ruta_del_script_de_insercion.php',
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
                            alert('Error al insertar la compra. Inténtalo de nuevo.');
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
                // Obtener el ID de la compra desde el atributo data-id del botón
                var compraID = $(this).data('id');

                // Obtener los datos de la compra mediante una petición Ajax
                $.ajax({
                    url: 'ruta_del_script_de_obtencion.php',
                    type: 'POST',
                    data: {
                        id: compraID
                    },
                    success: function (response) {
                        // Verificar la respuesta del servidor
                        if (response != 'error') {
                            // Parsear la respuesta como un objeto JSON
                            var compra = JSON.parse(response);

                            // Mostrar los datos de la compra en el formulario de modificación
                            $('#nombre').val(compra.nombre);
                            $('#descripcion').val(compra.descripcion);
                            $('#precio').val(compra.precio);
                            $('#url').val(compra.url);

                            // Establecer el ID de la compra en un campo oculto para enviarlo al guardar los cambios
                            $('#compraId').val(compra.id);

                            // Abrir el modal de modificación
                            $('#modalModificar').modal('show');
                        } else {
                            // Error al obtener los datos de la compra, mostrar mensaje de error
                            alert('Error al obtener los datos de la compra. Inténtalo de nuevo.');
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
                var compraID = $('#compraId').val();

                // Realizar la actualización de la compra mediante una petición Ajax
                $.ajax({
                    url: 'ruta_del_script_de_actualizacion.php',
                    type: 'POST',
                    data: {
                        id: compraID,
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
                            alert('Error al guardar los cambios de la compra. Inténtalo de nuevo.');
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
                // Obtener el ID de la compra desde el atributo data-id del botón
                var compraID = $(this).data('id');

                // Confirmar la eliminación de la compra
                if (confirm('¿Estás seguro de eliminar esta compra?')) {
                    // Realizar la eliminación mediante Ajax
                    $.ajax({
                        url: 'ruta_del_script_de_eliminacion.php',
                        type: 'POST',
                        data: {
                            id: compraID
                        },
                        success: function (response) {
                            // Verificar la respuesta del servidor
                            if (response == 'success') {
                                // Eliminación exitosa, recargar la página
                                location.reload();
                            } else {
                                // Error en la eliminación, mostrar mensaje de error
                                alert('Error al eliminar la compra. Inténtalo de nuevo.');
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

    $compraDao->desconectar();
    ?>

</body>

</html>