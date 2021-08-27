const API_REGISTRO = '../app/api/registro.php?action=';
const ENDPOINT_VTA = '../app/api/registro.php?action=readAllvta';
const ENDPOINT_DOC = '../app/api/registro.php?action=readAllDocumentos';
const ENDPOINT_PROC = '../app/api/registro.php?action=readAllproducto';
const ENDPOINT_ORIGEN = '../app/api/registro.php?action=readAllorigen';
const ENDPOINT_VEN = '../app/api/registro.php?action=readAllvendedor';


document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_REGISTRO);
});

function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {

        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.fecha}</td>
                <td>${row.vta}</td>
                <td>${row.documentos}</td>
                <td>${row.numerocomprobante}</td>
                <td>${row.nombreproducto}</td>
                <td>${row.lote}</td>
                <td>${row.categoria}</td>
                <td>${row.origen}</td>
                <td>${row.vendedor}</td>
                <td>${row.cantidad}</td>
               
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}
// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_REGISTRO, 'search-form');
});

function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Ingresar Usuario';
    fillSelect(ENDPOINT_VTA, 'VTA',null);
    fillSelect(ENDPOINT_DOC, 'tipo',null);
     fillSelect(ENDPOINT_PROC, 'Producto',null);
     fillSelect(ENDPOINT_ORIGEN, 'Destino',null);
    fillSelect(ENDPOINT_VEN, 'Vendedor',null);

}

document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    action = 'create';
    saveRow(API_REGISTRO, action, 'save-form', 'save-modal');
});
