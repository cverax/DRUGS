<?php
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
                    <nav class="blue-grey darken-2">
                        <div class="nav-wrapper">
                        <a href="#" data-target="slide-out" class="sidenav-trigger show-on-med">
                        <i class="material-icons">menu</i>
                        </a>  
                        <ul class="left left hide-on-med-and-down">
                           <li><a href="index.php"><i class="material-icons left">home</i>Home</a></li>
                        </ul>                       
                            <ul class="right right hide-on-med-and-down">
                            <li><a href="existencias.php"><i class="material-icons left">assignment</i>Existencias</a></li>
                            <li><a href="registro.php"><i class="material-icons left">description</i>Registro</a></li>
                            <li><a href="origen.php"><i class="material-icons left">location_on</i>Origen/Destino</a></li>
                            <li><a href="productos.php"><i class="material-icons left">local_pharmacy</i>Productos</a></li>
                            <li><a href="usuario.php"><i class="material-icons left">folder_shared</i>Gestion de Usuarios</a></li>
                            <li><a href="vendedores.php"><i class="material-icons left">people</i>Vendedores</a></li>
                            <li><a href="#" onclick="logOut()><i class="material-icons left"></i>Cerrar sesión</a></li>
                                                            
                            </ul>
                        </div>  
                    </nav>

                    <ul id="slide-out" class="sidenav" >
                    <li>  
                        <div class="user-view">
                            <div class="background">
                                <img src="../resources/img/fonfo12.jpg"> 
                            </div>
                            <a href="#user"><img class="circle" src="../resources/img/default-user-image.png"></a>
                           
                            
                        </div>
                    <li>
                        <li class="hide-on-large-only"><a href="index.php"><i class="material-icons left">home</i>Home</a></li>                                                   
                    </li>                                               
                    <li><div class="divider"></div></li>          
                    <li><a href="existencias.php"><i class="material-icons">assignment</i>Existencias</a></li>
                    <li><a href="registro.php"><i class="material-icons">description</i>Registro</a></li>
                    <li><div class="divider"></div></li>
                    <li><a href="origen.php"><i class="material-icons">location_on</i>Origen/Destino</a></li>
                    <li><a href="productos.php"><i class="material-icons">local_pharmacy</i>Productos</a></li>
                    <li><a href="usuario.php"><i class="material-icons">folder_shared</i>Gestion de Usuarios</a></li>
                    <li><a href="vendedores.php"><i class="material-icons">people</i>Vendedores</a></li>
                    <li><div class="divider"></div></li>
                    <li><a href="#" onclick="logOut()><i class="material-icons left"></i>Cerrar sesión</a></li>
                    </li> 
                </ul> 


                


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
                <footer class="page-footer blue-grey darken-2">
                    <div class="container">
                        <div class="row">
                            <div class="col l6 s12">
                                <h5 class="white-text">Farglosa Administrativo</h5>                               
                            </div>
                            <div class="col l4 offset-l2 s12">
                                <h5 class="white-text">Sitio Público</h5>
                                
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