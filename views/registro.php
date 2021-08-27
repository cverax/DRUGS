<?php
// Se incluye la clase con las plantillas del documento.
require_once('../app/helpers/Pages/dashboardpage.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Registro');
?>
<br>
<div class="container">
<div class="row card-panel">
    <form method="post" id="search-form">
        <div class="input-field col s6 m4">
            <i class="material-icons prefix">search</i>
            <input id="search" type="text" name="search" required/>
            <label for="search">Buscador</label>
        </div>
        <div class="input-field col s6 m4">
            <button type="submit" class="btn waves-effect green tooltipped" data-tooltip="Buscar"><i class="material-icons">check_circle</i></button>
        </div>
    </form>
    <div class="input-field center-align col s12 m4">
        <!-- Enlace para abrir la caja de dialogo (modal) al momento de crear un nuevo registro -->
          <a href="#" onclick="openCreateDialog()" class="btn waves-effect indigo tooltipped" data-tooltip="Crear"><i class="material-icons">add_circle</i></a>
          <a href="../app/reports/dashboard/registro.php" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de lotes por fecha"><i class="material-icons">assignment</i></a>
    </div>
</div>
</div>
<br>
<div class="container">
<table class="responsive-table ">
    <!-- Cabeza de la tabla para mostrar los títulos de las columnas -->
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Codigo VTA</th>
            <th>Tipo de documento</th>
            <th>Numero de comprobante</th>
            <th>Producto</th>
            <th>lote</th>
            <th>Categoria</th>
            <th>Origen/Destino</th>
            <th>Vendedor</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <!-- Cuerpo de la tabla para mostrar un registro por fila -->
    <tbody id="tbody-rows">
    </tbody>
</table>
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
                <i class="material-icons prefix">cake</i>
                <input type="date" id="vencimiento" name="vencimiento" class="validate" required/>
                <label for="vencimiento">Fecha </label>
            </div> 
                <div class="input-field col s6 right">
                            <select id="VTA" name="VTA">
                            </select>
                            <label>Codigo VTA</label>
                         </div>
                <div class="input-field col s6 right">
                            <select id="tipo" name="tipo">
                            </select>
                            <label>Tipo Documento</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">note_add</i>
                    <input id="comprobante" type="number" name="comprobante" min="1" step="any"  class="validate" required/>
                    <label for="comprobante">Numero de comprobante</label>
                </div>
                <div class="input-field col s6 right">
                            <select id="Producto" name="Producto">
                            </select>
                            <label>Producto</label>
                </div>
                <div class="input-field col s6 right">
                            <select id="Destino" name="Destino">
                            </select>
                            <label>Origen/Destino</label>
                </div>
                <div class="input-field col s6 right">
                            <select id="Vendedor" name="Vendedor">
                            </select>
                            <label>Vendedor</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">note_add</i>
                    <input id="Cantidad" type="number" name="Cantidad" min="1" step="any"  class="validate" required/>
                    <label for="Cantidad">Cantidad</label>
                </div>
            </div>
            <div class="row center-align">
                <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
            </div>
        </form>
    </div>
</div>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('registro.js');
?>