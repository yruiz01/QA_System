<?php 
require_once "../modelos/Calificaciones.php";
if (strlen(session_id()) < 1) 
    session_start(); 

$asistencia = new Calificaciones();

$id = isset($_POST["idcalificacion"]) ? limpiarCadena($_POST["idcalificacion"]) : "";
$val = isset($_POST["valor"]) ? limpiarCadena($_POST["valor"]) : "";
$alumn_id = isset($_POST["alumn_id"]) ? limpiarCadena($_POST["alumn_id"]) : "";
$block_id = isset($_POST["idcurso"]) ? limpiarCadena($_POST["idcurso"]) : "";
$is_active = isset($_POST["is_active"]) ? limpiarCadena($_POST["is_active"]) : "";
$user_id = $_SESSION["idusuario"];

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($id)) {
            $rspta = $asistencia->insertar($val, $alumn_id, $block_id); 
            echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
        } else {
            $rspta = $asistencia->editar($id, $val, $alumn_id, $block_id);
            echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos"; 
        }
        break;

    case 'desactivar':
        $rspta = $asistencia->desactivar($id);
        echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
        break;

    case 'activar':
        $rspta = $asistencia->activar($id);
        echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
        break;

    case 'mostrar':
        $rspta = $asistencia->mostrar($id);
        echo json_encode($rspta);
        break;

        case 'verificar':
            // Verifica si ya existe una calificación para este alumno y curso
            $rspta = $asistencia->verificar($alumn_id, $block_id);
            
            if ($rspta != null) {
                // Si ya existe, muestra un mensaje que el beneficiario ya fue asignado
                echo json_encode(['status' => 'error', 'message' => 'El beneficiario ya fue asignado a este curso.']);
            } else {
                // Si no existe, procede a asignar la calificación
                $rspta = $asistencia->insertar(1, $alumn_id, $block_id);
                echo json_encode(['status' => 'success', 'message' => $rspta ? "Calificación asignada exitosamente" : "No se pudo asignar la calificación"]);
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
                    '<button class="btn btn-warning btn-xs" onclick="mostrar_precios('.$reg->id.')">P</i></button>' . ' ' .
                    '<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>' : 
                    '<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>' . 
                    '<button class="btn btn-warning btn-xs" onclick="mostrar_precios('.$reg->id.')">P</i></button>' . ' ' . 
                    '<button class="btn btn-primary btn-xs" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
                "1" => "<img src='../files/articulos/".$reg->image."' height='50px' width='50px'>",
                "2" => $reg->name, 
                "3" => $reg->lastname,
                "4" => $reg->phone,
                "5" => $reg->is_active,
                "6" => '<button class="btn btn-info btn-xs" onclick="verificar('.$reg->id.')"><i class="fa fa-check"></i> Asignar</button>'
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
