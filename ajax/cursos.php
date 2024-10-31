<?php
session_start();
require_once "../modelos/Cursos.php";

$cursos = new Cursos();

$idcurso = isset($_POST["idcurso"]) ? limpiarCadena($_POST["idcurso"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$team_id = isset($_POST["idgrupo"]) ? limpiarCadena($_POST["idgrupo"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
$fecha_inicio = isset($_POST["fecha_inicio"]) ? limpiarCadena($_POST["fecha_inicio"]) : "";
$fecha_fin = isset($_POST["fecha_fin"]) ? limpiarCadena($_POST["fecha_fin"]) : "";
$fecha_alerta = isset($_POST["fecha_alerta"]) ? limpiarCadena($_POST["fecha_alerta"]) : "";
$estado_alerta = isset($_POST["estado_alerta"]) ? limpiarCadena($_POST["estado_alerta"]) : "";
$responsable = isset($_POST["responsable"]) ? limpiarCadena($_POST["responsable"]) : "";
$contribucion_proyecto = isset($_POST["contribucion_proyecto"]) ? limpiarCadena($_POST["contribucion_proyecto"]) : "";
$archivo_pdf = isset($_POST["archivo_pdfactual"]) ? limpiarCadena($_POST["archivo_pdfactual"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (!file_exists($_FILES['archivo_pdf']['tmp_name']) || !is_uploaded_file($_FILES['archivo_pdf']['tmp_name'])) {
            $archivo_pdf = $_POST["archivo_pdfactual"]; 
        } else {
            $ext = explode(".", $_FILES["archivo_pdf"]["name"]);
            if ($_FILES['archivo_pdf']['type'] == "application/pdf") {
                $archivo_pdf = round(microtime(true)) . '.' . end($ext); 
                // Crear la carpeta si no existe
                if (!file_exists('../files/cursos')) {
                    mkdir('../files/cursos', 0777, true);
                }

                // Mover el archivo subido a la carpeta designada
                move_uploaded_file($_FILES["archivo_pdf"]["tmp_name"], "../files/cursos/" . $archivo_pdf);
            }
        }

        // Comprobar si estamos creando un nuevo curso o editando uno existente
        if (empty($idcurso)) {
            // Insertar nuevo curso
            $rspta = $cursos->insertar($nombre, $team_id, $descripcion, $fecha_inicio, $fecha_fin, $fecha_alerta, $estado_alerta, $responsable, $contribucion_proyecto, $archivo_pdf);
            echo $rspta ? "Proyecto registrado correctamente" : "No se pudo registrar el Proyecto";
        } else {
            // Editar curso existente
            $rspta = $cursos->editar($idcurso, $nombre, $team_id, $descripcion, $fecha_inicio, $fecha_fin, $fecha_alerta, $estado_alerta, $responsable, $contribucion_proyecto, $archivo_pdf);
            echo $rspta ? "Proyecto actualizado correctamente" : "No se pudo actualizar el Proyecto";
        }
        break;

    case 'listar':
        $rspta = $cursos->listar($_REQUEST["idgrupo"]);
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $estadoLabel = ($reg->is_active == '1') ? '<span class="label bg-green">Activo</span>' : '<span class="label bg-red">Inactivo</span>';
            $botonEstado = ($reg->is_active == '1') 
                ? '<button class="btn btn-danger" onclick="desactivar(' . $reg->id . ')"><i class="fa fa-close"></i></button>' 
                : '<button class="btn btn-success" onclick="activar(' . $reg->id . ')"><i class="fa fa-check"></i></button>';
            
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>' . $botonEstado,
                "1" => $reg->name,
                "2" => $reg->descripcion,
                "3" => $reg->fecha_inicio,
                "4" => $reg->fecha_fin,
                "5" => $estadoLabel,
                "6" => $reg->fecha_alerta,
                "7" => $reg->estado_alerta,
                "8" => $reg->responsable,
                "9" => $reg->contribucion_proyecto,
                "10" => '<a href="../files/cursos/' . $reg->archivo_pdf . '" target="_blank" class="btn btn-outline-primary" title="Abrir PDF">
                    <i class="fa fa-file-pdf-o" style="font-size: 18px; color: #D32F2F;"></i>
                 </a>'
            );
        }
        
        $results = array(
            "sEcho" => 1,  // Información para datatables
            "iTotalRecords" => count($data),  // Total de registros
            "iTotalDisplayRecords" => count($data),  // Registros a mostrar
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case 'mostrar':
        $rspta = $cursos->mostrar($idcurso);
        echo json_encode($rspta);
        break;

    case 'desactivar':
        $rspta = $cursos->desactivar($idcurso);
        if ($rspta) {
            echo "Proyecto desactivado correctamente";
        } else {
            echo "No se pudo desactivar el Proyecto";
        }
        break;

    case 'activar':
        $rspta = $cursos->activar($idcurso);
        if ($rspta) {
            echo "Proyecto activado correctamente";
        } else {
            echo "No se pudo activar el Proyecto";
        }
        break;
		case 'selectCursos':
			$team_id=$_REQUEST["idgrupo"];
	
			$rspta=$cursos->listar($team_id);
            echo '<select class="custom-select" name="proyecto" style="font-weight: bold; color: #001f3f;">'; 
            echo '<option value="0" disabled selected style="color: #001f3f;">*Seleccione un Proyecto *</option>'; 

	
				while ($reg = $rspta->fetch_object()) {
					echo '<option value='.$reg->id.'>'.$reg->name.'</option>';
				}
				break;
}
?>
