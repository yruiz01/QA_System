var tabla;

// Función que se ejecuta al inicio
function init() {
    listar(); // Llamar a la función para listar actividades al iniciar

    // Cargar las opciones de cursos basadas en el grupo seleccionado
    var team_id = $("#idgrupo").val();
    $.post("../ajax/cursos.php?op=selectCursos", { idgrupo: team_id }, function (r) {
        $("#curso").html(r);
        $('#curso').selectpicker('refresh');
    });

    // Cargar los beneficiarios para el formulario del modal basado en el grupo
    $.post("../ajax/actividad.php?op=selectBeneficiarios", { idgrupo: team_id }, function (r) {
        console.log("Respuesta de selectBeneficiarios con team_id:", r); // Verificar la respuesta en la consola
        $("#alumn_id").html(r);
        $('#alumn_id').selectpicker('refresh');
    });

    // Mostrar el formulario al hacer clic en "Agregar Actividad"
    $("#btnAgregarActividad").click(function () {
        limpiar(); // Limpiar el formulario antes de mostrarlo
        $("#modalActividad").modal("show"); // Mostrar el modal con el formulario
    });

    // Asociar la función `guardaryeditar` al evento `submit` del formulario
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

    // Actualizar el ID del curso cuando cambie el select y listar actividades
    $("#curso").change(function () {
        var idcurso = $("#curso").val(); 
        $("#idcurso").val(idcurso); // Actualizar el campo oculto con el ID del curso seleccionado
        listar(); // Volver a listar las actividades con el nuevo curso seleccionado
    });
}

// Función para limpiar los formularios y los campos
function limpiar() {
    $("#id_actividad").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#fecha_limite").val(""); // Limpiar el campo de fecha límite
    $("#alumn_id").val(""); // Limpiar el campo de beneficiario
    $("#curso").selectpicker('refresh');
    $('#modalActividad').modal('hide');
}

// Función para listar actividades vinculadas al proyecto seleccionado
function listar() {
    var block_id = $("#curso").val();
    console.log("Block ID enviado: '" + block_id + "'");

    if (!block_id) {
        console.warn("No se ha seleccionado un proyecto. El ID del curso está vacío.");
        return;
    }

    // Si la tabla ya está inicializada, destruirla antes de crear una nueva instancia
    if ($.fn.DataTable.isDataTable('#tbllistado')) {
        $('#tbllistado').DataTable().destroy();
    }

    // Inicializar DataTable con opciones y datos del servidor
    tabla = $('#tbllistado').DataTable({
        "processing": true,
        "serverSide": true,
        dom: 'Bfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        "ajax": {
            url: '../ajax/actividad.php?op=listar',
            type: "POST",
            dataType: "json",
            data: { idcurso: block_id }, // Enviar el ID del curso (block_id) como parámetro
            dataSrc: function (json) {
                console.log("Datos recibidos del servidor: ", json);
                if (!json.aaData) {
                    console.error("Formato de datos incorrecto o no hay datos: ", json);
                    return [];
                }
                return json.aaData;
            },
            error: function (e) {
                console.error("Error en la llamada AJAX: " + e.responseText);
            }
        },
        "columns": [
            { "data": 0, "title": "Opciones" },
            { "data": 1, "title": "Nombre" },
            { "data": 2, "title": "Descripción" },
            { "data": 3, "title": "Fecha Límite" },
            { "data": 4, "title": "Estado" }
        ],
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[1, "asc"]],
        "initComplete": function () {
            asignarEventos(); // Asignar eventos cuando la tabla esté completamente cargada
        }
    });
}

// Función para asignar eventos a los botones de activación y desactivación
function asignarEventos() {
    $('#tbllistado tbody').off('click').on('click', 'button.btn-warning', function () {
        var data = tabla.row($(this).parents('tr')).data();
        mostrar(data[0]); // Llamar a la función mostrar con el ID de la actividad
    });

    $('#tbllistado tbody').off('click').on('click', 'button.btn-danger', function () {
        var data = tabla.row($(this).parents('tr')).data();
        desactivar(data[0]); // Llamar a la función desactivar con el ID de la actividad
    });

    $('#tbllistado tbody').off('click').on('click', 'button.btn-primary', function () {
        var data = tabla.row($(this).parents('tr')).data();
        activar(data[0]); // Llamar a la función activar con el ID de la actividad
    });
}

// Función para guardar o editar actividades
function guardaryeditar(e) {
    e.preventDefault();
    $("#btnGuardar").prop("disabled", false);
    var formData = new FormData($("#formulario")[0]);
    formData.append('alumn_id', $("#alumn_id").val()); // Incluir `alumn_id` en los datos enviados

    $.ajax({
        url: "../ajax/actividad.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            tabla.ajax.reload(); // Recargar la tabla después de la operación
            limpiar(); // Limpiar el formulario
        },
        error: function (e) {
            console.error("Error en la operación de guardado/edición: " + e.responseText);
        }
    });
}

// Función para mostrar los datos de una actividad en el formulario de edición
function mostrar(idactividad) {
    console.log("ID de actividad a mostrar:", idactividad);
    $.post("../ajax/actividad.php?op=mostrar", { id_actividad: idactividad }, function (data, status) {
        try {
            data = JSON.parse(data);
            console.log("Datos de la actividad a mostrar: ", data);

            $("#id_actividad").val(data.id_actividad);
            $("#nombre").val(data.nombre);
            $("#descripcion").val(data.descripcion);
            $("#fecha_limite").val(data.fecha_limite); // Mostrar la fecha límite en el formulario
            $("#curso").val(data.block_id);
            $('#curso').selectpicker('refresh');
            $("#modalActividad").modal("show"); // Mostrar el modal con los datos cargados
        } catch (e) {
            console.error("Error al mostrar la actividad: " + e);
        }
    });
}

// Función para desactivar una actividad
function desactivar(idactividad) {
    bootbox.confirm("¿Está seguro de desactivar esta actividad?", function (result) {
        if (result) {
            $.post("../ajax/actividad.php?op=desactivar", { id_actividad: idactividad }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

// Función para activar una actividad
function activar(idactividad) {
    bootbox.confirm("¿Está seguro de activar esta actividad?", function (result) {
        if (result) {
            $.post("../ajax/actividad.php?op=activar", { id_actividad: idactividad }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

function asignarBeneficiarios(idactividad) {
    // Redireccionar a la página de actividad_detalle.php pasando el id de la actividad
    window.location.href = `actividad_detalle.php?id=${id_actividad}`;
}

// Ejecutar la función de inicio cuando el documento esté listo
init();