var tabla;

// Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    // Ocultar la imagen de vista previa inicialmente
    $("#imagenmuestra").hide();
}

// Función para limpiar los campos del formulario
function limpiar() {
    $("#codigo").val("");
    $("#nombre").val("");
    $("#apellidos").val("");
    $("#email").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#print").hide();
    $("#idalumno").val("");
    $("#dpi").val("");
    $("#ocupacion").val("");
    $("#edad").val("");
    $("#hijos").val("");
    $("#genero").val("");
    $("#funcion").val("");
}

// Función para mostrar el formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#btnasistencia").hide();
        $("#btnconducta").hide();
        $("#btncalificaciones").hide();
        $("#btncursos").hide();
        $("#btnlistas").hide();
        $("#btnreporte").hide();
        $("#btngrupos").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
        $("#btnasistencia").show();
        $("#btnconducta").show();
        $("#btncalificaciones").show();
        $("#btncursos").show();
        $("#btnlistas").show();
        $("#btnreporte").show();
        $("#btngrupos").show();
    }
}

// Cancelar formulario
function cancelarform() {
    limpiar();
    mostrarform(false);
}

// Función para listar los registros
function listar() {
    var team_id = $("#idgrupo").val();
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, // Activamos el procesamiento del datatable
        "aServerSide": true, // Paginación y filtrado realizados por el server
        dom: 'Bfrtip', // Definimos los elementos del control de la tabla
        buttons: [
            {
                extend: 'copyHtml5',
                text: 'Copiar',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] // Asegúrate de incluir las columnas necesarias
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] // Asegúrate de incluir las columnas necesarias
                }
            },
            {
                extend: 'colvis',
                text: 'Visor de columnas',
                collectionLayout: 'fixed three-column'
            }
        ],
        "ajax": {
            url: '../ajax/alumnos.php?op=listar',
            data: { idgrupo: team_id },
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, // Paginación
        "order": [[0, "desc"]] // Ordenar (columna, orden)
    }).DataTable();
}

// Función para guardar o editar un registro
function guardaryeditar(e) {
    e.preventDefault(); // No se activará la acción predeterminada
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

// Función para mostrar un registro
function mostrar(idalumno) {
    $.post("../ajax/alumnos.php?op=mostrar", { idalumno: idalumno }, function(data, status) {
        data = JSON.parse(data);
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

        // Recuperar y asignar los campos de texto y numéricos
        $("#dpi").val(data.dpi);
        $("#ocupacion").val(data.ocupacion);
        $("#edad").val(data.edad);
        $("#hijos").val(data.hijos);

        // Recuperar y asignar los campos de select (asegúrate de que el valor se esté asignando)
        $("#genero").val(data.genero).trigger("change");
        $("#funcion").val(data.funcion).trigger("change");  // Asegura que el valor de función se asigna correctamente
    });
}

// Función para desactivar un registro
function desactivar(idalumno) {
    bootbox.confirm("¿Está seguro de desactivar este dato?", function(result) {
        if (result) {
            $.post("../ajax/alumnos.php?op=desactivar", { idalumno: idalumno }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

// Función para activar un registro
function activar(idalumno) {
    bootbox.confirm("¿Está seguro de activar este dato?", function(result) {
        if (result) {
            $.post("../ajax/alumnos.php?op=activar", { idalumno: idalumno }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init();
