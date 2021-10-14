
<?php
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