<?php
require "../config/Conexion.php";

class Actividad_detalle {
    
    // Constructor vacío
    public function __construct() {}

    // Método para insertar un beneficiario en la actividad
    public function insertar($id_actividad, $id_beneficiario) {
        $sql = "INSERT INTO actividad_detalle (id_actividad, id_beneficiario) VALUES ('$id_actividad', '$id_beneficiario')";
        return ejecutarConsulta($sql);
    }

    // Método para editar la relación entre actividad y beneficiario (si es necesario)
    public function editar($id_actividad_detalle, $id_actividad, $id_beneficiario) {
        $sql = "UPDATE actividad_detalle SET id_actividad='$id_actividad', id_beneficiario='$id_beneficiario' WHERE id_actividad_detalle='$id_actividad_detalle'";
        return ejecutarConsulta($sql);
    }

    // Método para verificar si un beneficiario ya está asignado a una actividad
    public function verificar($id_beneficiario, $id_actividad) {
        $sql = "SELECT * FROM actividad_detalle WHERE id_beneficiario='$id_beneficiario' AND id_actividad='$id_actividad'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Método para listar beneficiarios asignados a un equipo (para funciones adicionales)
    public function listar($team_id) {
        $sql = "SELECT a.id, a.name, a.lastname, a.phone, a.image 
                FROM alumn a 
                JOIN alumn_team at ON a.id = at.alumn_id
                WHERE at.team_id = '$team_id'";
        return ejecutarConsulta($sql);
    }
    
    // Método para listar beneficiarios no asignados a una actividad específica
    public function cargarNoAsignados($id_actividad) {
        $sql = "SELECT a.id, a.name, a.lastname 
                FROM alumn a 
                WHERE a.id NOT IN (SELECT id_beneficiario FROM actividad_detalle WHERE id_actividad = '$id_actividad')";
        return ejecutarConsulta($sql);
    }

    // Método para eliminar un beneficiario de una actividad
    public function eliminar($id_actividad, $id_beneficiario) {
        $sql = "DELETE FROM actividad_detalle WHERE id_actividad = '$id_actividad' AND id_beneficiario = '$id_beneficiario'";
        return ejecutarConsulta($sql);
    }

    public function listarBeneficiariosNoAsignados($idactividad)
{
    $sql = "SELECT a.id, a.name, a.lastname
            FROM alumn a
            WHERE a.id NOT IN (
                SELECT ad.id_beneficiario 
                FROM actividad_detalle ad 
                WHERE ad.id_actividad = '$idactividad'
            )";
    return ejecutarConsulta($sql);
}

}
?>
