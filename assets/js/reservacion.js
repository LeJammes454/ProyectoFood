$(document).ready(function() {

    alert("Bienvenido ")

    // Capturar el evento de clic en el botón de envío
    $("#reservationBtn").click(function() {

        alert("Seleccionaste")

        // Obtener los datos del formulario
        var formData = $(".reservation-form").serialize();

        // Enviar la solicitud AJAX
        $.ajax({
            type: "POST",
            url: "assets/php/procesar_reservacion.php", // Archivo PHP para procesar los datos del formulario
            data: formData,
            success: function(response) {
                // Mostrar la respuesta del servidor
                alert(response);
            },
            error: function() {
                // Manejar errores
                alert("Error al enviar la solicitud AJAX");
            }
        });
    });
});