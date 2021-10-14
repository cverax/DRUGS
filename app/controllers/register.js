// Método manejador de eventos que se ejecuta cuando se envía el formulario de iniciar sesión.
const API_LOGIN = '../app/api/login.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    // Se inicializa el componente Tooltip asignado al botón del formulario para que funcione la sugerencia textual.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));

    Registrar();
});
function Registrar() {
// Petición para verificar si existen usuarios.
fetch(API_LOGIN + 'readAll', {
    method: 'get'
}).then(function (request) {
    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
    if (request.ok) {
        request.json().then(function (response) {
            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
            if (response.status) {
                sweetAlert(3, response.exception, 'login.php');

            } else {
                // Se verifica si ocurrió un problema en la base de datos, de lo contrario se continua normalmente.
                if (response.error) {
                    sweetAlert(2, response.exception, null);
                } else {
                    sweetAlert(4, 'Debe crear un usuario para comenzar', null);
                }
            }
        });
    } else {
        console.log(request.status + ' ' + request.statusText);
    }
}).catch(function (error) {
    console.log(error);
});
}

document.getElementById('register-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    fetch(API_LOGIN + 'readAll', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
                if (response.status) {
                    sweetAlert(4, 'Intento de ingreso invalido', 'login.php');

                } else {
                    // Se verifica si ocurrió un problema en la base de datos, de lo contrario se continua normalmente.
                    if (response.error) {
                        sweetAlert(2, response.exception, null);
                    } else {
                        fetch(API_LOGIN + 'create', {
                            method: 'post',
                            body: new FormData(document.getElementById('register-form'))
                        }).then(function (request) {
                            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                            if (request.ok) {
                                request.json().then(function (response) {
                                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                                    if (response.status) {
                                        sweetAlert(1, response.message, 'login.php');
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
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
    
});