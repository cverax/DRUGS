|<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getBrowser($user_agent){

if(strpos($user_agent, 'MSIE') !== FALSE)
   return 'Internet explorer';
 elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
   return 'Microsoft Edge';
 elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
    return 'Internet explorer';
 elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
   return "Opera Mini";
 elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
   return "Opera";
 elseif(strpos($user_agent, 'Firefox') !== FALSE)
   return 'Mozilla Firefox';
 elseif(strpos($user_agent, 'Chrome') !== FALSE)
   return 'Google Chrome';
 elseif(strpos($user_agent, 'Safari') !== FALSE)
   return "Safari";
 else
   return 'No hemos podido detectar su navegador';


}
$user_agent = $_SERVER['HTTP_USER_AGENT'];


function getPlatform($user_agent) {
   $plataformas = array(
      'Windows 10' => 'Windows NT 10.0+',
      'Windows 8.1' => 'Windows NT 6.3+',
      'Windows 8' => 'Windows NT 6.2+',
      'Windows 7' => 'Windows NT 6.1+',
      'Windows Vista' => 'Windows NT 6.0+',
      'Windows XP' => 'Windows NT 5.1+',
      'Windows 2003' => 'Windows NT 5.2+',
      'Windows' => 'Windows otros',
      'iPhone' => 'iPhone',
      'iPad' => 'iPad',
      'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
      'Mac otros' => 'Macintosh',
      'Android' => 'Android',
      'BlackBerry' => 'BlackBerry',
      'Linux' => 'Linux',
   );
   foreach($plataformas as $plataforma=>$pattern){
      if (preg_match('/(?i)'.$pattern.'/', $user_agent))
         return $plataforma;
   }
   return 'Otras';
}

$SO = getPlatform($user_agent);




$navegador = getBrowser($user_agent);
 

$_SESSION['browser']= $navegador;
$_SESSION['OS']=$SO;
print('
<div class="container">
  <div class="container-fluid">
<form  method="post"  id="session-form" class="sign-box enters" >

        <input id="browser" type="text" name="browser" class="hide"  value="'.$_SESSION['browser'].'"  />
        <input id="os" type="text" name="os" class="hide" value="'.$_SESSION['OS'].'" />
        <div class="sign-avatar">
                    <img src="../resources/img/farglosa.jpeg">
                </div>
                <span><i class="fas fa-user-alt"></i> Inicio de sesión</span><br/>
                <input class="hide" type="text" id="correo" name="correo"/>
            <div class="input-field col s12 m4 offset-m4">
                <i class="material-icons prefix">email</i>
                <input id="usuario" type="text" name="usuario" class="validate" autocomplete="off" required/>
                <label for="usuario">Usuario</label>
            </div>
            <div class="input-field col s12 m4 offset-m4">
                <i class="material-icons prefix">security</i>
                <input id="contraseña" type="password" name="contraseña" class="validate" autocomplete="off" required/>
                <label for="contraseña">Clave</label>
            </div>
              <p>
              <div class="col s12 center-align">
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar">Iniciar sesión <i class="material-icons">send</i></button>
                <br>
                <a href="inirecuperar.php" >Restaurar Contraseña</a>
            </div>
        </p>
</form>
</div>
</div>

');
//Clase para definir las plantillas de las páginas web del sitio privado
class Dashboard_Page {
    //Método para imprimir el encabezado y establecer el titulo del documento
    public static function headerTemplate($title) {
        session_start();
        print('
            <!DOCTYPE html>
            <html lang="es">
            <head>
            <!--Se establece la codificación de caracteres para el documento-->
            <meta charset="utf-8">
            <link type="image/jpeg" rel="icon" href="../resources/img/farglosa.jpeg"/>
            <!--Se importa la fuente de iconos de Google-->
            <!--Se importan los archivos CSS-->
            <link type="text/css" rel="stylesheet" href="../resources/css/materialize.min.css"/>
            <link type="text/css" rel="stylesheet" href="../resources/css/material_icons.css"/>
            <link type="text/css" rel="stylesheet" href="../resources/css/style.css"/>
            <!--Se informa al navegador que el sitio web está optimizado para dispositivos móviles-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <!--Título del documento-->
            <title>Farglosa - '.$title.'</title>
            </head>
            
            <body>
                <!--Encabezado del documento-->
                <header>


                </header>
                <!--Contenido principal del documento-->
                <main>
        ');
    }

    //Método para imprimir el pie y establecer el controlador del documento
    public static function footerTemplate($controller) {
        print('
                </main>
                <!--Pie del documento-->
                <footer class="page-footer blue-grey">
                    <div class="container">
                        <div class="row">
                            <div class="col l6 s12">
                                <h5 class="white-text">Drug International</h5>                               
                            </div>
                            <div class="col l4 offset-l2 s12">
                                <h5 class="white-text">Sitio Privado</h5>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright">
                        <div class="container">
                            © 2021 Copyright                            
                        </div>
                    </div>
                </footer>
                <!--Importación de archivos JavaScript al final del cuerpo para una carga optimizada-->
                <script type="text/javascript" src="../resources/js/materialize.min.js"></script>              
                <script type="text/javascript" src="../resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../app/helpers/components.js"></script>     
                <script type="text/javascript" src="../app/controllers/initialization.js"></script>                           
                <script type="text/javascript" src="../app/controllers/' . $controller . '"></script>
            </body>
            </html>
        ');
    }
}
?>