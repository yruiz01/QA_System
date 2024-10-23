<?php
// Activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
} else 
    require 'header.php';
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-3" id="sidebar" style="background-color: white; border-right: 1px solid #ddd; height: calc(100vh - 20px); overflow-y: auto; padding: 10px;">
                <h5 class="mb-3 text-center">Listado de Actividades</h5>
                <ul class="list-group" id="activities">
                    <!-- Las actividades se cargarán aquí -->
                </ul>
            </div>

            <div class="col-md-9">
                <div class="box">
                    <div class="panel-body" style="padding: 20px; height: calc(100vh - 20px);">
                        <!-- Calendario -->
                        <div id="calendar" style="height: 100%;"></div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal para ver detalles de la actividad -->
<div class="modal fade" id="modalActivityDetails" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff; color: white;">
                <h5 class="modal-title" id="modalTitleId">Detalles de la Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 20px; background-color: #f9f9f9;">
                <p id="activityDetails" style="font-size: 16px;"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar y dependencias -->
<link href="../node_modules/fullcalendar/main.min.css" rel="stylesheet" />
<script src="../node_modules/fullcalendar/main.min.js"></script>
<script src="../node_modules/fullcalendar/locales/es.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../vistas/scripts/calendario.js"></script>

<!-- Agrega Font Awesome para el ícono -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Script de inicialización y gestión de actividades -->
<script>
    $(document).ready(function() {
        // Obtener la fecha actual
        var today = new Date().toISOString().split('T')[0]; // Formato YYYY-MM-DD
        
        // Cargar actividades desde la base de datos
        $.ajax({
            url: '../ajax/cargar_actividades.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Verificar que hay datos antes de intentar filtrarlos
                if (data && Array.isArray(data)) {
                    // Filtrar y ordenar actividades por fecha
                    var filteredActivities = data.filter(function(actividad) {
                        return actividad.fecha_limite >= today;
                    });

                    filteredActivities.sort(function(a, b) {
                        return new Date(a.fecha_limite) - new Date(b.fecha_limite);
                    });

                    // Iterar sobre los datos y generar las actividades
                    filteredActivities.forEach(function(actividad) {
                        $('#activities').append(
                            `<li class="list-group-item actividad" data-id="${actividad.id}">${actividad.nombre} - ${actividad.fecha_limite}</li>`
                        );
                    });
                } else {
                    $('#activities').append('<li class="list-group-item">No hay actividades disponibles.</li>');
                }
            },
            error: function() {
                $('#activities').append('<li class="list-group-item">Error al cargar las actividades.</li>');
            }
        });

        // Manejar el clic en las actividades de la lista
        $('#activities').on('click', '.actividad', function() {
            var actividadId = $(this).data('id');
            highlightActivity(actividadId);
            loadActivityDetails(actividadId);
        });

        // Inicializar FullCalendar
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay' // Opciones de vista
            },
            aspectRatio: 1.5,
            height: 'auto',
            contentHeight: 'auto',
            events: '../ajax/get_calendario.php',
            eventClick: function(info) {
                var actividadId = info.event.id;
                highlightActivity(actividadId);
                loadActivityDetails(actividadId);
            },
            eventDidMount: function(info) {
                const today = new Date();
                const eventDate = new Date(info.event.start);
                const diffTime = eventDate - today;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // Cambiar color según la diferencia de días
                if (info.event.start < today) {
                    info.el.style.backgroundColor = 'green'; // Actividades pasadas
                } else if (diffDays <= 7) {
                    info.el.style.backgroundColor = 'blue'; // Actividades próximas
                } else {
                    info.el.style.backgroundColor = 'red'; // Actividades futuras
                }
            }
        });
        calendar.render();

        $(window).resize(function() {
            calendar.updateSize();
        });

        // Resaltar actividad seleccionada y cargar detalles
        function highlightActivity(actividadId) {
            // Restablecer color de todas las actividades
            $('#activities .actividad').removeClass('active');

            // Resaltar la actividad seleccionada
            $('#activities .actividad[data-id="' + actividadId + '"]').addClass('active');
        }

        // Cargar detalles de la actividad
        function loadActivityDetails(actividadId) {
            $.ajax({
                url: '../ajax/cargar_detalles.php',
                method: 'GET',
                data: { id: actividadId },
                dataType: 'json',
                success: function(detalle) {
                    $('#activityDetails').text(detalle.descripcion || 'No hay detalles disponibles.');
                    $('#modalActivityDetails').modal('show'); // Mostrar modal
                },
                error: function() {
                    $('#activityDetails').text('Error al cargar los detalles.');
                }
            });
        }
    });
</script>

<?php
require 'footer.php';
?>
