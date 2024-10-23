<?php
// Activamos almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
} else {
    require 'header.php';
    
    if ($_SESSION['grupos'] == 1) { 
?>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h1 class="box-title">Beneficiarios asignados a la actividad</h1>
                            <!-- Campo oculto para almacenar el id de la actividad -->
                            <input type="hidden" id="idactividad" name="idactividad" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                        </div>
                        
                        <!-- Panel para mostrar beneficiarios relacionados -->
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    <!-- Aquí se insertarán las filas dinámicamente -->
                                </tbody>
                                <tfoot>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Acciones</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Formulario para asignar un nuevo beneficiario -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h1 class="box-title">Asignar Nuevo Beneficiario</h1>
                        </div>
                        <div class="panel-body">
                            <form id="formularioBeneficiario" method="POST">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Seleccionar Beneficiario:</label>
                                    <select id="id_beneficiario" name="id_beneficiario" class="form-control selectpicker" required>
                                        <!-- Aquí se cargarán los beneficiarios no asignados -->
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Asignar Beneficiario</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

<?php 
    } else {
        require 'noacceso.php'; 
    }
    require 'footer.php';
?>
<!-- Script de la vista -->
<script src="scripts/actividad_detalle.js"></script>

<script>
// Ejecutar mostrarBeneficiarios al cargar la página
$(document).ready(function () {
    mostrarBeneficiarios();
    cargarBeneficiariosNoAsignados();  // Cargar los beneficiarios no asignados
});
</script>

<?php
}
ob_end_flush();
?>
