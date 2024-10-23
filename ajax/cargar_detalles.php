<?php
require "../config/Conexion.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM actividad WHERE id_actividad = $id AND is_active = 1";
    $result = mysqli_query($conexion, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $actividad = [
            'descripcion' => $row['descripcion'],
            // Otros campos que quieras devolver
        ];
        header('Content-Type: application/json');
        echo json_encode($actividad);
    } else {
        echo json_encode(['descripcion' => 'No se encontró la actividad.']);
    }
} else {
    echo json_encode(['descripcion' => 'ID de actividad no proporcionado.']);
}
?>
