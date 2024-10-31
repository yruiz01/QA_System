<?php
require "../config/Conexion.php";

class Actividad {
    // Constructor
    public function __construct() {}

    // Método para insertar una nueva actividad
    public function insertar($nombre, $descripcion, $block_id, $fecha_limite) {
        $sql = "INSERT INTO actividad (nombre, descripcion, block_id, fecha_limite) 
                VALUES ('$nombre', '$descripcion', '$block_id', '$fecha_limite')";
        return ejecutarConsulta($sql);
    }

    // Método para editar una actividad
    public function editar($id_actividad, $nombre, $descripcion, $block_id, $fecha_limite) {
        $sql = "UPDATE actividad 
                SET nombre='$nombre', descripcion='$descripcion', block_id='$block_id', fecha_limite='$fecha_limite' 
                WHERE id_actividad='$id_actividad'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los detalles de una actividad específica
    public function mostrar($id_actividad) {
        $sql = "SELECT * FROM actividad WHERE id_actividad='$id_actividad'";
        return ejecutarConsultaSimpleFila($sql);
    }

    // Método para listar actividades por `block_id`
    public function listar($block_id) {
        $sql = "SELECT id_actividad, nombre, descripcion, block_id, fecha_limite, is_active
                FROM actividad
                WHERE block_id = '$block_id'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar una actividad
    public function desactivar($id_actividad) {
        $sql = "UPDATE actividad SET is_active='0' WHERE id_actividad='$id_actividad'";
        return ejecutarConsulta($sql);
    }

    // Método para activar una actividad
    public function activar($id_actividad) {
        $sql = "UPDATE actividad SET is_active='1' WHERE id_actividad='$id_actividad'";
        return ejecutarConsulta($sql);
    }

    public function listarAlumnosDisponibles($team_id, $id_actividad) {
        $sql = "SELECT a.id, CONCAT(a.name, ' ', a.lastname) as nombre
                FROM alumn a
                INNER JOIN alumn_team at ON a.id = at.alumn_id
                WHERE at.team_id = '$team_id'
                AND a.id NOT IN (SELECT ad.id_beneficiario FROM actividad_detalle ad WHERE ad.id_actividad = '$id_actividad')";
        return ejecutarConsulta($sql); // Esto ya está bien
    }
    
    public function listar_actividades_rango($fecha_inicio, $fecha_fin, $team_id) {
        $sql = "SELECT nombre, descripcion, fecha_actividad 
                FROM actividad 
                WHERE block_id = '$team_id' 
                AND fecha_actividad BETWEEN '$fecha_inicio' AND '$fecha_fin'";
        return ejecutarConsulta($sql);
    }
    
    
}
?>