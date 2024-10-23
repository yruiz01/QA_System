<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit();
}

// Usar el operador ternario para asignar valores
$telefono = isset($_SESSION['telefono']) ? $_SESSION['telefono'] : ''; 
$nombre_usuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; 
$email = isset($_SESSION['email']) ? $_SESSION['email'] : ''; 
$imagen = isset($_SESSION['imagen']) ? $_SESSION['imagen'] : 'default.png'; // Imagen predeterminada

require 'header.php';
?>

<div class="content-wrapper">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h1 class="box-title">Editar Perfil</h1>
            </div>

            <div class="panel-body">
                <!-- Mensajes de éxito o error -->
                <div id="mensajePerfil" class="alert" style="display: none;"></div>

                <!-- Formulario para actualizar el perfil -->
                <form id="formulario_perfil" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre de Usuario:</label>
                            <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" value="<?php echo htmlspecialchars($nombre_usuario); ?>" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Correo:</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo htmlspecialchars($telefono); ?>" placeholder="Número de Teléfono" required>
                        </div>

                        <!-- Previsualización y carga de nueva imagen -->
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen de Perfil:</label>
                            <br>
                            <img src="../files/usuarios/<?php echo htmlspecialchars($imagen); ?>" class="img-thumbnail" id="imagen_perfil" width="150px">
                            <br><br>
                            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnActualizarPerfil">Actualizar Perfil</button>
                            <button class="btn btn-danger" type="button" onclick="cancelarForm()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Formulario separado para cambiar la contraseña -->
        <div class="box">
            <div class="box-header with-border">
                <h1 class="box-title">Cambiar Contraseña</h1>
            </div>

            <div class="panel-body">
                <!-- Mensajes de éxito o error -->
                <div id="mensajePassword" class="alert" style="display: none;"></div>

                <form id="formulario_password" method="POST" autocomplete="off">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Contraseña Actual:</label>
                            <input type="password" class="form-control" name="password_actual" id="password_actual" placeholder="Contraseña Actual" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nueva Contraseña:</label>
                            <input type="password" class="form-control" name="nueva_password" id="nueva_password" placeholder="Nueva Contraseña" required>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Confirmar Nueva Contraseña:</label>
                            <input type="password" class="form-control" name="confirmar_password" id="confirmar_password" placeholder="Confirmar Nueva Contraseña" required>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnCambiarPassword">Cambiar Contraseña</button>
                            <button class="btn btn-danger" type="button" onclick="cancelarForm()">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="scripts/perfil.js"></script>
<?php require 'footer.php'; ?>
