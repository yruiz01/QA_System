<?php
require "../config/Conexion.php";

// Obtener la fecha actual en formato YYYY-MM-DD
$today = date('Y-m-d');

// Modificar la consulta para incluir la verificación de la fecha
$query = "SELECT id_actividad AS id, nombre, fecha_limite, descripcion 
          FROM actividad 
          WHERE is_active = 1 AND fecha_limite >= '$today'"; // Filtro por fecha

$result = mysqli_query($conexion, $query);

$actividades = [];
while ($row = mysqli_fetch_assoc($result)) {
    $actividades[] = $row;
}

header('Content-Type: application/json');
echo json_encode($actividades);
?>
