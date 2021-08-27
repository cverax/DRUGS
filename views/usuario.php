<?php
// Se incluye la clase con las plantillas del documento.
require_once('../app/helpers/Pages/dashboardpage.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Usuarios');
?>
<br>
<div class="container">
<div class="row card-panel">
<div class="input-field col s6 m4">
<h4>Gestion de usuarios</h4>
</div>
    <div class="input-field right-align col s12 m4">
        
        <a href="#" onclick="openCreateDialog()" class="btn waves-effect indigo tooltipped" data-tooltip="Crear"><i class="material-icons">add_circle</i></a>
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
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Tipo usuario</th>
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
                <i class="material-icons prefix">person</i>
                <input id="nombre" type="text" name="nombre" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}"  class="validate" required/>
                <label for="nombre">Nombre Empleado</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">account_circle</i>                            
                <input id="usuario" type="text" name="usuario" class="validate" required/>
                <label for="usuario">Usuario</label>
            
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
                <div class="input-field col s12 m6">
                <select  id="tipoempleado" name="tipoempleado" class="validate">
                </select>
                    <label>Tipo empleado</label>
             </div>
            </div>
            <div class="row center-align">
                <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
            </div>
        </form>
    </div>
</div>
<div id="save-modals" class="modal">
    <div class="modal-content">
        <!-- Título para la caja de dialogo -->
        <h4 id="modal-titles" class="center-align"></h4>
        <!-- Formulario para crear o actualizar un registro -->
        <form method="post" id="save-forms" enctype="multipart/form-data">
            <!-- Campo oculto para asignar el id del registro al momento de modificar -->
            <input class="hide" type="number" id="ids" name="ids"/>
            <div class="row">
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">person</i>
                <input id="nombre" type="text" name="nombre" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}"  class="validate" required/>
                <label for="nombre">Nombre Empleado</label>
            </div>
             <div class="input-field col s6">
                    <i class="material-icons prefix">security</i>
                    <input id="clave" type="password" name="clave" class="validate" required/>
                    <label for="clave">Clave</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">security</i>
                    <input id="confclave" type="password" name="confclave" class="validate" required/>
                    <label for="confclave">Confirmar clave</label>
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
Dashboard_Page::footerTemplate('usuario.js');
?>
