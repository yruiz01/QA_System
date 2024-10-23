<?php 
require_once "../modelos/Asistencia.php";
if (strlen(session_id()) < 1) 
    session_start(); 

$asistencia = new Asistencia();

$id = isset($_POST["idasistencia"]) ? limpiarCadena($_POST["idasistencia"]) : "";
$alumn_id = isset($_POST["alumn_id"]) ? limpiarCadena($_POST["alumn_id"]) : "";
$block_id = isset($_POST["idactividad"]) ? limpiarCadena($_POST["idactividad"]) : "";
$valor = 1; // La asistencia es 1 (presente)
$user_id = $_SESSION["idusuario"];

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($id)) {
            $rspta = $asistencia->insertar($valor, $alumn_id, $block_id);
            echo $rspta ? "Asistencia registrada correctamente" : "No se pudo registrar la asistencia";
        } else {
            $rspta = $asistencia->editar($id, $valor, $alumn_id, $block_id);
            echo $rspta ? "Asistencia actualizada correctamente" : "No se pudo actualizar la asistencia";
        }
        break;

    case 'desactivar':
        $rspta = $asistencia->desactivar($id);
        echo $rspta ? "Asistencia desactivada correctamente" : "No se pudo desactivar la asistencia";
        break;

    case 'activar':
        $rspta = $asistencia->activar($id);
        echo $rspta ? "Asistencia activada correctamente" : "No se pudo activar la asistencia";
        break;

    case 'mostrar':
        $rspta = $asistencia->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'verificar':
        // Verifica si ya existe una asistencia para este alumno y actividad
        $rspta = $asistencia->verificar($alumn_id, $block_id);
        
        if ($rspta == null) {
            // Si no existe, inserta directamente el valor 1 (asistencia)
            $rspta = $asistencia->insertar(1, $alumn_id, $block_id);
            echo $rspta ? "Asistencia asignada exitosamente" : "No se pudo asignar la asistencia";
        } else {
            echo json_encode($rspta); // Ya existe una asistencia
        }
        break;

    case 'listar':
        require_once "../modelos/Alumnos.php";
        $alumnos = new Alumnos();
        $team_id = $_REQUEST["idgrupo"];
        $rspta = $alumnos->listar($user_id, $team_id);
        $data = Array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->is_active) ? 
                    '<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>' . ' ' .
                    '<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>' : 
                    '<button class="btn btn-primary btn-xs" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
                "1" => "<img src='../files/articulos/".$reg->image."' height='50px' width='50px'>",
                "2" => $reg->name, 
                "3" => $reg->lastname,
                "4" => $reg->phone,
                "5" => '<button class="btn btn-info btn-xs" onclick="verificar('.$reg->id.')"><i class="fa fa-check"></i> Asignar Asistencia</button>'
            );
        }

        $results = array(
            "sEcho" => 1, // Información para datatables
            "iTotalRecords" => count($data), // Total de registros
            "iTotalDisplayRecords" => count($data), // Total de registros a mostrar
            "aaData" => $data
        ); 
        echo json_encode($results);
        break;
}
?>
