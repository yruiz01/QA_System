<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['grupos']==1) {

   $idgrupo = $_GET['idgrupo'];
   require_once "../modelos/Grupos.php";
   $grupos = new Grupos();
   $rspta = $grupos->mostrar_grupo($idgrupo);
   $reg = $rspta->fetch_object();
   $nombre_grupo = $reg->nombre;
?>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h1 class="box-title">Registro de Asistencia<?php echo $nombre_grupo; ?></h1>
                            <div class="box-tools pull-right">
                                <a href="../vistas/vista_grupo.php?idgrupo=<?php echo $idgrupo; ?>"><button class="btn btn-success"><i class='fa fa-arrow-circle-left'></i> Volver</button></a>
                                <a href="../vistas/grupos.php"><button class="btn btn-info"><i class='fa fa-th-large'></i> Comunidades</button></a>
                            </div>
                        </div>
                        <!-- box-header -->
                        <!-- centro -->
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Opciones</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th>Opciones</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                </tfoot>   
                            </table>
                        </div>
                        <!-- fin centro -->
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Modal para seleccionar fecha y tipo de conducta -->
    <div class="modal fade" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-calendar-check-o"></i> Seleccione la Fecha de Asistencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="formulario_asis" id="formulario_asis" method="POST">
                        <div class="form-group">
                            <label for="fecha_conducta">Fecha de Asistencia:</label>
                            <input type="date" class="form-control" id="fecha_conducta" name="fecha_conducta" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo_conducta">Tipo de Asistencia:</label>
                            <select class="form-control" id="tipo_conducta" name="tipo_conducta" required>        
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="1">Asistió</option>
                                <option value="2">No Asistió</option>
                            </select>
                        </div>
                        <input type="hidden" id="idconducta" name="idconducta">
                        <input type="hidden" id="alumn_id" name="alumn_id">
                        <input type="hidden" id="idgrupo" name="idgrupo" value="<?php echo $idgrupo; ?>">
                        <div class="form-group text-center mt-3">
                            <button class="btn btn-primary" type="submit" id="btnGuardar_asis"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" data-dismiss="modal" type="button"><i class="fa fa-times-circle"></i> Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php 
}else{
    require 'noacceso.php'; 
}
require 'footer.php';
?>
<script src="scripts/conducta.js"></script>
<?php 
}
ob_end_flush();
?>
