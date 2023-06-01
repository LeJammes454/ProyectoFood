
document.addEventListener("DOMContentLoaded", function () {
    // Tu código aquí
    document.getElementById("compramamalona").addEventListener("click", function () {
        console.log("El botón ha sido presionado.");
        // Espera 5 segundos (5000 milisegundos) antes de redirigir
        const tiempoEspera = 5000;

        setTimeout(function () {
            // Redirige a otra página
            window.location.href = "menu.php";
        }, tiempoEspera);
    });
});
const cuponButton = document.querySelector('#cuponForm button[type="submit"]');


cuponForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Evita el envío del formulario


    const cuponCodigo = cuponInput.value; // Obtiene el código del cupón ingresado por el usuario

    // Realizar la consulta a la base de datos utilizando AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../php/consulta_descuento.php?cupon=${cuponCodigo}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const descuento = xhr.responseText;

            if (descuento !== '') {
                // El cupón es válido
                cuponInput.disabled = true; // Deshabilita el campo de entrada
                cuponButton.disabled = true; // Deshabilita el botón
                cuponMessage.textContent = 'Cupón válido'; // Muestra el mensaje de cupón válido

                const descuentoSinPorcentaje = descuento.replace("%", "");

                // Convierte el descuento a formato decimal
                const descuentoDecimal = parseFloat(descuentoSinPorcentaje) / 100;

                // Calcula el nuevo total aplicando el descuento
                const nuevoTotal = precio - (precio * descuentoDecimal);

                alert(precio)

                const totalElement = document.getElementById('preciochido');
                totalElement.textContent = `$${nuevoTotal.toFixed(2)}`; // Establece el nuevo total formateado a 2 decimales


                // Establece el código del descuento y el descuento en los elementos HTML correspondientes
                const codigoDescuentoElement = document.getElementById('codigoDescuento');
                codigoDescuentoElement.textContent = cuponCodigo; // Establece el código del descuento
                const descuentoElement = document.getElementById('descuento'); // Obtén el elemento del descuento
                descuentoElement.textContent = `−${descuento}`; // Establece el descuento


            } else {
                // El cupón no es válido
                cuponMessage.textContent = 'Cupón no válido'; // Muestra el mensaje de cupón no válido
            }

        }
    };

    xhr.onerror = function () {
        console.error('Error al realizar la consulta');
    };

    xhr.send();
});



