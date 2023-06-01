document.addEventListener("DOMContentLoaded", function () {


    window.addEventListener('pageshow', function(event) {
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
        { id: "zip", regex: /^\d{5}$/, uppercase: false },
        { id: "cc-name", regex: /^[A-Z]+(?:\s+[A-Z]+)+$/, uppercase: true },
        { id: "cc-number", regex: null, uppercase: false },
        { id: "cc-expiration", regex: null, uppercase: false },
        { id: "cc-cvv", regex: null, uppercase: false },
      ];

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

        console.log("El botón ha sido presionado.");
        // Espera 5 segundos (5000 milisegundos) antes de redirigir
        const tiempoEspera = 5000;

        setTimeout(function () {
          // Redirige a otra página
          window.location.href = "menu.php";
        }, tiempoEspera);
      }

      
    });


    /*
    // Codigo para hacer mayusculas los input
  var firstNameInput = document.getElementById("firstName");
  var lastNameInput = document.getElementById("lastName");
  var ccNameInput = document.getElementById("cc-name");

  firstNameInput.addEventListener("input", function () {
    firstNameInput.value = firstNameInput.value.toUpperCase();
  });

  lastNameInput.addEventListener("input", function () {
    lastNameInput.value = lastNameInput.value.toUpperCase();
  });

  
  ccNameInput.addEventListener("input", function () {
    ccNameInput.value = ccNameInput.value.toUpperCase();
  });

  // Codigo para formatear los numeros de la tarjeta
  var ccNumberInput = document.getElementById("cc-number");
  ccNumberInput.addEventListener("input", function () {
    var value = ccNumberInput.value.replace(/-/g, ""); // Eliminar guiones existentes
    var formattedValue = "";

    for (var i = 0; i < value.length && i < 16; i++) {
      formattedValue += value[i];

      if ((i + 1) % 4 === 0 && i !== value.length - 1 && i !== 15) {
        formattedValue += "-";
      }
    }

    ccNumberInput.value = formattedValue;
  });

  // Codigo para formatear la fecha de expidacion
  var ccExpirationInput = document.getElementById("cc-expiration");

  ccExpirationInput.addEventListener("input", function () {
    var value = ccExpirationInput.value.replace(/\D/g, ""); // Eliminar caracteres no numéricos
    var formattedValue = "";

    if (value.length > 2) {
      formattedValue = value.slice(0, 2) + "/" + value.slice(2, 4);
    } else {
      formattedValue = value;
    }

    ccExpirationInput.value = formattedValue;

    // Validación de fecha
    var parts = formattedValue.split("/");
    var month = parseInt(parts[0], 10);
    var year = parseInt(parts[1], 10) + 2000; // Agregar 2000 al año para tener un formato de 4 dígitos

    var currentDate = new Date();
    var currentYear = currentDate.getFullYear() % 100; // Obtener los últimos dos dígitos del año actual
    var currentMonth = currentDate.getMonth() + 1; // Los meses en JavaScript son base 0, por eso se suma 1

    if (
      month < 1 ||
      month > 12 ||
      year < currentYear ||
      (year === currentYear && month < currentMonth)
    ) {
      ccExpirationInput.classList.add("is-invalid");
    } else {
      ccExpirationInput.classList.remove("is-invalid");
    }
  });

  // Validación de CVV
  var ccCvvInput = document.getElementById("cc-cvv");

  ccCvvInput.addEventListener("input", function () {
    var value = ccCvvInput.value.replace(/\D/g, ""); // Eliminar caracteres no numéricos
    var formattedValue = value.slice(0, 3); // Limitar a 3 dígitos

    ccCvvInput.value = formattedValue;
  });


  
  var zipInput = document.getElementById("zip");
  zipInput.addEventListener("input", function () {
    var value = zipInput.value.replace(/\D/g, ""); // Eliminar caracteres no numéricos
    var formattedValue = value.slice(0, 5); // Limitar a 3 dígitos

    zipInput.value = formattedValue;
  });

  // TCodigo del boton
  document
    .getElementById("compramamalona")
    .addEventListener("click", function () {
      // Obtener los campos de entrada
      var firstNameInput = document.getElementById("firstName");
      var lastNameInput = document.getElementById("lastName");
      var addressInput = document.getElementById("address");
      var zipInput = document.getElementById("zip");
      var ccNameInput = document.getElementById("cc-name");
      var ccNumberInput = document.getElementById("cc-number");
      var ccExpirationInput = document.getElementById("cc-expiration");
      var ccCvvInput = document.getElementById("cc-cvv");

      // Verificar si los campos están vacíos
      if (
        firstNameInput.value === "" ||
        lastNameInput.value === "" ||
        addressInput.value === "" ||
        zipInput.value === "" ||
        ccNameInput.value === "" ||
        ccNumberInput.value === "" ||
        ccExpirationInput.value === "" ||
        ccCvvInput.value === ""
      ) {
        // Mostrar mensajes de error para los campos requeridos
        if (firstNameInput.value === "") {
          firstNameInput.classList.add("is-invalid");
        } else if (!/^[A-Za-z]+$/.test(firstNameInput.value)) {
          firstNameInput.classList.add("is-invalid");
        } else {
          firstNameInput.classList.remove("is-invalid");
        }

        if (lastNameInput.value === "") {
          lastNameInput.classList.add("is-invalid");
        } else if (!/^[A-Za-z]+$/.test(lastNameInput.value)) {
          lastNameInput.classList.add("is-invalid");
        } else {
          lastNameInput.classList.remove("is-invalid");
        }

        if (addressInput.value === "") {
          addressInput.classList.add("is-invalid");
        } else {
          addressInput.classList.remove("is-invalid");
        }

        if (zipInput.value === "") {
          zipInput.classList.add("is-invalid");
        } else if (!/^\d{5}$/.test(zipInput.value)) {
          zipInput.classList.add("is-invalid");
        } else {
          zipInput.classList.remove("is-invalid");
        }

        if (ccNameInput.value === "") {
          ccNameInput.classList.add("is-invalid");
        } else if (!/^[A-Za-z]+$/.test(ccNameInput.value)) {
          ccNameInput.classList.add("is-invalid");
        } else {
          ccNameInput.classList.remove("is-invalid");
        }

        if (ccNumberInput.value === "") {
          ccNumberInput.classList.add("is-invalid");
        } else {
          ccNumberInput.classList.remove("is-invalid");
        }

        if (ccExpirationInput.value === "") {
          ccExpirationInput.classList.add("is-invalid");
        } else {
          ccExpirationInput.classList.remove("is-invalid");
        }

        if (ccCvvInput.value === "") {
          ccCvvInput.classList.add("is-invalid");
        } else {
          ccCvvInput.classList.remove("is-invalid");
        }

        // Detener el envío del formulario
        event.preventDefault();
        event.stopPropagation();
      }

      if (false) {
        var modal = new bootstrap.Modal(
          document.getElementById("staticBackdrop")
        );

        // Activar el modal
        modal.show();

        console.log("El botón ha sido presionado.");
        // Espera 5 segundos (5000 milisegundos) antes de redirigir
        const tiempoEspera = 5000;

        setTimeout(function () {
          // Redirige a otra página
          window.location.href = "menu.php";
        }, tiempoEspera);
      }
    });*/


  // Código para formatear los números de la tarjeta
  var ccNumberInput = document.getElementById("cc-number");
  ccNumberInput.addEventListener("input", function () {
    var value = ccNumberInput.value.replace(/-/g, ""); // Eliminar guiones existentes
    var formattedValue = "";

    for (var i = 0; i < value.length && i < 16; i++) {
      formattedValue += value[i];

      if ((i + 1) % 4 === 0 && i !== value.length - 1 && i !== 15) {
        formattedValue += "-";
      }
    }

    ccNumberInput.value = formattedValue;
  });

  // Código para formatear la fecha de expiración
  var ccExpirationInput = document.getElementById("cc-expiration");
  ccExpirationInput.addEventListener("input", function () {
    var value = ccExpirationInput.value.replace(/\D/g, ""); // Eliminar caracteres no numéricos
    var formattedValue = "";

    if (value.length > 2) {
      formattedValue = value.slice(0, 2) + "/" + value.slice(2, 4);
    } else {
      formattedValue = value;
    }

    ccExpirationInput.value = formattedValue;

    // Validación de fecha
    var parts = formattedValue.split("/");
    var month = parseInt(parts[0], 10);
    var year = parseInt(parts[1], 10) + 2000; // Agregar 2000 al año para tener un formato de 4 dígitos

    var currentDate = new Date();
    var currentYear = currentDate.getFullYear() % 100; // Obtener los últimos dos dígitos del año actual
    var currentMonth = currentDate.getMonth() + 1; // Los meses en JavaScript son base 0, por eso se suma 1

    if (
      month < 1 ||
      month > 12 ||
      year < currentYear ||
      (year === currentYear && month < currentMonth)
    ) {
      ccExpirationInput.classList.add("is-invalid");
    } else {
      ccExpirationInput.classList.remove("is-invalid");
    }
  });

  // Validación de CVV
  var ccCvvInput = document.getElementById("cc-cvv");
  ccCvvInput.addEventListener("input", function () {
    var value = ccCvvInput.value.replace(/\D/g, ""); // Eliminar caracteres no numéricos
    var formattedValue = value.slice(0, 3); // Limitar a 3 dígitos

    ccCvvInput.value = formattedValue;
  });

  // Validación de ZIP
  var zipInput = document.getElementById("zip");
  zipInput.addEventListener("input", function () {
    var value = zipInput.value.replace(/\D/g, ""); // Eliminar caracteres no numéricos
    var formattedValue = value.slice(0, 5); // Limitar a 5 dígitos

    zipInput.value = formattedValue;
  });

  var firstNameInput = document.getElementById("firstName");
  var lastNameInput = document.getElementById("lastName");
  var ccNameInput = document.getElementById("cc-name");

  firstNameInput.addEventListener("input", function () {
    firstNameInput.value = firstNameInput.value.toUpperCase();
  });

  lastNameInput.addEventListener("input", function () {
    lastNameInput.value = lastNameInput.value.toUpperCase();
  });

  ccNameInput.addEventListener("input", function () {
    ccNameInput.value = ccNameInput.value.toUpperCase();
  });
});

