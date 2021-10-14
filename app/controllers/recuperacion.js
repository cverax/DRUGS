const API_USUARIO = '../app/api/usuario.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
  
});
document.getElementById('session-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
 // Se restauran los elementos del formulario.
 const data = new FormData();
 fetch(API_USUARIO + 'readTicket', {     
     method: 'post',
     body: data
 }).then(function (request) {
     // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
     if (request.ok) {
         request.json().then(function (response) {
             // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
             if (response.status) {  
                fetch(API_USUARIO + 'updatepass', {
                    method: 'post',
                    body: new FormData(document.getElementById('session-form'))
                }).then(function (request) {
                    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                    if (request.ok) {
                        request.json().then(function (response) {
                            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                            if (response.status) {
                                sweetAlert(1, response.message, 'login.php');
                            } else {
                                sweetAlert(2, response.exception, 'login.php');
                            }
                        });
                    } else {
                        console.log(request.status + ' ' + request.statusText);
                    }
                }).catch(function (error) {
                    console.log(error);
                });     
             } else {
                 // En caso contrario nos envia este mensaje
                 sweetAlert(2, response.exception, 'login.php');
             }
         });
     } else {
         console.log(request.status + ' ' + request.statusText);
     }
 }).catch(function (error) {
     console.log(error);
 });
});
