function eliminarElemento(id) {
    if (confirm("¿Estás seguro de que quieres eliminar este elemento?")) {
        // Aquí puedes implementar la lógica para eliminar el elemento de la base de datos
        // Puedes utilizar AJAX para enviar una petición al servidor y realizar la eliminación
        // Pasando el ID del elemento como parámetro en la solicitud
        $.ajax({
            url: "../php/platillosDao.php",
            method: "POST",
            data: { id: id,
                action: 'eliminar' 
            },
            success: function (response) {
                // Maneja la respuesta del servidor después de eliminar el elemento
                alert("Se elimino correctamente el plato")
                location.reload()
                // Puede ser una confirmación de eliminación o cualquier otra acción que desees realizar
            },
            error: function (xhr, status, error) {
                // Maneja el error en caso de que la petición no se haya realizado correctamente
            }
        });
    }
}

function abrirModalModificar(id) {
    // Obtener los datos del elemento según su ID utilizando AJAX
    alert("seleccionado")
    
    $.ajax({
        url: "../php/platillosDao.php",
        method: "GET",
        data: { id: id ,
            action: 'obtenerPlatillo'},
        success: function (response) {
            // Manejar la respuesta del servidor con los datos del elemento
            // Puedes utilizar esta información para actualizar los campos de entrada en el modal
            
            var elemento = JSON.parse(response);


            alert(elemento.id)
            alert(elemento.nombre)
            alert(elemento.descripcion)
            alert(elemento.precio)
            alert(elemento.url)
            
            // Actualizar los campos de entrada con los datos del elemento
            document.getElementById("id").value = elemento.id;
            document.getElementById("nombre").value = elemento.nombre;
            document.getElementById("descripcion").value = elemento.descripcion;
            document.getElementById("precio").value = elemento.precio;
            document.getElementById("url").value = elemento.url;
        },
        error: function (xhr, status, error) {
            // Manejar el error en caso de que la petición no se haya realizado correctamente
        }
    });
}

function guardarCambios() {
    // Obtener los valores modificados de los campos de entrada
    var nombre = document.getElementById("campoNombre").value;
    var precio = document.getElementById("campoPrecio").value;
    
    // Lógica para guardar los cambios en la base de datos utilizando AJAX
    // Puedes enviar los nuevos valores al servidor para actualizar el elemento
    alert("guardado")
    /*
    $.ajax({
        url: "../php/platillosDao.php",
        method: "POST",
        data: { 
            nombre: nombre, 
            precio: precio, 
            action: 'modificar'
        },
        success: function (response) {
            // Manejar la respuesta del servidor después de guardar los cambios
            // Puede ser una confirmación de guardado o cualquier otra acción que desees realizar
            
            // Recargar la página completa para mostrar los cambios actualizados
            location.reload();
        },
        error: function (xhr, status, error) {
            // Manejar el error en caso de que la petición no se haya realizado correctamente
        }
    });
    */s
}

