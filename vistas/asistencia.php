<?php 
require 'header.php';
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Asistencia</h1>
                        <div class="box-tools pull-right">
                            <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nueva Asistencia</button>
                        </div>
                    </div>

                    <!-- Formulario de asistencia -->
                    <div class="panel-body" id="formularioregistros">
                        <form id="formulario_asis" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Tipo de asistencia:</label>
                                <select id="tipo_asistencia" name="kind_id" class="form-control selectpicker" required>
                                    <option value="1">Asistencia</option>
                                    <option value="2">Ausente</option>
                                </select>
                            </div>
                            <input type="hidden" id="alumn_id" name="alumn_id">
                            <input type="hidden" id="idasistencia" name="id">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                        </form>
                    </div>

                    <!-- Listado de asistencias -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody> </tbody>
                            <tfoot>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Modal -->
                    <div id="getCodeModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Registrar Asistencia</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="formulario" name="formulario">
                                        <input type="hidden" name="alumn_id" id="alumn_id">
                                        <input type="hidden" name="id" id="idasistencia">
                                        <div class="form-group">
                                            <label for="tipo_asistencia">Tipo de Asistencia</label>
                                            <select name="kind_id" id="tipo_asistencia" class="form-control selectpicker" required>
                                                <option value="1">Asistencia</option>
                                                <option value="2">Ausente</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.box -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </section>
</div>

<?php 
require 'footer.php';
?>
<script type="text/javascript" src="scripts/asistencia.js"></script>
