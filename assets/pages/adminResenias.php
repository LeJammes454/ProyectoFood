<?php
require_once '../php/reseniaDao.php';

// Crear una instancia del objeto ReseniaDao
$reseniaDao = new ReseniaDao();

// Obtener las reseñas desde la base de datos
$resenias = $reseniaDao->obtenerResenias();

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
    <title>Admin - Reseñas</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Tabla Reseñas</h1>
                    <p class="mb-4">En esta tabla contiene todas las reseñas que se an realizado.</p>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos del reseñas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBER</th>
                                            <th>OCUPACION</th>
                                            <th>RESENA</th>
                                            <th>CORREO</th>
                                            <th>FECHA</th>
                                            <th>VISIBILIDAD</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBER</th>
                                            <th>OCUPACION</th>
                                            <th>RESENA</th>
                                            <th>CORREO</th>
                                            <th>FECHA</th>
                                            <th>VISIBILIDAD</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        // Recorrer las reseñas y mostrar los datos en la tabla
                                        foreach ($resenias as $resenia) {
                                            $id = $resenia['ID'];
                                            $nombre = $resenia['NOMBRE'];
                                            $ocupacion = $resenia['OCUPACION'];
                                            $resena = $resenia['RESENA'];
                                            $correo = $resenia['CORREO'];
                                            $fecha = $resenia['FECHA'];
                                            $visibilidad = $resenia['VISIBLE'];

                                            echo '<tr>';
                                            echo '<td>' . $id . '</td>';
                                            echo '<td>' . $nombre . '</td>';
                                            echo '<td>' . $ocupacion . '</td>';
                                            echo '<td>' . $resena . '</td>';
                                            echo '<td>' . $correo . '</td>';
                                            echo '<td>' . $fecha . '</td>';
                                            echo '<td>';
                                            echo '<select class="form-control combobox-visibilidad" data-id="' . $id . '">';
                                            echo '<option value="1" ' . ($visibilidad == 1 ? 'selected' : '') . '>Visible</option>';
                                            echo '<option value="0" ' . ($visibilidad == 0 ? 'selected' : '') . '>No visible</option>';
                                            echo '</select>';
                                            echo '</td>';
                                            echo "<td><button class='btn btn-danger btn-eliminar' data-id='" . $resenia['ID'] . "'>Eliminar</button></td>";
                                            echo '</tr>';
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
            // Evento de clic en el botón "Modificar"
            $('.combobox-visibilidad').change(function () {
                var id = $(this).data('id');
                var visibilidad = $(this).val();

                // Llamada AJAX para actualizar la visibilidad de la reseña
                $.ajax({
                    url: '../php/resenias/actualizar_resenia.php',
                    type: 'POST',
                    data: { id: id, visibilidad: visibilidad },
                    success: function (response) {
                        // Verificar la respuesta del servidor
                        if (response === 'success') {
                            // Actualización exitosa, mostrar mensaje de confirmación
                            alert('La visibilidad de la reseña ha sido actualizada.');
                        } else {
                            // Error al actualizar, mostrar mensaje de error
                            alert('Error al actualizar la visibilidad de la reseña.');
                        }
                    },
                    error: function () {
                        // Error de conexión o solicitud AJAX
                        alert('Error al comunicarse con el servidor.');
                    }
                });
            });

            function cargarDatosResenia(id) {
                // Realizar una petición AJAX para obtener los datos de la reseña por su ID
                $.ajax({
                    url: '../php/resenias/leer_resenia.php', // Ruta al archivo PHP que obtiene los datos de la reseña por su ID
                    type: 'GET',
                    data: { id: id },
                    success: function (response) {
                        // Rellenar los campos del formulario del modal con los datos obtenidos
                        $('#reseniaId').val(response.ID);
                        $('#nombre').val(response.NOMBRE);
                        $('#ocupacion').val(response.OCUPACION);
                        $('#resena').val(response.RESENA);
                        $('#correo').val(response.CORREO);
                        $('#fecha').val(response.FECHA);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        // Mostrar un mensaje de error en caso de fallo en la petición
                        alert('Error al obtener los datos de la reseña.');
                    }
                });
            }

            // Evento de clic en el botón "Modificar"
            $('.btn-modificar').click(function () {
                var reseniaId = $(this).data('id');
                cargarDatosResenia(reseniaId);
            });

            // Evento de clic en el botón "Eliminar"
            $('.btn-eliminar').click(function () {
                var reseniaId = $(this).data('id');
                // Mostrar una confirmación antes de eliminar la reseña
                if (confirm('¿Estás seguro de que deseas eliminar esta reseña?')) {
                    // Realizar una petición AJAX para eliminar la reseña por su ID
                    $.ajax({
                        url: '../php/resenias/eliminar_resenia.php', // Ruta al archivo PHP que elimina la reseña por su ID
                        type: 'POST',
                        data: { id: reseniaId },
                        success: function (response) {
                            // Recargar la página o actualizar la tabla de reseñas
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                            // Mostrar un mensaje de error en caso de fallo en la petición
                            alert('Error al eliminar la reseña.');
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