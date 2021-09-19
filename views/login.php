<?php
//Se incluye la clase con las plantillas del documento
include('../app/helpers/Pages/loginPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Iniciar sesion');
?>   
<br>
     
<link href="../resources/css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />
  
<div class="container">
  <div class="container-fluid">
            <form  method="post" id="session-form" class="sign-box enters" >
                <div class="sign-avatar">
                    <img src="../resources/img/farglosa.jpeg">
                </div>
                <span><i class="fas fa-user-alt"></i> Inicio de sesión</span><br/>
            <div class="form-group">
                <input id="usuario" type="text" name="usuario" class="validate" autocomplete="off" required/>
            </div>
            <div class="form-group">
                <input id="contraseña" type="password" name="contraseña" class="validate" autocomplete="off" required/>
            </div>
              <p>
              <div class="col s12 center-align">
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar">Iniciar sesión <i class="material-icons">send</i></button>
            </div>
        </p>
        
        </form>
  </div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('login.js');
?>