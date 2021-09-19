<?php
//Clase para definir las plantillas de las páginas web del sitio privado
class Dashboard_Page {
    //Método para imprimir el encabezado y establecer el titulo del documento
    public static function headerTemplate($title) {
        session_start();
        self::modals();
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
                        <a href="#" data-target="mobile" class="sidenav-trigger">
                        <i class="material-icons">menu</i>
                        </a>  
                        <ul class="left left hide-on-med-and-down">
                           <li><a href="index.php"><i class="material-icons left">home</i>Home</a></li>
                        </ul>                       
                            <ul class="right hide-on-med-and-down">
                            <li><a href="existencias.php"><i class="material-icons left">assignment</i>Existencias</a></li>
                            <li><a href="registro.php"><i class="material-icons left">description</i>Registro</a></li>
                            <li><a href="origen.php"><i class="material-icons left">location_on</i>Origen/Destino</a></li>
                            <li><a href="productos.php"><i class="material-icons left">local_pharmacy</i>Productos</a></li>
                            <li><a href="usuario.php"><i class="material-icons left">folder_shared</i>Gestion de Usuarios</a></li>
                            <li><a href="vendedores.php"><i class="material-icons left">people</i>Vendedores</a></li>
                            <li><a href="#" class="dropdown-trigger" data-target="dropdowns"><i class="material-icons left">verified_user</i>Cuenta: <b>' . $_SESSION['usuario'] . '</b></a></li>
                            </ul>
                            <ul id="dropdowns" class="dropdown-content">
                            <li><a href="#" onclick="openProfileDialog()"><i class="material-icons">face</i>Editar perfil</a></li>
                             <li><a href="#" onclick="openPasswordDialog()"><i class="material-icons">lock</i>Cambiar clave</a></li>
                              <li><a href="#" onclick="logOut()"><i class="material-icons">clear</i>Salir</a></li>
                            </ul>
                        </div>  
                    </nav>

                    <ul id="mobile" class="sidenav" >
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
                    <li><a href="#" class="dropdown-trigger" data-target="dropdown"><i class="material-icons left">verified_user</i>Cuenta: <b>' . $_SESSION['usuario'] . '</b></a></li>
                    </li> 
                </ul> 
                <ul id="dropdown" class="dropdown-content">
                <!--   <li><a href="#" onclick="openProfileDialog()"><i class="material-icons">face</i>Editar perfil</a></li>-->
                <!--  <li><a href="#" onclick="openPasswordDialog()"><i class="material-icons">lock</i>Cambiar clave</a></li>-->
                  <li><a href="#" onclick="logOut()"><i class="material-icons">clear</i>Salir</a></li>
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
                <script type="text/javascript" src="../app/controllers/account.js"></script>                                
                <script type="text/javascript" src="../app/controllers/' . $controller . '"></script>
            </body>
            </html>
        ');
    }   
        private static function modals()
        {
            // Se imprime el código HTML de las cajas de dialogo (modals).
            print('
                <!-- Componente Modal para mostrar el formulario de editar perfil -->
                <div id="profile-modal" class="modal">
                    <div class="modal-content">
                        <h4 class="center-align">Editar perfil</h4>
                        <form method="post" id="profile-form">
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">person</i>
                                    <input id="nombres" type="text" name="nombres" class="validate" required/>
                                    <label for="nombres">Nombres</label>
                                </div> 
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">email</i>
                                    <input id="correos" type="email" name="correos" class="validate" required/>
                                    <label for="correos">Correo</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="usuarios" type="text" name="usuarios" class="validate" required/>
                                    <label for="usuarios">Alias</label>
                                </div>
                            </div>
                            <div class="row center-align">
                                <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                            </div>
                        </form>
                    </div>
                </div>
    
                <!-- Componente Modal para mostrar el formulario de cambiar contraseña -->
                <div id="password-modal" class="modal">
                    <div class="modal-content">
                        <h4 class="center-align">Cambiar contraseña</h4>
                        <form method="post" id="password-form">
                            <div class="row">
                                <div class="input-field col s12 m6 offset-m3">
                                    <i class="material-icons prefix">security</i>
                                    <input id="clave_actual" type="password" name="clave_actual" class="validate" required/>
                                    <label for="clave_actual">Clave actual</label>
                                </div>
                            </div>
                            <div class="row center-align">
                                <label>CLAVE NUEVA</label>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">security</i>
                                    <input id="clave_nueva_1" type="password" name="clave_nueva_1" class="validate" required/>
                                    <label for="clave_nueva_1">Clave</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">security</i>
                                    <input id="clave_nueva_2" type="password" name="clave_nueva_2" class="validate" required/>
                                    <label for="clave_nueva_2">Confirmar clave</label>
                                </div>
                            </div>
                            <div class="row center-align">
                                <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                            </div>
                        </form>
                    </div>
                </div>
            ');
    }                                                      
}

?>