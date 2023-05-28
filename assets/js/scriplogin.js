//Ejecutando funciones
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPage);

//Declarando variables
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

//FUNCIONES

function anchoPage() {

    if (window.innerWidth > 850) {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
    }
}

anchoPage();


function iniciarSesion() {
    if (window.innerWidth > 850) {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "10px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}

function register() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
}


$(document).ready(function () {
    // Capturar el evento de envío del formulario de registro
    $('.formulario__register').submit(function (event) {
        event.preventDefault(); // Evita el envío normal del formulario

        // Obtener los valores de los campos del formulario
        var nombre = $('input[name=nombre]').val();
        var apellido_paterno = $('input[name=apellido_paterno]').val();
        var apellido_materno = $('input[name=apellido_materno]').val();
        var contrasenia = $('input[name=password]').val();
        var numero_telefonico = $('input[name=numero_telefonico]').val();
        var direccion = $('input[name=direccion]').val();
        var codigo_postal = $('input[name=codigo_postal]').val();
        var correo = $('input[name=email]').val();
        // Enviar los datos del formulario al servidor usando Ajax
        $.ajax({
            url: '../php/registrar.php', // Ruta al archivo PHP que manejará la solicitud
            method: 'POST',
            data: {
                nombre: nombre,
                apellido_paterno: apellido_paterno,
                apellido_materno: apellido_materno,
                contrasenia: contrasenia,
                numero_telefonico: numero_telefonico,
                direccion: direccion,
                codigo_postal: codigo_postal,
                correo: correo
            },
            success: function (response) {
                if (response === 'ok') {
                    alert('Registro Valido');
                } else {
                    alert('Error al registrar usuario');
                }
            },
            error: function () {
                // Manejar errores en caso de que la solicitud falle
                alert('Error en el registro');
            }
        });
    });

    // Capturar el evento de envío del formulario de inicio de sesión
    $('#form-login').submit(function (event) {
        event.preventDefault(); // Evitar el envío normal del formulario

        // Obtener los valores de los campos del formulario
        var correo = $('input[name=correo]').val();
        var contrasenia = $('input[name=contrasenia]').val();

        alert(correo)
        alert(contrasenia)
        // Enviar los datos del formulario al servidor usando Ajax
        $.ajax({
            url: '../php/verificar_login.php', // Ruta al archivo PHP que manejará la solicitud
            method: 'POST',
            data: {
                correo: correo,
                contrasenia: contrasenia
            },
            success: function (response) {
                if (response === 'ok') {
                    window.location.href = '../pages/menu.html'; // Redirigir a la página deseada
                } else if(response === 'admin'){
                    window.location.href = '#'; // Redirigir a la página deseada
                } else {
                    alert('Credenciales inválidas');
                }
            },
            error: function () {
                // Manejar errores en caso de que la solicitud falle
                alert('Error en el inicio de sesión');
            }
        });
    });

});

