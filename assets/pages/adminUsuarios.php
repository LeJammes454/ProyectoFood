<?php
require_once '../php/usuarioDao.php';

// Crear una instancia de usuarioDao
$usuarioDao = new usuarioDao();
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
    <title>Admin - Usuarios</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Tabla Usuarios</h1>
                    <p class="mb-4">En estq tabla estaan todos los plantillos</p>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos de los usuarios</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-success" data-toggle="modal"
                                        data-target="#modalInsertar">Insertar Usuario</button>
                                </div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Telefono</th>
                                            <th>Correo</th>
                                            <th>Ocupacion</th>
                                            <th>Rol</th>
                                            <th>Acciones</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Telefono</th>
                                            <th>Correo</th>
                                            <th>Ocupacion</th>
                                            <th>Rol</th>
                                            <th>Acciones</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php


                                        // Obtener la lista de usuarios
                                        $usuarios = $usuarioDao->obtenerUsuarios();

                                        foreach ($usuarios as $usuario) {
                                            echo "<tr>";
                                            echo "<td>" . $usuario['ID'] . "</td>";
                                            echo "<td>" . $usuario['NOMBRE'] . "</td>";
                                            echo "<td>" . $usuario['APELLIDOM'] . " " . $usuario['APELLIDOP'] . "</td>";
                                            echo "<td>" . $usuario['TELEFONO'] . "</td>";
                                            echo "<td>" . $usuario['CORREO'] . "</td>";
                                            echo "<td>" . $usuario['OCUPACION'] . "</td>";
                                            echo "<td>" . $usuario['ROL'] . "</td>";
                                            echo "<td><button class='btn btn-primary btn-modificar' data-id='" . $usuario['ID'] . "' data-toggle='modal' data-target='#modalModificar'>Modificar</button></td>";
                                            echo "<td><button class='btn btn-danger btn-eliminar' data-id='" . $usuario['ID'] . "'>Eliminar</button></td>";
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

    <!-- Modal para modificar usuario -->
    <div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="modalModificarLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModificarLabel">Modificar Usuario</h5>
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
                            <label for="apellidoM">Apellido Materno</label>
                            <input type="text" class="form-control" id="apellidoM" name="apellidoM">
                        </div>
                        <div class="form-group">
                            <label for="apellidoP">Apellido Paterno</label>
                            <input type="text" class="form-control" id="apellidoP" name="apellidoP">
                        </div>
                        <div class="form-group">
                            <label for="contrasenia">Contraseña</label>
                            <input type="password" class="form-control" id="contrasenia" name="contrasenia">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo">
                        </div>
                        <div class="form-group">
                            <label for="ocupacion">Ocupación</label>
                            <input type="text" class="form-control" id="ocupacion" name="ocupacion">
                        </div>
                        <div class="form-group">
                            <label class="input-group-text" for="rol">Rol</label>
                            <select class="form-control" id="rol" name="rol" required>
                                <option selected>Choose...</option>
                                <option value="usuario">usuario</option>
                                <option value="admin">admin</option>
                            </select>
                        </div>
                        <input type="hidden" id="usuarioId" name="usuarioId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarModificacion">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para insertar usuario -->
    <div class="modal fade" id="modalInsertar" tabindex="-1" role="dialog" aria-labelledby="modalInsertarLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInsertarLabel">Insertar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del formulario de inserción -->
                    <form id="formInsertarUsuario">
                        <!-- Campos del formulario -->
                        <div class="form-group">
                            <label for="nombreInsert">Nombre</label>
                            <input type="text" class="form-control" id="nombreInsert" name="nombreInsert" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidoPInsert">Apellido Paterno</label>
                            <input type="text" class="form-control" id="apellidoPInsert" name="apellidoPInsert"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="apellidoMInsert">Apellido Materno</label>
                            <input type="text" class="form-control" id="apellidoMInsert" name="apellidoMInsert"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="contraseniaInsert">Contraseña</label>
                            <input type="password" class="form-control" id="contraseniaInsert" name="contraseniaInsert"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="telefonoInsert">Teléfono</label>
                            <input type="text" class="form-control" id="telefonoInsert" name="telefonoInsert" required>
                        </div>
                        <div class="form-group">
                            <label for="correoInsert">Correo</label>
                            <input type="email" class="form-control" id="correoInsert" name="correoInsert" required>
                        </div>
                        <div class="form-group">
                            <label for="ocupacionInsert">Ocupación</label>
                            <input type="text" class="form-control" id="ocupacionInsert" name="ocupacionInsert"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="input-group-text" for="rolInsert">Rol</label>
                            <select class="form-control" id="rolInsert" name="rolInsert" required>
                                <option selected>Choose...</option>
                                <option value="usuario">usuario</option>
                                <option value="admin">admin</option>
                            </select>
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


            // Agregar un evento de clic al botón
            btnInsertar.addEventListener('click', function () {
                // Obtener los valores de los campos del formulario
                var nombre = document.getElementById('nombreInsert').value;
                var apellidoPaterno = document.getElementById('apellidoPInsert').value;
                var apellidoMaterno = document.getElementById('apellidoMInsert').value;
                var contraseña = document.getElementById('contraseniaInsert').value;
                var telefono = document.getElementById('telefonoInsert').value;
                var correo = document.getElementById('correoInsert').value;
                var ocupacion = document.getElementById('ocupacionInsert').value;
                var rol = document.getElementById('rolInsert').value;

                $.ajax({
                    url: '../php/usuarios/insertar_usuario.php',
                    type: 'POST',
                    data: {
                        nombre: nombre,
                        apellidoM: apellidoM,
                        apellidoP: apellidoP,
                        contrasenia: contrasenia,
                        telefono: telefono,
                        correo: correo,
                        ocupacion: ocupacion,
                        rol: rol
                    },
                    success: function (response) {
                        // Verificar la respuesta del servidor
                        if (response == 'success') {
                            // Inserción exitosa, cerrar el modal y recargar la página
                            $('#modalInsertar').modal('hide');
                            location.reload();
                        } else {
                            // Error en la inserción, mostrar mensaje de error
                            alert('Error al insertar el usuario. Inténtalo de nuevo.');
                        }
                    },
                    error: function () {
                        // Error en la petición Ajax, mostrar mensaje de error
                        alert('Error en la petición. Inténtalo de nuevo.');
                    }
                });
            });



            // Función para manejar el evento click en el botón "Insertar Usuario"
            $('#btnInsertar').click(function () {
                // Obtener los valores de los campos del formulario
                var nombre = $('#nombreInsert').val();
                var apellidoM = $('#apellidoMInsert').val();
                var apellidoP = $('#apellidoPInsert').val();
                var contrasenia = $('#contraseniaInsert').val();
                var telefono = $('#telefonoInsert').val();
                var correo = $('#correoInsert').val();
                var ocupacion = $('#ocupacionInsert').val();
                var rol = $('#rolInsert').val();

                alert(apellidoP)
                alerto(apellidoM)
                // Realizar la inserción del usuario mediante una petición Ajax

            });

            // Función para manejar el evento click en el botón Modificar
            $('.btn-modificar').click(function () {
                // Obtener el ID del usuario desde el atributo data-id del botón
                var usuarioID = $(this).data('id');

                // Obtener los datos del usuario mediante una petición Ajax
                $.ajax({
                    url: '../php/usuarios/leer_usuario.php',
                    type: 'POST',
                    data: { id: usuarioID },
                    success: function (response) {
                        // Verificar la respuesta del servidor
                        if (response != 'error') {
                            // Parsear la respuesta como un objeto JSON
                            var usuario = JSON.parse(response);

                            // Mostrar los datos del usuario en el formulario de modificación
                            $('#nombre').val(usuario.NOMBRE);
                            $('#apellidoM').val(usuario.APELLIDOM);
                            $('#apellidoP').val(usuario.APELLIDOP);
                            $('#contrasenia').val(usuario.CONTRASENIA);
                            $('#telefono').val(usuario.TELEFONO);
                            $('#correo').val(usuario.CORREO);
                            $('#ocupacion').val(usuario.OCUPACION);
                            $('#rol').val(usuario.ROL);

                            // Establecer el ID del usuario en un campo oculto para enviarlo al guardar los cambios
                            $('#usuarioId').val(usuario.ID);

                            // Abrir el modal de modificación
                            $('#modalModificar').modal('show');
                        } else {
                            // Error al obtener los datos del usuario, mostrar mensaje de error
                            alert('Error al obtener los datos del usuario. Inténtalo de nuevo.');
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
                var apellidoM = $('#apellidoM').val();
                var apellidoP = $('#apellidoP').val();
                var contrasenia = $('#contrasenia').val();
                var telefono = $('#telefono').val();
                var correo = $('#correo').val();
                var ocupacion = $('#ocupacion').val();
                var rol = $('#rol').val();
                var usuarioID = $('#usuarioId').val();

                // Realizar la actualización del usuario mediante una petición Ajax
                $.ajax({
                    url: '../php/usuarios/actualizar_usuario.php',
                    type: 'POST',
                    data: {
                        id: usuarioID,
                        nombre: nombre,
                        apellidoM: apellidoM,
                        apellidoP: apellidoP,
                        contrasenia: contrasenia,
                        telefono: telefono,
                        correo: correo,
                        ocupacion: ocupacion,
                        rol: rol
                    },
                    success: function (response) {
                        // Verificar la respuesta del servidor
                        if (response == 'success') {
                            // Actualización exitosa, cerrar el modal y recargar la página
                            $('#modalModificar').modal('hide');
                            location.reload();
                        } else {
                            // Error en la actualización, mostrar mensaje de error
                            alert('Error al guardar los cambios del usuario. Inténtalo de nuevo.');
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
                // Obtener el ID del usuario desde el atributo data-id del botón
                var usuarioID = $(this).data('id');

                // Confirmar la eliminación del usuario
                if (confirm('¿Estás seguro de eliminar este usuario?')) {
                    // Realizar la eliminación mediante Ajax
                    $.ajax({
                        url: '../php/usuarios/eliminar_Usuario.php',
                        type: 'POST',
                        data: { id: usuarioID },
                        success: function (response) {
                            // Verificar la respuesta del servidor
                            if (response == 'success') {
                                // Eliminación exitosa, recargar la página
                                location.reload();
                            } else {
                                // Error en la eliminación, mostrar mensaje de error
                                alert('Error al eliminar el usuario. Inténtalo de nuevo.');
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
    $usuarioDao->desconectar();
    ?>

</body>

</html>