const cuponButton = document.querySelector('#cuponForm button[type="submit"]');

cuponForm.addEventListener("submit", (event) => {
  event.preventDefault(); // Evita el envío del formulario

  const cuponCodigo = cuponInput.value; // Obtiene el código del cupón ingresado por el usuario

  // Realizar la consulta a la base de datos utilizando AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("GET", `../php/consulta_descuento.php?cupon=${cuponCodigo}`, true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      const descuento = xhr.responseText;

      if (descuento !== "") {
        // El cupón es válido
        cuponInput.disabled = true; // Deshabilita el campo de entrada
        cuponButton.disabled = true; // Deshabilita el botón
        cuponMessage.textContent = "Cupón válido"; // Muestra el mensaje de cupón válido

        const descuentoSinPorcentaje = descuento.replace("%", "");

        // Convierte el descuento a formato decimal
        const descuentoDecimal = parseFloat(descuentoSinPorcentaje) / 100;

        // Calcula el nuevo total aplicando el descuento
        const nuevoTotal = precio - precio * descuentoDecimal;

        alert(precio);

        const totalElement = document.getElementById("preciochido");
        totalElement.textContent = `$${nuevoTotal.toFixed(2)}`; // Establece el nuevo total formateado a 2 decimales

        // Establece el código del descuento y el descuento en los elementos HTML correspondientes
        const codigoDescuentoElement =
          document.getElementById("codigoDescuento");
        codigoDescuentoElement.textContent = cuponCodigo; // Establece el código del descuento
        const descuentoElement = document.getElementById("descuento"); // Obtén el elemento del descuento
        descuentoElement.textContent = `−${descuento}`; // Establece el descuento
      } else {
        // El cupón no es válido
        cuponMessage.textContent = "Cupón no válido"; // Muestra el mensaje de cupón no válido
      }
    }
  };

  xhr.onerror = function () {
    console.error("Error al realizar la consulta");
  };

  xhr.send();
});
