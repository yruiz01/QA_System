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
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" id="idgrupo" name="idgrupo" value="<?php echo $_GET["idgrupo"];?>">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs pull-right">
                                    <li class="bg-green">
                                        <a href="../vistas/vista_grupo.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class='fa fa-arrow-circle-left'></i> Volver</a>
                                    </li>
                                    <li class="bg-aqua"><a href="#tab_1-1" data-toggle="tab">Proyectos</a></li>
                                    <li class="bg-yellow"><a href="#tab_2-2" data-toggle="tab">Asistencia</a></li>
                                    <li class="active bg-blue"><a href="#tab_4-2" data-toggle="tab">Actividades</a></li> <!-- Nueva pestaña de Actividades -->
                                    <li class="pull-left header"><i class="fa fa-list"></i> Listas</li>
                                </ul>

                                <div class="tab-content">
                                    <!-- Proyectos -->
                                    <div class="tab-pane" id="tab_1-1">
                                        <div class="panel-body table-responsive" id="listadoregistroscalif">
                                            <div id="datacalif"></div>
                                        </div>
                                    </div>

                                    <!-- Estado -->
                                    <div class="tab-pane" id="tab_2-2">
                                        <div class="table-responsive">
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Fecha Inicio</label>
                                                <input type="date" class="form-control" name="fecha_inicioc" id="fecha_inicioc" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Fecha Fin</label>
                                                <input type="date" class="form-control" name="fecha_finc" id="fecha_finc" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>
                                        <div class="panel-body table-responsive" id="listadoregistrosc">
                                            <div id="datac"></div>
                                        </div>
                                    </div>


                                    <!-- Nueva pestaña de Actividades -->
                                    <div class="tab-pane active" id="tab_4-2">
                                        <div class="table-responsive">
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Fecha Inicio</label>
                                                <input type="date" class="form-control" name="fecha_inicioa" id="fecha_inicioa" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Fecha Fin</label>
                                                <input type="date" class="form-control" name="fecha_fina" id="fecha_fina" value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>
                                        <div class="panel-body table-responsive" id="listadoregistrosa">
                                            <div id="dataa"></div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- nav-tabs-custom -->
                        </div>
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
<script src="scripts/listasis.js"></script>
<?php 
}
ob_end_flush();
?>
