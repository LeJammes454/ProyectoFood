<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/Stylelogin.css">

    <title>Document</title>
</head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
    <div class="filtro"></div>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Regístrarse</button>
                </div>
            </div>
            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form action="#" method="POST" class="formulario__login" id="form-login">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Correo Electronico" name="correo">
                    <input type="password" placeholder="Contraseña" name="contrasenia">
                    <button type="submit">Entrar</button>
                </form>


                <!--Register-->
                <form action="#" method="POST" class="formulario__register">
                    <h2>Regístrarse</h2>
                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <input type="text" placeholder="Nombre completo" name="nombre">
                                <input type="text" placeholder="Apellido Paterno" name="apellido_paterno">
                                <input type="text" placeholder="Apellido Materno" name="apellido_materno">
                                <input type="text" placeholder="Numero Telefono" name="numero_telefonico">
                                <input type="text" placeholder="Ocupacion" name="ocupacion">
                                <input type="text" placeholder="Correo Electronico" name="email">
                                <input type="password" placeholder="Contraseña" name="password">
                            </div>
                        </div>
                    </div>
                    <button>Regístrarse</button>
                </form>
            </div>
        </div>
    </main>

    <script src="../js/scriplogin.js"></script>
</body>

</html>