const API_USUARIO = '../app/api/usuario.php?action=';
const ENDPOINT_TIPO = '../app/api/usuario.php?action=readAlltipo';


document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_USUARIO);
});

function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {

        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.nombreusuario}</td>
                <td>${row.usuario}</td>
                <td>${row.correo}</td>
                <td>${row.tipou}</td>
                <td>
                    <a href="#" onclick="openUpdateDialog(${row.idusuario})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>  
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}


function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Ingresar Usuario';
    // Se establece el campo de archivo como obligatorio.
    document.getElementById('tipoempleado').disabled = false;
    document.getElementById('nombre').disabled = false;
    document.getElementById('usuario').disabled = false;
    document.getElementById('clave').disabled = false;
    document.getElementById('confclave').disabled = false;
    fillSelect(ENDPOINT_TIPO, 'tipoempleado',null);

}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    $nold = 1;
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar Usuario';
    document.getElementById('tipoempleado').disabled = true;
    document.getElementById('nombre').disabled = false;
    document.getElementById('usuario').disabled = false;
    document.getElementById('clave').disabled = true;
    document.getElementById('confclave').disabled = true;
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id', id);

    fetch(API_USUARIO + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('id').value = response.dataset.idusuario;
                    document.getElementById('nombre').value = response.dataset.nombreusuario;
                    document.getElementById('usuario').value = response.dataset.usuario;
                    document.getElementById('correo').value = response.dataset.correo;
                    fillSelect(ENDPOINT_TIPO, 'tipoempleado', value = response.dataset.IdTipoU);
                   
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
    if (document.getElementById('id').value) {
        action = 'update';
    } else {
        action = 'create';
    }
    saveRow(API_USUARIO, action, 'save-form', 'save-modal');
});


