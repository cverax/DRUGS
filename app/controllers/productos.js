const API_PRODUCTO = '../app/api/productos.php?action=';



document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_PRODUCTO);
    graficaBarrasCategorias();
});

// Función para mostrar la cantidad de productos por categoría en una gráfica de barras.
function graficaBarrasCategorias() {
    fetch(API_PRODUCTO + 'cantidadProductosCategoria', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.categoria);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    barGraph('chart1', categorias, cantidad, 'Cantidad de productos', 'Cantidad de productos por categoría');
                } else {
                    document.getElementById('chart1').remove();
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {

        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.codigoproducto}</td>
                <td>${row.nombreproducto}</td>
                <td>${row.categoria}</td>
                <td>${row.lote}</td>
                <td>${row.vencimiento}</td>
                <td>${row.comentario}</td>
                <td>
                <a href="#" onclick="openUpdateDialog(${row.codigoproducto})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>         
                </td>
               
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}
$joya=0
function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    $joya=1;
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Ingresar Usuario';
    document.getElementById('Categoria').disabled = false;
    document.getElementById('Lote').disabled = false;
    document.getElementById('vencimiento').disabled = false;
    document.getElementById('Codigo').disabled = false;


}
// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    $joya=2;
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar origen';
    document.getElementById('Categoria').disabled = true;
    document.getElementById('Lote').disabled = true;
    document.getElementById('vencimiento').disabled = true;
    document.getElementById('Codigo').disabled = true;
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id', id);

    fetch(API_PRODUCTO + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('id').value = response.dataset.codigoproducto;
                    document.getElementById('Codigo').value = response.dataset.codigoproducto;
                    document.getElementById('Nombre').value = response.dataset.nombreproducto;
                    document.getElementById('Categoria').value = response.dataset.categoria;
                    document.getElementById('Lote').value = response.dataset.lote;
                    document.getElementById('vencimiento').value = response.dataset.vencimiento;
                    document.getElementById('Comentarios').value = response.dataset.comentario;
                    M.updateTextFields();
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}



document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if ($joya==2) {
        action = 'update';
    } else {
         action = 'create';
    }
    saveRow(API_PRODUCTO, action, 'save-form', 'save-modal');
    });