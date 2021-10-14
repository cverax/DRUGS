<?php
//Se incluye la clase con las plantillas del documento
include('../app/helpers/Pages/loginPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Iniciar sesion');
?>   
<br>
     
<link href="../resources/css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />
  
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('login.js');
?>