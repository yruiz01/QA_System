$(document).ready(function() {
    // Formulario para actualizar los datos del perfil
    $("#formulario_perfil").on("submit", function(e) {
        e.preventDefault();

        // Obtener los valores de los campos correctos
        var nombre = $("#nombre_usuario").val(); 
        var correo = $("#correo").val();
        var telefono = $("#telefono").val();

        if (nombre === '' || correo === '' || telefono === '') { 
            bootbox.alert("Todos los campos son requeridos.");
            return;
        }

        var formData = new FormData($("#formulario_perfil")[0]);

        // Enviar los datos con AJAX
        $.ajax({
            url: "../ajax/usuario.php?op=actualizarPerfil", // Cambia la operación aquí según tu lógica
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                try {
                    var res = JSON.parse(response); 

                    if (res.status === "success") {
                        bootbox.alert("Perfil actualizado correctamente.", function() {
                            location.reload();
                        });
                    } else {
                        bootbox.alert("Hubo un problema al actualizar el perfil. " + res.message);
                    }
                } catch (e) {
                    bootbox.alert("Error al procesar la respuesta del servidor.");
                }
            },
            error: function() {
                bootbox.alert("Hubo un problema con la solicitud. Inténtelo nuevamente.");
            }
        });
    });

    // Previsualización de la imagen al cargar un nuevo archivo
    $("#imagen").change(function() {
        var fileInput = this;
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#imagen_perfil").attr("src", e.target.result);
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    });

    // Formulario para cambiar la contraseña
    $("#formulario_password").on("submit", function(e) {
        e.preventDefault(); // Asegúrate de prevenir el comportamiento predeterminado del formulario

        var clave_actual = $("#password_actual").val();
        var nueva_password = $("#nueva_password").val();
        var confirmar_password = $("#confirmar_password").val();

        if (nueva_password !== confirmar_password) {
            bootbox.alert("Las contraseñas no coinciden.");
            return;
        }

        if (clave_actual === '' || nueva_password === '' || confirmar_password === '') {
            bootbox.alert("Todos los campos son requeridos.");
            return;
        }

        var datos_contraseña = {
            clave_actual: clave_actual,
            nueva_password: nueva_password
        };

        $.ajax({
            url: "../ajax/usuario.php?op=cambiarContraseña",
            type: "POST",
            data: datos_contraseña,
            success: function(response) {
                try {
                    var res = JSON.parse(response);

                    if (res.status === "success") {
                        bootbox.alert("Contraseña cambiada correctamente.");
                        $("#password_actual").val('');
                        $("#nueva_password").val('');
                        $("#confirmar_password").val('');
                    } else {
                        bootbox.alert("Hubo un problema al cambiar la contraseña. " + res.message);
                    }
                } catch (e) {
                    bootbox.alert("Error al procesar la respuesta del servidor.");
                }
            },
            error: function() {
                bootbox.alert("Hubo un problema con la solicitud.");
            }
        });
    });
});
