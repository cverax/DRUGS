<?php
// Se incluye la clase con las plantillas del documento.
require_once('../app/helpers/Pages/dashboardpage.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Productos');
?>
<br>
<div class="container">
<div class="row card-panel">
<div class="input-field center-align col s6 ">
<h5>Productos</h5>
</div>
<div class="input-field center-align col s6">
        <!-- Enlace para abrir la caja de dialogo (modal) al momento de crear un nuevo registro -->
       
        <a href="#" onclick="openCreateDialog()" class="btn waves-effect indigo tooltipped" data-tooltip="Crear"><i class="material-icons">add_circle</i></a>
        <!-- Enlace para generar un reporte en formato PDF -->
        <a href="../app/reports/dashboard/productos.php" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de productos por categoría"><i class="material-icons">assignment</i></a>
    </div>
</div>
</div>
<br>
<div class="container">
<div class="row card-panel">
<table class="responsive-table highlight">
    <!-- Cabeza de la tabla para mostrar los títulos de las columnas -->
    <thead>
        <tr>
            <th>Codigo del producto</th>
            <th>Nombre del producto</th>
            <th>Categoria</th>
            <th>Lote</th>
            <th>Vencimiento</th>
            <th>Comentario</th>
            <th class="actions-column">Acciones</th>
        </tr>
    </thead>
    <!-- Cuerpo de la tabla para mostrar un registro por fila -->
    <tbody id="tbody-rows">
    </tbody>
</table>
</div>
</div>
<!-- Componente Modal para mostrar una caja de dialogo -->
<div id="save-modal" class="modal">
    <div class="modal-content">
        <!-- Título para la caja de dialogo -->
        <h4 id="modal-title" class="center-align"></h4>
        <!-- Formulario para crear o actualizar un registro -->
        <form method="post" id="save-form" enctype="multipart/form-data">
            <!-- Campo oculto para asignar el id del registro al momento de modificar -->
            <input class="hide" type="number" id="id" name="id"/>
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">note_add</i>
                    <input id="Codigo" type="number" name="Codigo"  min="1" step="any" class="validate" required/>
                    <label for="Codigo">Codigo del producto</label>
                </div> 
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">note_add</i>
                    <input id="Nombre" type="text" name="Nombre" class="validate" required/>
                    <label for="Nombre">Nombre del producto</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">note_add</i>
                    <input id="Categoria" type="text" name="Categoria" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required/>
                    <label for="Categoria">Categoria</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">note_add</i>
                    <input id="Lote" type="number" name="Lote" min="1" step="any"  class="validate" required/>
                    <label for="Lote">Lote</label>
                </div>
                <div class="input-field col s12 m6">
                <i class="material-icons prefix">cake</i>
                <input type="date" id="vencimiento" name="vencimiento" class="validate" required/>
                <label for="vencimiento">Fecha de vencimiento</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">note_add</i>
                <textarea id="Comentarios" name="Comentarios" class="materialize-textarea"></textarea>
                <label for="Comentarios">Comentarios</label>
            </div>
            </div>
            <div class="row center-align">
                <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
            </div>
        </form>
    </div>
</div>


<!-- Se muestran las gráficas de acuerdo con algunos datos disponibles en la base de datos -->
<div class="row">
    <div class="col s12 m6">
        <!-- Se muestra una gráfica de barra con la cantidad de productos por categoría -->
        <canvas id="chart1"></canvas>
    </div>
    <div class="col s12 m6">
        <!-- Se muestra una gráfica de pastel con el porcentaje de productos por categoría -->
        <canvas id="chart2"></canvas>
    </div>
</div>

<!-- Importación del archivo para generar gráficas en tiempo real. Para más información https://www.chartjs.org/ -->
<script type="text/javascript" src="../resources/js/chart.js"></script>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('productos.js');
?>
