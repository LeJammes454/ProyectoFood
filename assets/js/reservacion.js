$(document).ready(function() {
    $("#reservationBtn").click(function() {
        var email = $("#email").val();
        var numberOfGuests = $("#numberOfGuests").val();
        var time = $("#time").val();
        var date = $("#date").val();

        $.ajax({
            url: "guardar_reservacion.php",
            type: "POST",
            data: {
                email: email,
                numberOfGuests: numberOfGuests,
                time: time,
                date: date
            },
            success: function(response) {
                console.log(response);
                // Realizar acciones adicionales después de guardar la reservación
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Manejar errores en caso de que la solicitud falle
            }
        });
    });
});