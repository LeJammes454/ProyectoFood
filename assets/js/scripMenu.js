// Obtener referencias a los botones de aumento y disminución
const decreaseButtons = document.querySelectorAll(".decreaseButton");
const increaseButtons = document.querySelectorAll(".increaseButton");
const quantityValues = document.querySelectorAll(".quantity");

// Agregar eventos de clic a los botones
decreaseButtons.forEach((button, index) => {
  button.addEventListener("click", () => {
    // Acción a realizar cuando se hace clic en el botón "-"
    let quantity = parseInt(quantityValues[index].textContent);
    if (quantity > 1) {
      quantity--;
      quantityValues[index].textContent = quantity;
    }
  });
});

increaseButtons.forEach((button, index) => {
  button.addEventListener("click", () => {
    // Acción a realizar cuando se hace clic en el botón "+"
    let quantity = parseInt(quantityValues[index].textContent);
    quantity++;
    quantityValues[index].textContent = quantity;
  });
});

// Obtener referencias a los botones de compra
const purchaseButtons = document.querySelectorAll(".purchaseButton");
const quantityValue = document.querySelectorAll(".quantity");

// Agregar eventos de clic a los botones de compra
purchaseButtons.forEach((button, index) => {
  button.addEventListener("click", (event) => {
    event.preventDefault(); // Evitar comportamiento predeterminado del enlace

    const id = button.dataset.id;
    const quantity = quantityValue[index].textContent;

    // Crear un nuevo elemento de lista con el ID y la cantidad
    const listItem = document.createElement("li");
    listItem.textContent = `ID del producto: ${id}, Cantidad: ${quantity}`;

    // Mostrar el modal de "Platillo agregado"
    showAddedModal();
    // Reiniciar el contador de cantidad a 1
    quantityValue[index].textContent = "1";
    // Agregar el producto a la tabla del modal
    addToCartTable(id, quantity);
  });
});

// Función para mostrar el modal de "Platillo agregado"
function showAddedModal() {
  const modal = new bootstrap.Modal(document.getElementById("addedModal"));
  modal.show();

  setTimeout(function () {
    modal.hide();
  }, 2000);
}

// Función para agregar el producto a la tabla del modal
function addToCartTable(id, quantity) {
  const cartTableBody = document.getElementById("cartTableBody");
  const existingProductRow = cartTableBody.querySelector(`tr[data-id="${id}"]`);

  if (existingProductRow) {
    const quantityCell = existingProductRow.querySelector(".quantity");
    const quantity = parseInt(quantityCell.textContent);
    quantityCell.textContent = quantity + 1;

    const priceCell = existingProductRow.querySelector(".price");
    const price = parseFloat(priceCell.textContent);
    const totalPrice = (quantity + 1) * price;
    const totalPriceCell = existingProductRow.querySelector(".total-price");
    totalPriceCell.textContent = totalPrice.toFixed(2);
  } else {
    // Realizar una solicitud a un script PHP para obtener los datos del producto
    fetch(`../php/get_product.php?id=${id}`)
      .then((response) => response.json())
      .then((product) => {
        // Crear una nueva fila en la tabla con los datos del producto
        const newRow = document.createElement("tr");
        newRow.setAttribute("data-id", id);

        const nameCell = document.createElement("td");
        nameCell.textContent = product.nombre;

        const priceCell = document.createElement("td");
        priceCell.textContent = product.precio;
        priceCell.classList.add("price");

        const quantityCell = document.createElement("td");
        const newQuantity = quantity;
        quantityCell.textContent = newQuantity;
        quantityCell.classList.add("quantity");

        const totalPriceCell = document.createElement("td");
        const price = parseFloat(product.precio);
        const totalPrice = newQuantity * price;
        totalPriceCell.textContent = totalPrice.toFixed(2);
        totalPriceCell.classList.add("total-price");

        const actionsCell = document.createElement("td");
        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Eliminar";
        deleteButton.classList.add("btn", "btn-danger", "btn-sm");
        deleteButton.addEventListener("click", () => {
          deleteCartItem(newRow);
        });
        actionsCell.appendChild(deleteButton);

        newRow.appendChild(nameCell);
        newRow.appendChild(priceCell);
        newRow.appendChild(quantityCell);
        newRow.appendChild(totalPriceCell);
        newRow.appendChild(actionsCell);
        cartTableBody.appendChild(newRow);
      });
  }
  // Función para eliminar un elemento del carrito
  function deleteCartItem(row) {
    row.remove();
  }
}

// Obtén una referencia al botón "Realizar Pedido"
const realizarPedidoBtn = document.getElementById("realizarPedidoBtn");

// Agrega un evento de clic al botón
realizarPedidoBtn.addEventListener("click", () => {
  // Obtén los datos de la tabla
  const cartTable = document.getElementById("cartTableBody");
  const rowData = Array.from(cartTable.rows).map((row) =>
    Array.from(row.cells).map((cell) => cell.textContent)
  );

  // Realiza la redirección a otra página con los datos
  const url = "../pages/confirmarCompra.php"; // Reemplaza "nueva_pagina.php" por la URL de tu página de destino
  window.location.href = `${url}?data=${JSON.stringify(rowData)}`;
});
