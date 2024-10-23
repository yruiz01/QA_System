var tabla;

// Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario_asis").on("submit", function (e) {
        guardaryeditar_asis(e);
    });
}

// Función para verificar asistencia
function verificar(id) {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + month + "-" + day;
    var idgrupo = $("#idgrupo").val();

    if (!idgrupo) {
        alert('Error: No se ha seleccionado un grupo.');
        return;
    }

    $.post("../ajax/asistencia.php?op=verificar", { fecha_asistencia: today, alumn_id: id, idgrupo: idgrupo }, function (data, status) {
        try {
            data = JSON.parse(data);
        } catch (e) {
            console.error('Error en el formato JSON de la respuesta:', data);
            alert('Error en la respuesta del servidor.');
            return;
        }

        if (data == null && $("#tipo_asistencia").val() != "") {
            $("#getCodeModal").modal('show');
            $.post("../ajax/alumnos.php?op=mostrar", { idalumno: id }, function (data, status) {
                data = JSON.parse(data);
                $("#alumn_id").val(data.id);
            });
        } else if (data != null && $("#tipo_asistencia").val() != "") {
            $("#getCodeModal").modal('show');
            $("#idasistencia").val(data.id);
            $("#alumn_id").val(data.alumn_id);
            $("#tipo_asistencia").val(data.kind_id);
        } else if ($("#tipo_asistencia").val() == "") {
            alert('Selecciona un tipo de asistencia');
        }
    });
    limpiar();
}

// Función para limpiar el formulario
function limpiar() {
    $("#idasistencia").val("");
    $("#alumn_id").val("");
    $("#tipo_asistencia").val("");
    $("#tipo_asistencia").selectpicker('refresh');
    $('#getCodeModal').modal('hide');
}

// Función para mostrar el formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
    }
}

// Función para listar las asistencias
function listar() {
    var team_id = $("#idgrupo").val();  // Asegúrate de que el ID del select coincide
    if (team_id == "") {
        alert("No se ha seleccionado un grupo.");
        return; // Salir de la función si no se selecciona un grupo
    }
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "ajax": {
            url: '../ajax/asistencia.php?op=listar',
            data: { idgrupo: team_id },  
            type: "get",
            dataType: "json"
        },
        "columns": [
            { "data": "name", "title": "Nombre" },
            { "data": "lastname", "title": "Apellido" },
            { "data": "phone", "title": "Teléfono" },
            {
                "data": "tipo_asistencia",
                "title": "Estado de Asistencia",
                "render": function (data, type, row) {
                    var estado = "";
                    switch (data) {
                        case "1": estado = "Asistencia"; break;
                        case "2": estado = "Ausente"; break;
                        default: estado = "Pendiente"; break;
                    }
                    return estado;
                }
            },
            {
                "data": null,
                "title": "Opciones",
                "render": function (data, type, row) {
                    return '<button class="btn btn-xs btn-success" onclick="verificar(' + row.id + ')">Marcar</button>';
                }
            }
        ],
        "bDestroy": true,
        "iDisplayLength": 5,
        "order": [[0, "desc"]]
    }).DataTable();
}


// Función para guardar o editar asistencia
function guardaryeditar_asis(e) {
    e.preventDefault();
    var formData = new FormData($("#formulario_asis")[0]);

    $.ajax({
        url: "../ajax/asistencia.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            try {
                datos = JSON.parse(datos);
            } catch (e) {
                console.error('Error en el formato JSON de la respuesta:', datos);
                alert('Error en la respuesta del servidor.');
                return;
            }

            alert('Asistencia guardada exitosamente.');
            mostrarform(false);
            tabla.ajax.reload();
        },
        error: function(xhr, error, thrown) {
            console.error('Error en la solicitud AJAX:', error);
            alert('Error en la solicitud de asistencia.');
        }
    });
    limpiar();
}

init(); // Ejecutar la función de inicialización al cargar el archivo
