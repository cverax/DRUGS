<?php
// Se incluye la clase con las plantillas del documento.
require_once('../app/helpers/Pages/dashboardpage.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Página principal');
?>
        <div class="col-12 text-center" id="TituloIndex">
            <a id="fontmain"><h4 class="text-center blue-text" id="greeting"></h4></a>    
        </div>  
<main>
        <Section>
            <div class="container">
                    <canvas id="chart1"></canvas>
                    <canvas id="chart2"></canvas>
            </div>
        </Section>   
</main>
<!-- Importación del archivo para generar gráficas en tiempo real. Para más información https://www.chartjs.org/ -->
<script type="text/javascript" src="../resources/js/chart.js"></script>
    
<?php
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::footerTemplate('index.js');
?>