<?php
require_once '../php/coneccionBD.php';

// Incluir la función session_start() al comienzo del archivo
session_start();

// Verificar si la variable de sesión está establecida
if (!isset($_SESSION['correo'])) {
    // La sesión no está activa, redirigir al formulario de inicio de sesión o a otra página
    header("Location: ../../index.php");
    exit(); // Detener la ejecución del resto del código
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Pago - La Mesa de los sabores</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/StyleCC.css">
</head>

<body class="bg-dark">
    <div class="position-fixed">
        <div>
            <a href="#" id="modalMamalon" class="btn btn-outline-danger" data-toggle="modal">Regresar</a>
        </div>
        <script>

            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
            // Obtener referencia al botón flotante
            var floatingButton = document.getElementById('modalMamalon');

            // Agregar un evento de clic al botón flotante
            floatingButton.addEventListener('click', function () {
                // Obtener referencia al modal
                var modal = document.getElementById('regresoModal')

                // Mostrar el modal utilizando Bootstrap
                var modalInstance = new bootstrap.Modal(modal);
                modalInstance.show();
            });

        </script>
    </div>
    <div class="container">
        <!-- Coloca el botón dentro de un contenedor -->

    </div>
    <div class="container bg-dark " data-bs-theme="dark">
        <!-- Modal -->
        <div class="modal fade" id="regresoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="text-white">Cancelar Compra</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-white">
                        ¿Seguro que quieres regresar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Continuar con la
                            compra</button>
                        <button type="button" class="btn btn-outline-danger" id="botonback">Si, quiero regresar</button>
                    </div>
                </div>
            </div>
        </div>
        <main>
            <div class="py-5 text-center">
                <img src="../imgs/logomamalon.png" class="brand-img" alt="">
                <h2 class="text-light">Verificar Compra</h2>
                <p class="lead text-light">Queremos expresar nuestro más sincero agradecimiento por confiar en
                    nosotros y realizar tu compra en nuestra página web. Valoramos enormemente tu
                    apoyo y nos complace haber tenido la oportunidad de brindarte una experiencia
                    gastronómica única desde la comodidad de tu hogar.</p>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Tu carrito</span>

                        <?php
                        if (isset($_GET['data'])) {
                            $data = json_decode($_GET['data'], true);
                            $tamano = sizeof($data);

                            echo ' <span class="badge bg-primary rounded-pill">
                                    ' . $tamano . '
                                   </span>'
                                ?>
                        </h4>
                        <ul class="list-group mb-3">

                            <?php
                            echo '<ul class="list-group">';
                            $totalSum = 0; // Variable para almacenar la suma de los precios totales
                            foreach ($data as $row) {
                                $nombre = $row[0];
                                $precio = $row[1];
                                $cantidad = $row[2];
                                $precioTotal = $row[3];
                                $totalSum += $precioTotal;
                                echo '<li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">' . $nombre . '</h6>
                            <span class="text-muted">Cantidad: ' . $cantidad . '</span>
                        </div>
                        <span class="text-body-secondary">' . $precioTotal . '</span>
                    </li>';
                            }
                            echo '</ul>';

                            // Calcula el nuevo total aplicando el descuento
                            $nuevoTotal = $totalSum - ($totalSum * $descuento);
                        }
                        ?>
                        <!--  Codigo para mostrar el descuento
                        <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                            <div class="text-success">
                                <h6 class="my-0">Código de promoción</h6>
                                <small id="codigoDescuento"></small>
                            </div>
                            <span class="text-success" id="descuento">%0</span>
                        </li>
-->

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (MX)</span>
                            <strong id="preciochido">
                                <?php echo '$' . $nuevoTotal; ?>
                            </strong>
                        </li>



                    </ul>
                    <!-- Codigo para aplicar el descuento 
                    <form class="card p-2" id="cuponForm">
                        <div class="input-group">
                            <input type="text" class="form-control" id="cuponInput" placeholder="Código de promoción">
                            <button type="submit" class="btn btn-secondary">Reclamar</button>
                            <div id="cuponMessage"></div>
                        </div>
                    </form>
                    -->

                </div>

                <div class="col-md-7 col-lg-8 ">
                    <h4 class="mb-3 text-light">Direccion de envio</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label text-light">Nombre</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Su nombre es requerido.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label text-light">Apellido</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Su apellido es requerido.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label text-light">Direccion</label>
                                <input type="text" class="form-control " id="address" placeholder="1234 Main St"
                                    required>
                                <div class="invalid-feedback">
                                    Porfavor ingrese su direccion para enviar el pedido.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label text-light">Direccion 2 <span
                                        class="text-body-secondary">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                            </div>

                            <div class="col-md-3">
                                <label for="zip" class="form-label text-light">Codigo postal</label>
                                <input type="text" class="form-control" id="zip" placeholder="" required>
                                <div class="invalid-feedback">
                                    Codigo postal requerido
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3 text-light">Metodo de pago</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input " checked
                                    required>
                                <label class="form-check-label text-light" for="credit">Tarjeta de credito</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label text-light" for="debit">Tarjeta de debito</label>
                            </div>
                            <div class="form-check">
                                <input id="efectivo" name="paymentMethod" type="radio" class="form-check-input"
                                    required>
                                <label class="form-check-label text-light" for="efectivo">Efectivo</label>
                            </div>
                        </div>

                        <div class="row gy-3" id="inputstarjeta">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label text-light">Nombre en la tarjeta</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-body-secondary"></small>
                                <div class="invalid-feedback">
                                    Nombre del titular de la tarjeta requerido
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="text-light form-label">Número de Tarjeta</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Se necesitan 16 dijitos
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label text-light">Vencimiento</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Fecha de expiracion requerido
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label text-light">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Codigo de seguiridad requerido
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Agrega un ID único al botón -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#"
                            id="compramamalona">Confirmar Compra</button>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                window.addEventListener('pageshow', function (event) {
                                    var source = event.persisted || (typeof event.performance != 'undefined' && event.performance.navigation.type === 2);
                                    if (source) {
                                        // Restablecer los valores de los campos de la tarjeta a vacío o eliminarlos
                                        document.getElementById('cc-number').value = '';
                                        document.getElementById('cc-expiration').value = '';
                                        document.getElementById('cc-cvv').value = '';

                                        var modal = new bootstrap.Modal(
                                            document.getElementById("staticBackdrop")
                                        );

                                        // Activar el modal
                                        modal.hide();
                                    }
                                });
                                document
                                    .getElementById("compramamalona")
                                    .addEventListener("click", function (event) {
                                        // Array con la información de los campos a verificar
                                        var fields = [
                                            { id: "firstName", regex: /^[A-Za-z]+$/, uppercase: true },
                                            { id: "lastName", regex: /^[A-Za-z]+$/, uppercase: true },
                                            { id: "address", regex: null, uppercase: false },
                                            { id: "zip", regex: /^\d{5}$/, uppercase: false }
                                        ];
                                        var efectivoRadio = document.getElementById("efectivo");
                                        if (!efectivoRadio.checked) {
                                            var fields2 = [
                                                { id: "cc-name", regex: /^[A-Z]+(?:\s+[A-Z]+)+$/, uppercase: true },
                                                { id: "cc-number", regex: null, uppercase: false },
                                                { id: "cc-expiration", regex: null, uppercase: false },
                                                { id: "cc-cvv", regex: null, uppercase: false },
                                            ];
                                            console.log("asdasdasdasd")
                                            var fields = fields.concat(fields2);
                                        }
                                        // Variable para controlar si se deben detener las validaciones
                                        var stopValidations = false;
                                        // Verificar campos vacíos y expresiones regulares
                                        fields.forEach(function (field) {
                                            var input = document.getElementById(field.id);
                                            var value = input.value.trim();
                                            // Convertir a mayúsculas si está especificado en el campo
                                            if (field.uppercase) {
                                                value = value.toUpperCase();
                                                input.value = value;
                                            }
                                            if (value === "") {
                                                input.classList.add("is-invalid");
                                                stopValidations = true;
                                            } else {
                                                input.classList.remove("is-invalid");

                                                if (field.regex !== null && !field.regex.test(value)) {
                                                    input.classList.add("is-invalid");
                                                    stopValidations = true;
                                                } else {
                                                    input.classList.remove("is-invalid");
                                                }
                                            }
                                        });
                                        // Detener el envío del formulario si hay campos inválidos
                                        if (stopValidations) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                            return;
                                        }
                                        // Alerta cuando los campos son válidos
                                        alert("Los campos son válidos. ¡Compra realizada con éxito!");
                                        if (true) {
                                            var modal = new bootstrap.Modal(
                                                document.getElementById("staticBackdrop")
                                            );

                                            // Activar el modal
                                            modal.show();

                                            //console.log("El botón ha sido presionado.");
                                            // Espera 5 segundos (5000 milisegundos) antes de redirigir
                                            const tiempoEspera = 5000;

                                            var data = JSON.stringify(<?php echo json_encode($data); ?>);

                                            $.ajax({
                                                url: '../php/insertarPedidos.php',
                                                method: 'POST',
                                                data: {
                                                    data: data // Agrega el dato 'data' al objeto 'data'
                                                }, success: function (response) {
                                                    //console.log('Los datos fueron enviados correctamente');
                                                    //console.log('Respuesta del servidor: ' + response);
                                                },
                                                error: function () {
                                                    console.log('Error al enviar los datos');
                                                }
                                            });

                                            setTimeout(function () {
                                                // Redirige a otra página
                                                window.location.href = "menu.php";
                                            }, tiempoEspera);
                                        }


                                    });

                            });
                        </script>





                    </form>
                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-body-secondary text-center text-small">
            <p class="text-center text-white text-muted small">&copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> hecho por <i class="ti-heart text-danger"></i> Tacos <a
                    href="https://youtu.be/mCdA4bJAGGk">ITSUR</a>
            </p>
        </footer>
    </div>


    <!-- Modal -->
    <div class="modal fade bg-opacity-50" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog bg-opacity-50">
            <div id="page">
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div id="container">
                    <div id="ring"></div>
                    <div id="ring"></div>
                    <div id="ring"></div>
                    <div id="ring"></div>
                    <div id="h3">loading</div>
                </div>
            </div>
            <div>
                <h2 class="text-light">Gracias por su compra.</h2>
                <h2 class="text-light">Redirigiendo al menu</h2>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="../js/confirmarCompra.js"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>