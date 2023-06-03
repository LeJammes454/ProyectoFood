document.addEventListener("DOMContentLoaded", function () {
  var backButton = document.getElementById('botonback');
  // Agregar un evento de clic al botón "Regresar"
  backButton.addEventListener('click', function () {
      // Realizar acciones al hacer clic en "Regresar"
      // Por ejemplo, redirigir a la otra página
      setTimeout(function() {
        window.location.href = "menu.php";
      }, 1000); // 1000 milisegundos = 1 segundo
  });


  // Obtener el elemento del radio button
  var radioEfectivo = document.getElementById("efectivo");
  var radioTarjeta = document.getElementById("debit");
  var radioCredito = document.getElementById("credit");
  // Obtener los elementos que se deben ocultar
  var elementosOcultar = document.getElementById("inputstarjeta");

  // Agregar un evento de escucha para el evento "change"
  radioEfectivo.addEventListener("change", function () {
    elementosOcultar.style.display = "none";
  });
  radioTarjeta.addEventListener("change", function () {
    elementosOcultar.style.display = "";
  });
  radioCredito.addEventListener("change", function () {
    elementosOcultar.style.display = "";
  });
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
