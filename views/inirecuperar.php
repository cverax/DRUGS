<?php
//Se incluye la clase con las plantillas del documento
include('../app/helpers/Pages/recuperacione.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Recuperador de contraseña');
?>   
<br>
     
<link href="../resources/css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />
  
<div class="container">
  <div class="container-fluid">
            <form  method="post" id="mail-form" class="sign-box enters" >
                <div class="sign-avatar">
                <span><i class="fas fa-user-alt"></i> Recuperador de contraseña </span><br/>
                    <img src="../resources/img/farglosa.jpeg">
                </div>
            <div class="input-field col s12 m6">
                <input type="text"  id="usuario" name="usuario" class="validate" autocomplete="off" required/>
                <label for="usuario">Usuario</label>
            </div>
              <p>
              <div class="col s12 center-align">
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar">Recuperar <i class="material-icons">send</i></button>
                <br>
                <a href="login.php" >Volver <- </a>
            </div>
            
        </p>
        
        </form>
  </div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('inirecuperacion.js');
?>