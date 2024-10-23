<?php 
require_once "../modelos/Actividad_detalle.php";

if (strlen(session_id()) < 1) 
    session_start(); 

$actividad_detalle = new Actividad_detalle();

// Capturamos los valores de los POST
$id_actividad = isset($_POST["id_actividad"]) ? limpiarCadena($_POST["id_actividad"]) : "";
$alumn_id = isset($_POST["alumn_id"]) ? limpiarCadena($_POST["alumn_id"]) : "";
$user_id = $_SESSION["idusuario"]; // Usuario en sesión

switch ($_GET["op"]) {
    // Caso para asignar un beneficiario a la actividad
    case 'asignarBeneficiario':
        $idactividad = isset($_POST["idactividad"]) ? limpiarCadena($_POST["idactividad"]) : "";
        $id_beneficiario = isset($_POST["id_beneficiario"]) ? limpiarCadena($_POST["id_beneficiario"]) : "";
    
        if (!empty($idactividad) && !empty($id_beneficiario)) {
            $respuesta = $actividad_detalle->insertar($idactividad, $id_beneficiario);
            echo $respuesta ? "Beneficiario asignado correctamente" : "No se pudo asignar el beneficiario";
        } else {
            echo "Datos incompletos, por favor verifica la información.";
        }
        break;
    

    // Caso para eliminar un beneficiario de la actividad
    case 'eliminarBeneficiario':
        $idactividad = $_POST['idactividad'];
        $id_beneficiario = $_POST['id_beneficiario'];
        
        $rspta = $actividad_detalle->eliminar($idactividad, $id_beneficiario);
        echo $rspta ? "Beneficiario eliminado correctamente" : "No se pudo eliminar el beneficiario";
        break;

    // Caso para listar beneficiarios asignados a la actividad
    case 'listar':
        require_once "../modelos/Alumnos.php";
        $alumnos = new Alumnos();
    
        $idactividad = isset($_POST['idactividad']) ? $_POST['idactividad'] : '';  // Capturar el id de la actividad correctamente
        
        if (!empty($idactividad)) {
            // Obtener la lista de beneficiarios asignados a la actividad
            $rspta = $alumnos->listarPorActividad($idactividad);
            
            $response = array();
            while ($reg = $rspta->fetch_object()) {
                $response[] = array(
                    "id" => $reg->id,
                    "nombre" => $reg->name,
                    "apellido" => $reg->lastname
                );
            }

            // Devolver la lista de beneficiarios asignados como JSON
            echo json_encode($response);
        } else {
            // Si no se recibe el ID de la actividad, devolver un mensaje vacío
            echo json_encode(array());
        }
        break;

    // Caso para listar beneficiarios no asignados a la actividad
    case 'listarNoAsignados':
        $idactividad = isset($_POST['idactividad']) ? limpiarCadena($_POST['idactividad']) : "";
        
        // Obtener beneficiarios no asignados a la actividad
        $rspta = $actividad_detalle->listarBeneficiariosNoAsignados($idactividad);
        
        $data = Array();
    
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "id" => $reg->id,
                "nombre" => $reg->name,
                "apellido" => $reg->lastname
            );
        }
        
        echo json_encode($data);
        break;
    
}
?>
