<?php
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
} else {
    require 'header.php';

    if ($_SESSION['grupos'] == 1) {
?>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h1 class="box-title">Gestión de Actividades</h1>
                            <div class="box-tools pull-right">
                                <!-- Botón para abrir el modal de agregar actividad -->
                                <button class="btn btn-primary" id="btnAgregarActividad"><i class="fa fa-plus-circle"></i> Agregar Actividad</button>
                                <!-- Botón para volver -->
                                <a href="../vistas/vista_grupo.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>">
                                    <button class="btn btn-success"><i class='fa fa-arrow-circle-left'></i> Volver</button>
                                </a>
                                <input type="hidden" id="idgrupo" name="idgrupo" value="<?php echo $_GET["idgrupo"]; ?>">
                            </div>
                        </div>

                        <!-- Selector del curso (proyecto) - Ocupa toda la fila -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-inline">
                                    <select name="curso" id="curso" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="">Seleccione un proyecto</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Actividad</th>
                                        <th>Descripción</th>
                                        <th>Fecha Límite</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Actividad</th>
                                        <th>Descripción</th>
                                        <th>Fecha Límite</th>
                                        <th>Estado</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Modal para agregar o editar una actividad -->
                        <div id="modalActividad" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title">Registrar Actividad</h4>
                                    </div>

                                    <div class="modal-body">
                                        <form action="" name="formulario" id="formulario" method="POST">
                                            <div class="form-group">
                                                <input type="hidden" id="id_actividad" name="id_actividad">
                                                <input type="hidden" id="idcurso" name="idcurso">
                                                <label for="nombre">Nombre Actividad(*):</label>
                                                <input class="form-control" type="text" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Descripción(*):</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="fecha_limite">Fecha Límite(*):</label>
                                                <input type="date" class="form-control" id="fecha_limite" name="fecha_limite" required>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                                                <button class="btn btn-danger" type="button" id="btnCancelar" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Fin del modal -->
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php 
    } else {
        require 'noacceso.php'; 
    }
    require 'footer.php';
?>
<!-- Carga del script específico de la vista -->
<script src="scripts/actividad.js"></script>

<script>
    $(document).ready(function () {
        var idGrupo = $("#idgrupo").val(); // Obtener el ID del grupo desde el campo oculto

        // Cargar los proyectos para el grupo actual
        $.post("../ajax/cursos.php?op=selectCursos", { idgrupo: idGrupo }, function (r) {
            $("#curso").html(r);
            $('#curso').selectpicker('refresh');

            if ($("#curso").val()) {
                listar(); // Llamar a listar actividades con el proyecto preseleccionado
            }
        });

        // Cargar los beneficiarios para el formulario del modal basado en el grupo seleccionado
        $.post("../ajax/actividad.php?op=selectBeneficiarios", { idgrupo: idGrupo }, function (r) {
            console.log("Beneficiarios cargados:", r);
            $("#alumn_id").html(r);
            $('#alumn_id').selectpicker('refresh');
        });
    });
</script>


<script type="text/javascript">
function asignarBeneficiarios(id_actividad) {
    window.location.href = "actividad_detalle.php?id=" + id_actividad;
}
</script>



<?php 
}
ob_end_flush();
?>