<?php
require_once '../php/coneccionBD.php';

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
            <a class="navbar-brand" href="#!">La Mesa de los Sabores</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="../../index.php">Inicio</a></li>
                </ul>
                <form class="d-flex">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#cartModal">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>

                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small dark-mode">
                        <li><a class="dropdown-item" href="#">Cuenta</a></li>
                        <li><a class="dropdown-item" href="#">Pedidos</a></li>
                        <li><a class="dropdown-item" href="#">Reseñas</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
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
                         <div class="card border-danger text-bg-secondary h-100">
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
                                    <span class="text-muted text-decoration-line-through">$20.00</span>
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
    <footer class="py-3 my-4">
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
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
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





    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>

    <!-- Scrip JS-->
    <script src="../js/scripMenu.js"></script>
</body>

</html>