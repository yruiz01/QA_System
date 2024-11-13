<?php 
require_once "../modelos/Alumnos.php";
if (strlen(session_id())<1) 
    session_start();

$alumnos = new Alumnos();

$id = isset($_POST["idalumno"]) ? limpiarCadena($_POST["idalumno"]) : "";
$image = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";
$name = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$lastname = isset($_POST["apellidos"]) ? limpiarCadena($_POST["apellidos"]) : "";
$address = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
$phone = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$dpi = isset($_POST["dpi"]) ? limpiarCadena($_POST["dpi"]) : "";
$ocupacion = isset($_POST["ocupacion"]) ? limpiarCadena($_POST["ocupacion"]) : "";
$edad = isset($_POST["edad"]) ? limpiarCadena($_POST["edad"]) : "";
$hijos = isset($_POST["hijos"]) ? limpiarCadena($_POST["hijos"]) : "";
$genero = isset($_POST["genero"]) ? limpiarCadena($_POST["genero"]) : "";
$funcion = isset($_POST["funcion"]) ? limpiarCadena($_POST["funcion"]) : "";  
$team_id = isset($_POST["idgrupo"]) ? limpiarCadena($_POST["idgrupo"]) : "";
$user_id = $_SESSION["idusuario"];

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $image = $_POST["imagenactual"];
        } else {
            $ext = explode(".", $_FILES["imagen"]["name"]);
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
                $image = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/" . $image);
            }
        }
        if (empty($id)) {
			// Insertar nuevo registro
			$rspta = $alumnos->insertar($image, $name, $lastname,  $address, $phone, $user_id, $team_id, $dpi, $ocupacion, $edad, $hijos, $genero, $funcion); 
			echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
		} else {
			// Editar registro existente
			$rspta = $alumnos->editar($id, $image, $name, $lastname, $address, $phone, $user_id, $team_id, $dpi, $ocupacion, $edad, $hijos, $genero, $funcion);
			echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos"; 
		}		
        break;

    case 'desactivar':
        $rspta = $alumnos->desactivar($id);
        echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
        break;

    case 'activar':
        $rspta = $alumnos->activar($id);
        echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
        break;

    case 'mostrar':
        $rspta = $alumnos->mostrar($id);
        echo json_encode($rspta);
        break;

    case 'listar':
        $team_id = $_REQUEST["idgrupo"];
        $rspta = $alumnos->listar($team_id);   
        $data = Array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->is_active) ? '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>' . ' ' . '<button class="btn btn-danger btn-xs" onclick="desactivar(' . $reg->id . ')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>' . ' ' . '<button class="btn btn-primary btn-xs" onclick="activar(' . $reg->id . ')"><i class="fa fa-check"></i></button>',
                "1" => "<img src='../files/articulos/" . $reg->image . "' height='50px' width='50px'>",
                "2" => $reg->name, 
                "3" => $reg->lastname,
                "4" => $reg->phone,
                "5" => $reg->address,
                "6" => $reg->dpi,
                "7" => $reg->ocupacion,
                "8" => $reg->edad,
                "9" => $reg->hijos,
                "10" => $reg->genero,
                "11" => $reg->funcion,
                "12" => ($reg->is_active)?'<span class="label bg-green">Activo</span>':'<span class="label bg-red">Inactivo</span>'

            );
        }
        $results = array(
            "sEcho" => 1, // info para datatables
            "iTotalRecords" => count($data), // enviamos el total de registros al datatable
            "iTotalDisplayRecords" => count($data), // enviamos el total de registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);
        break;
}
?>
