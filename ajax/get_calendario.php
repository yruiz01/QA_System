<?php
require "../config/Conexion.php";

class Actividades {
    public function obtenerActividades() {
        $sql = "SELECT id_actividad, nombre AS title, fecha_limite AS start FROM actividad WHERE is_active = 1";
        return ejecutarConsulta($sql);
    }
}

$actividades = new Actividades();
$datos = $actividades->obtenerActividades();
$eventos = array();

while ($row = $datos->fetch_assoc()) {
    $eventos[] = $row;
}

echo json_encode($eventos);
?>
