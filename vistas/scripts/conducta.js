var tabla;

// Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    // Asociar formularios al evento submit
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    $("#formulario_asis").on("submit", function(e) {
        guardaryeditar_asis(e);
    });

    // Evento click para el botón de guardar en el modal
    $("#btnGuardar_asis").on("click", function(e) {
        e.preventDefault();
        guardarConducta();
    });

    // Ocultar la imagen de muestra inicialmente
    $("#imagenmuestra").hide();
}


function verificar(id) {
    var idgrupo = $("#idgrupo").val();
    var fecha_conducta = $("#fecha_conducta").val();

    if (!fecha_conducta) { 
        alert("Por favor, seleccione una fecha.");
        return;
    }

    $.post("../ajax/conducta.php?op=verificar", {fecha_conducta: fecha_conducta, alumn_id: id, idgrupo: idgrupo},
        function(data, status) {
            data = JSON.parse(data);
            if (data == null) {
                $("#getCodeModal").modal("show");
                $("#alumn_id").val(id); 
            } else {
                alert("Conducta ya registrada para esta fecha");
            }
        }
    );
}

// Función para guardar la conducta desde el modal
function guardarConducta() {
    var formData = new FormData($("#formulario_asis")[0]);

    $.ajax({
        url: "../ajax/conducta.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            alert(response);
            $('#getCodeModal').modal('hide');
            tabla.ajax.reload();
        }
    });
}

// Función para limpiar el formulario del modal
function limpiar() {
    $("#idconducta").val("");
    $("#alumn_id").val("");
    $("#tipo_conducta").val("");
    $("#tipo_conducta").selectpicker('refresh');
    $("#fecha_conducta").val(""); // Restablecer la fecha a vacía
    $('#getCodeModal').modal('hide');
}

// Función para mostrar el formulario principal
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

// Función para cancelar el formulario principal
function cancelarform() {
    limpiar();
    mostrarform(false);
}

// Función para listar los registros en la tabla
function listar() {
    var team_id = $("#idgrupo").val();
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/conducta.php?op=listar',
            data: {idgrupo: team_id},
            type: "get",
            dataType: "json",
            error: function(e) {  
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    }).DataTable();
}

// Función para guardar o editar en el formulario principal
function guardaryeditar(e) {
    e.preventDefault(); // no se activará la acción predeterminada
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/alumnos.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });

    limpiar();
}

// Función para guardar o editar desde el modal de asistencia
function guardaryeditar_asis(e) {
    e.preventDefault(); // no se activará la acción predeterminada
    $("#btnGuardar_asis").prop("disabled", false);
    var formData = new FormData($("#formulario_asis")[0]);

    $.ajax({
        url: "../ajax/conducta.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });

    limpiar();
}

// Función para mostrar los datos de un alumno
function mostrar(id) {
    $.post("../ajax/alumnos.php?op=mostrar", {idalumno: id},
        function(data, status) {
            data = JSON.parse(data);
            alert(data.name);
            mostrarform(true);
            $("#nombre").val(data.name);
            $("#apellidos").val(data.lastname);
            $("#email").val(data.email);
            $("#direccion").val(data.address);
            $("#telefono").val(data.phone);
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src", "../files/articulos/" + data.image);
            $("#imagenactual").val(data.image);
            $("#idalumno").val(data.id);
        }
    );
}

// Función para desactivar un alumno
function desactivar(idalumno) {
    bootbox.confirm("¿Está seguro de desactivar este dato?", function(result) {
        if (result) {
            $.post("../ajax/alumnos.php?op=desactivar", {idalumno: idalumno}, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

// Función para activar un alumno
function activar(idalumno) {
    bootbox.confirm("¿Está seguro de activar este dato?", function(result) {
        if (result) {
            $.post("../ajax/alumnos.php?op=activar", {idalumno: idalumno}, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();
