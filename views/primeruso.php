<?php
// Se incluye la clase con las plantillas del documento.
include('../app/helpers/Pages/recuperacione.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Registrar primer usuario');
?>

<!-- Formulario para registrar al primer usuario del dashboard -->
<form method="post" id="register-form">
    <div class="row">
        <h6 >Bienvenido al primer uso del sistema porfavor ingrese el primer usuario para empezar</h6>
        <div class="input-field col s12 m6">
          	<i class="material-icons prefix">person</i>
          	<input id="nombre" type="text" name="nombre" class="validate" required/>
          	<label for="nombre">Nombres</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">email</i>
            <input id="correo" type="email" name="correo" class="validate" required/>
            <label for="correo">Correo</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">person_pin</i>
            <input id="usuario" type="text" name="usuario" class="validate" required/>
            <label for="usuario">Usuario</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">security</i>
            <input id="clave" type="password" name="clave" class="validate" required/>
            <label for="clave">Clave</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">security</i>
            <input id="confclave" type="password" name="confclave" class="validate" required/>
            <label for="confclave">Confirmar clave</label>
        </div>
    </div>
    <div class="row center-align">
 	    <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Registrar"><i class="material-icons">send</i></button>
    </div>
</form>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('register.js');
?>
