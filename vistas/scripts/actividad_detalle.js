var tabla;

function init() {
    listarBeneficiariosAsignados(); // Listar beneficiarios asignados automáticamente al cargar
    listarBeneficiariosNoAsignados(); // Cargar los beneficiarios no asignados al cargar la página

    $("#formularioBeneficiario").on("submit", function (e) {
        e.preventDefault();
        asignarBeneficiario(); // Llamar a la función para asignar un beneficiario
    });
}

// Función para listar beneficiarios ya asignados
function listarBeneficiariosAsignados() {
    var idactividad = $("#idactividad").val(); // Obtén el valor del input hidden con el id de la actividad

    $.post("../ajax/actividad_detalle.php?op=listar", { idactividad: idactividad }, function (data) {
        var beneficiarios = JSON.parse(data); // Convertir la respuesta JSON a un objeto
        var html = "";

        // Verificar si la respuesta contiene datos
        if (beneficiarios.length > 0) {
            beneficiarios.forEach(function (beneficiario) {
                html += "<tr>" +
                    "<td>" + beneficiario.nombre + "</td>" +
                    "<td>" + beneficiario.apellido + "</td>" +
                    "<td><button class='btn btn-danger' onclick='eliminarBeneficiario(" + beneficiario.id + ")'>Eliminar</button></td>" +
                    "</tr>";
            });
        } else {
            html = "<tr><td colspan='3'>No hay beneficiarios asignados a esta actividad.</td></tr>";
        }

        $("#tbllistado tbody").html(html); // Actualizar la tabla con los datos recibidos
    });
}

// Función para listar beneficiarios NO asignados
function listarBeneficiariosNoAsignados() {
    var idactividad = $("#idactividad").val(); // Obtén el valor del input hidden con el id de la actividad

    $.post("../ajax/actividad_detalle.php?op=listarNoAsignados", { idactividad: idactividad }, function (data) {
        var beneficiarios = JSON.parse(data); // Convertir la respuesta JSON a un objeto
        var html = "<option value=''>Selecciona un beneficiario</option>";  // Opción inicial

        // Verificar si la respuesta contiene datos
        if (beneficiarios.length > 0) {
            beneficiarios.forEach(function (beneficiario) {
                html += "<option value='" + beneficiario.id + "'>" + beneficiario.nombre + " " + beneficiario.apellido + "</option>";
            });
        } else {
            html = "<option value=''>No hay beneficiarios disponibles para asignar</option>";
        }

        $("#id_beneficiario").html(html); // Actualizar el select con los beneficiarios no asignados
        $("#id_beneficiario").selectpicker('refresh'); // Refrescar el selectpicker si estás usando Bootstrap Select
    });
}

// Función para asignar un beneficiario
function asignarBeneficiario() {
    var id_beneficiario = $("#id_beneficiario").val(); // Obtener el valor seleccionado
    var idactividad = $("#idactividad").val(); // Obtener el id de la actividad

    if (id_beneficiario) {
        $.post("../ajax/actividad_detalle.php?op=asignarBeneficiario", { idactividad: idactividad, id_beneficiario: id_beneficiario }, function (data) {
            bootbox.alert({
                message: data,
                callback: function () {
                    listarBeneficiariosAsignados(); // Refrescar la lista de beneficiarios asignados
                    listarBeneficiariosNoAsignados(); // Refrescar la lista de beneficiarios no asignados
                }
            });
        });
    } else {
        bootbox.alert("Por favor, selecciona un beneficiario para asignar.");
    }
}

// Función para eliminar un beneficiario
function eliminarBeneficiario(id_beneficiario) {
    var idactividad = $("#idactividad").val();

    $.post("../ajax/actividad_detalle.php?op=eliminarBeneficiario", { idactividad: idactividad, id_beneficiario: id_beneficiario }, function (data) {
        alert(data); // Mostrar mensaje de éxito o error
        listarBeneficiariosAsignados(); // Refrescar la lista de beneficiarios asignados
        listarBeneficiariosNoAsignados(); // Refrescar la lista de beneficiarios no asignados
    });
}

// Inicializar al cargar la página
init();
