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
    <div class="container bg-dark " data-bs-theme="dark">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="" alt="" width="72" height="57">
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
                        </div>

                        <div class="row gy-3">
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

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#"
                            id="compramamalona">
                            Confirmar Compra
                        </button>


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

    <script src="../js/confirmarCompra.js"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>