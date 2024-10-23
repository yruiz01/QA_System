<?php 
// Incluir la conexión de base de datos
require "../config/Conexion.php";

class Asistencia {

    // Implementamos nuestro constructor
    public function __construct() {

    }

    // Método para insertar un registro
    public function insertar($asist, $alumn_id, $block_id) {
        $sql = "INSERT INTO asistencia (asist, alumn_id, block_id) VALUES ('$asist', '$alumn_id', '$block_id')";
        return ejecutarConsulta($sql);
    }

    // Método para editar un registro
    public function editar($id, $asist, $alumn_id, $block_id) {
        $sql = "UPDATE asistencia SET asist='$asist', alumn_id='$alumn_id', block_id='$block_id' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

    // Verificar si ya existe una asistencia para este alumno y actividad
    public function verificar($alumn_id, $block_id) {
        $sql = "SELECT * FROM asistencia WHERE alumn_id='$alumn_id' AND block_id='$block_id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Método para desactivar un registro
    public function desactivar($id) { 
        $sql = "UPDATE asistencia SET condicion='0' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

    // Método para activar un registro
    public function activar($id) {
        $sql = "UPDATE asistencia SET condicion='1' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar un registro específico
    public function mostrar($id) {
        $sql = "SELECT * FROM asistencia WHERE id='$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Listar todos los registros
    public function listar() {
        $sql = "SELECT * FROM asistencia";
        return ejecutarConsulta($sql);
    }

    // Listar y mostrar en select
    public function select() {
        $sql = "SELECT * FROM asistencia WHERE condicion=1";
        return ejecutarConsulta($sql);
    }
}

?>
