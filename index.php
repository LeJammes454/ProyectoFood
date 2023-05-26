<?php
require_once 'assets/php/coneccionBD.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with FoodHut landing page.">
    <meta name="author" content="Devcrud">
    <title>LA MESA DE LOS SABORES</title>
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/animate/animate.css">
    <link rel="stylesheet" href="assets/css/foodhut.css">
    <link rel="stylesheet" href="assets/css/StyleIndex.css">


</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Navbar -->
    <nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top" data-spy="affix" data-offset-top="10">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#home">inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Acerca</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallary">Galeria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#book-table">Reservar Mesa</a>
                </li>
            </ul>
            <a class="navbar-brand m-auto" href="#">
                <img src="assets/imgs/logo.svg" class="brand-img" alt="">
                <span class="brand-txt">LA MESA DE LOS SABORES</span>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#blog">Blog<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#testmonial">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contactanos</a>
                </li>
                <li class="nav-item">
                    <a href="components.html" class="btn btn-primary ml-xl-4">[[Components]]</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- header -->
    <header id="home" class="header">
        <div class="overlay text-white text-center">
            <h1 class="display-2 font-weight-bold my-3">LA MESA DE LOS SABORES</h1>
            <h4 class="display-4 mb-5">"Descubre el placer de saborear la excelencia"</h4>
            <a class="btn btn-lg btn-primary" href="#gallary">nuestra galeria</a>
        </div>
    </header>

    <!--  Seccion de Acerca  -->
    <div id="about" class="container-fluid wow fadeIn" id="about" data-wow-duration="1.5s">
        <div class="row">
            <div class="col-lg-6 has-img-bg"></div>
            <div class="col-lg-6">
                <div class="row justify-content-center">
                    <div class="col-sm-8 py-5 my-5">
                        <h2 class="mb-4">Sobre Nosotros</h2>
                        <h4>"¡Bienvenidos a La Mesa de los Sabores!</h4>
                        <br>
                        <p>En nuestro acogedor restaurante, nos dedicamos a deleitar los paladares más exigentes con una experiencia gastronómica inolvidable. Nos enorgullece ofrecer una fusión única de sabores, cuidadosamente seleccionados y preparados por nuestro talentoso equipo de chefs.
                            <br><br>En La Mesa de los Sabores, creemos que cada plato debe ser una obra de arte culinaria, por eso nos esforzamos por utilizar ingredientes frescos y de la más alta calidad. Nuestro menú está diseñado para sorprender y satisfacer todos los gustos y preferencias
                        </p>
                        <p><b>En La Mesa de los Sabores, nuestra pasión por la buena comida y la hospitalidad se refleja en cada detalle. Nos enorgullece ser el lugar donde los sabores cobran vida y los comensales se convierten en amigos.</b></p>
                        <p>¡Te invitamos a descubrir el arte culinario en La Mesa de los Sabores! Reserva ahora y déjanos llevar tu paladar a un viaje inolvidable."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="gallary" class="text-center bg-dark text-light has-height-md middle-items wow fadeIn">
        <h2 class="section-title">Nuestro Menu</h2>
    </div>


    <div class="gallary row">
        <?php
        $database = new Database();

        $datos = $database->getDatosMenu();

        if (!empty($datos)) {
            foreach ($datos as $row) {
                $nombre = $row["nombre"];
                $url = $row["url"];

                echo '<div class="col-sm-6 col-lg-3 gallary-item wow fadeIn">';
                echo '<img src="' . $url . '" alt="' . $nombre . '" class="gallary-img img-fluid d-block">';
                echo '<a href="#" class="gallary-overlay">';
                echo '<i class="gallary-icon ti-plus"></i>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "No se encontraron resultados.";
        }

        $database->cerrarConexion();
        ?>
    </div>

    <!--Seccion reservar mesa  -->
    <div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items" id="book-table">
        <div class="">
            <h2 class="section-title mb-5">Reservar una Mesa</h2>
            <form class="reservation-form">
                <div class="row mb-5">
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="email" name="email" class="form-control form-control-lg custom-form-control" placeholder="EMAIL" required>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="number" name="numberOfGuests" class="form-control form-control-lg custom-form-control" placeholder="NUMBER OF GUESTS" max="20" min="0" required>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="time" name="time" class="form-control form-control-lg custom-form-control" placeholder="TIME" required>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                        <input type="date" name="date" class="form-control form-control-lg custom-form-control" placeholder="DATE" required>
                    </div>
                </div>
                <button type="button" class="btn btn-lg btn-primary" id="reservationBtn">Reservar</button>
            </form>
        </div>
    </div>




    <!-- Seccion de Blog  -->
    <div id=" blog" class="container-fluid bg-dark text-light py-5 text-center wow fadeIn">
        <h2 class="section-title py-5">Eventos en la Mesa de los Sabores</h2>
        <div class="row justify-content-center">
            <div class="col-sm-7 col-md-4 mb-5">
                <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#foods" role="tab" aria-controls="pills-home" aria-selected="true">Foods</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#juices" role="tab" aria-controls="pills-profile" aria-selected="false">Juices</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="foods" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-transparent border my-3 my-md-0">
                            <img src="assets/imgs/blog-1.jpg" alt="template by DevCRID http://www.devcrud.com/" class="rounded-0 card-img-top mg-responsive">
                            <div class="card-body">
                                <h1 class="text-center mb-4"><a href="#" class="badge badge-primary">$5</a></h1>
                                <h4 class="pt20 pb20">Reiciendis Laborum </h4>
                                <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa provident illum officiis fugit laudantium voluptatem sit iste delectus qui ex. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-transparent border my-3 my-md-0">
                            <img src="assets/imgs/blog-2.jpg" alt="template by DevCRID http://www.devcrud.com/" class="rounded-0 card-img-top mg-responsive">
                            <div class="card-body">
                                <h1 class="text-center mb-4"><a href="#" class="badge badge-primary">$12</a></h1>
                                <h4 class="pt20 pb20">Adipisci Totam</h4>
                                <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa provident illum officiis fugit laudantium voluptatem sit iste delectus qui ex. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-transparent border my-3 my-md-0">
                            <img src="assets/imgs/blog-3.jpg" alt="template by DevCRID http://www.devcrud.com/" class="rounded-0 card-img-top mg-responsive">
                            <div class="card-body">
                                <h1 class="text-center mb-4"><a href="#" class="badge badge-primary">$8</a></h1>
                                <h4 class="pt20 pb20">Dicta Deserunt</h4>
                                <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa provident illum officiis fugit laudantium voluptatem sit iste delectus qui ex. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="juices" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">
                    <div class="col-md-4 my-3 my-md-0">
                        <div class="card bg-transparent border">
                            <img src="assets/imgs/blog-4.jpg" alt="template by DevCRID http://www.devcrud.com/" class="rounded-0 card-img-top mg-responsive">
                            <div class="card-body">
                                <h1 class="text-center mb-4"><a href="#" class="badge badge-primary">$15</a></h1>
                                <h4 class="pt20 pb20">Consectetur Adipisicing Elit</h4>
                                <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa provident illum officiis fugit laudantium voluptatem sit iste delectus qui ex. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 my-3 my-md-0">
                        <div class="card bg-transparent border">
                            <img src="assets/imgs/blog-5.jpg" alt="template by DevCRID http://www.devcrud.com/" class="rounded-0 card-img-top mg-responsive">
                            <div class="card-body">
                                <h1 class="text-center mb-4"><a href="#" class="badge badge-primary">$29</a></h1>
                                <h4 class="pt20 pb20">Ullam Laboriosam</h4>
                                <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa provident illum officiis fugit laudantium voluptatem sit iste delectus qui ex. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 my-3 my-md-0">
                        <div class="card bg-transparent border">
                            <img src="assets/imgs/blog-6.jpg" alt="template by DevCRID http://www.devcrud.com/" class="rounded-0 card-img-top mg-responsive">
                            <div class="card-body">
                                <h1 class="text-center mb-4"><a href="#" class="badge badge-primary">$3</a></h1>
                                <h4 class="pt20 pb20">Fugit Ipsam</h4>
                                <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa provident illum officiis fugit laudantium voluptatem sit iste delectus qui ex. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reseñas Section  -->
    <div id="testmonial" class="container-fluid wow fadeIn bg-dark text-light has-height-lg middle-items">
        <h2 class="section-title my-5 text-center">Reseñas</h2>
        <div class="row mt-3 mb-5">
            <div class="col-md-4 my-3 my-md-0">
                <div class="testmonial-card">
                    <h3 class="testmonial-title">John Doe</h3>
                    <h6 class="testmonial-subtitle">Web Designer</h6>
                    <div class="testmonial-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum nobis eligendi, quaerat accusamus ipsum sequi dignissimos consequuntur blanditiis natus. Aperiam!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-3 my-md-0">
                <div class="testmonial-card">
                    <h3 class="testmonial-title">Steve Thomas</h3>
                    <h6 class="testmonial-subtitle">UX/UI Designer</h6>
                    <div class="testmonial-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum minus obcaecati cum eligendi perferendis magni dolorum ipsum magnam, sunt reiciendis natus. Aperiam!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-3 my-md-0">
                <div class="testmonial-card">
                    <h3 class="testmonial-title">Miranda Joy</h3>
                    <h6 class="testmonial-subtitle">Graphic Designer</h6>
                    <div class="testmonial-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, nam. Earum nobis eligendi, dignissimos consequuntur blanditiis natus. Aperiam!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contacto  -->
    <div id="contact" class="container-fluid bg-dark text-light border-top wow fadeIn">
        <div class="row">
            <div class="col-md-6 px-0">
                <div id="map" style="width: 100%; height: 100%; min-height: 400px"></div>
            </div>
            <div class="col-md-6 px-5 has-height-lg middle-items">
                <h3>Encuentranos</h3>
                <p>"Nos ubicamos en una privilegiada y céntrica ubicación, donde convergen el sabor y la comodidad. Nuestro restaurante, La Mesa de los Sabores, se encuentra en el corazón de la ciudad, lo que lo convierte en el destino perfecto para aquellos que desean disfrutar de una experiencia gastronómica excepcional."</p>
                <div class="text-muted">
                    <p><span class="ti-location-pin pr-3"></span> 12345 Fake ST NoWhere, AB Country</p>
                    <p><span class="ti-support pr-3"></span> (123) 456-7890</p>
                    <p><span class="ti-email pr-3"></span>info@website.com</p>
                </div>
            </div>
        </div>
    </div>

    <!-- page footer  -->
    <div class="container-fluid bg-dark text-light has-height-md middle-items border-top text-center wow fadeIn">
        <div class="row">
            <div class="col-sm-4">
                <h3>Nuestro Correo</h3>
                <P class="text-muted">info@website.com</P>
            </div>
            <div class="col-sm-4">
                <h3>Llamanos</h3>
                <P class="text-muted">(123) 456-7890</P>
            </div>
            <div class="col-sm-4">
                <h3>Encuentranos</h3>
                <P class="text-muted">12345 Fake ST NoWhere AB Country</P>
            </div>
        </div>
    </div>
    <div class="bg-dark text-light text-center border-top wow fadeIn">
        <p class="mb-0 py-3 text-muted small">&copy; Copyright <script>
                document.write(new Date().getFullYear())
            </script> hecho por <i class="ti-heart text-danger"></i> Tacos <a href="http://devcrud.com">DevCRUD</a></p>
    </div>
    <!-- end of page footer -->

    <!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- wow.js -->
    <script src="assets/vendors/wow/wow.js"></script>

    <!-- google maps -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtme10pzgKSPeJVJrG1O3tjR6lk98o4w8&callback=initMap"></script>

    <!-- FoodHut js -->
    <script src="assets/js/foodhut.js"></script>

    <!--reservacion js -->
    <script src="assets/js/reservacion.js"></script>

    

</body>

</html>