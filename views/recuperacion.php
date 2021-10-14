<?php
//Captura el token de la url
$_REQUEST['tokens'];
include('../app/helpers/Pages/recuperacione.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Recuperador de contraseña');

?>   
<br>
     
<link href="../resources/css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />
<div class="container">
  <div class="container-fluid">
            <form  method="post" id="session-form" class="sign-box enters" >
           
            <div class="sign-avatar">
                <span><i class="fas fa-user-alt"></i> Recuperador de contraseña </span><br/>
                    <img src="../resources/img/farglosa.jpeg">
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
              <p>
              <div class="col s12 center-align">
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar">Recuperar <i class="material-icons">send</i></button>
            </div>
        </p>
        
        </form>
  </div>
</div>


<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('recuperacion.js');
?>