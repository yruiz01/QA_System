<?php 
require_once "../modelos/Conducta.php";
if (strlen(session_id())<1) 
	session_start(); 
$conducta=new Conducta();

$id=isset($_POST["idconducta"])? limpiarCadena($_POST["idconducta"]):"";
$kind_id=isset($_POST["tipo_conducta"])? limpiarCadena($_POST["tipo_conducta"]):"";
$date_at=isset($_POST["fecha_conducta"])? limpiarCadena($_POST["fecha_conducta"]):"";
$alumn_id=isset($_POST["alumn_id"])? limpiarCadena($_POST["alumn_id"]):"";
$team_id=isset($_POST["idgrupo"])? limpiarCadena($_POST["idgrupo"]):"";
$user_id=$_SESSION["idusuario"];

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($id)) {
		$rspta = $conducta->insertar($kind_id, $date_at, $alumn_id, $team_id); 
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	} else {
         $rspta = $conducta->editar($id, $kind_id, $date_at, $alumn_id, $team_id);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos"; 
	}
		break;
	

	case 'desactivar':
		$rspta=$conducta->desactivar($id);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$rspta=$conducta->activar($id);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
	break;
	
	case 'mostrar':
		$rspta=$conducta->mostrar($id);
		echo json_encode($rspta);
	break;
	case 'verificar':

		$rspta=$conducta->verificar($date_at,$alumn_id,$team_id);
		echo json_encode($rspta);
	break;

    case 'listar':
    			require_once "../modelos/Alumnos.php";
			$alumnos=new Alumnos();
        $team_id=$_REQUEST["idgrupo"];
		$rspta=$alumnos->listar($user_id,$team_id);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->is_active)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-warning btn-xs" onclick="mostrar_precios('.$reg->id.')">P</i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.'<button class="btn btn-warning btn-xs" onclick="mostrar_precios('.$reg->id.')">P</i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
            "1"=>"<img src='../files/articulos/".$reg->image."' height='50px' width='50px'>",
            "2"=>$reg->name, 
            "3"=>$reg->lastname,
            "4"=>$reg->phone,
            "5"=>'<button class="btn btn-info btn-xs" onclick="verificar('.$reg->id.')"><i class="fa fa-check"></i> Marcar</button>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;
}
 ?>