<?php
// Se incluye la clase con las plantillas del documento.
require_once('../app/helpers/Pages/dashboardpage.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Existencias');
?>
<br>
<div class="container">
<div class="row card-panel">
<div class="input-field center-align ">
<h5>Existencias</h5>
<a href="../app/reports/dashboard/existencias.php" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="reporte general de existencias"><i class="material-icons">assignment</i></a>
</div>
</div>
</div>
<br>
<div class="container">
<div class="row card-panel">
<table class="responsive-table ">
    <!-- Cabeza de la tabla para mostrar los títulos de las columnas -->
    <thead>
        <tr>
             <th>Nombre de producto</th>
            <th>Codigo producto</th>
            <th>Lote</th>
            <th>Vencimiento</th>
            <th>Cantidad</th>
            <th>reporte</th>
        </tr>
    </thead>
    <!-- Cuerpo de la tabla para mostrar un registro por fila -->
    <tbody id="tbody-rowss">
    </tbody>
</table>
</div>
</div>
<!-- Componente Modal para mostrar una caja de dialogo -->


<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('existencias.js');
?>

