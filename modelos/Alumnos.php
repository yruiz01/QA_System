<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";

class Alumnos{

	//implementamos nuestro constructor
	public function __construct(){

	} 

	// Método para insertar registro
	public function insertar($image, $name, $lastname, $email, $address, $phone, $c1_fullname, $c1_address, $c1_phone, $c1_note, $user_id, $team_id, $dpi, $ocupacion, $edad, $hijos, $genero, $funcion){
		$sql = "INSERT INTO alumn (image, name, lastname, email, address, phone, c1_fullname, c1_address, c1_phone, c1_note, dpi, ocupacion, edad, hijos, genero, funcion, is_active, user_id)
				VALUES ('$image', '$name', '$lastname', '$email', '$address', '$phone', '$c1_fullname', '$c1_address', '$c1_phone', '$c1_note', '$dpi', '$ocupacion', '$edad', '$hijos', '$genero', '$funcion', '1', '$user_id')";
		
		$idalumno_new = ejecutarConsulta_retornarID($sql);
		$sw = true;
		$sql_detalle = "INSERT INTO alumn_team (alumn_id, team_id) VALUES('$idalumno_new', '$team_id')";

		ejecutarConsulta($sql_detalle) or $sw = false;

		return $sw;
	}

// Método para editar registro
	public function editar($id, $image, $name, $lastname, $email, $address, $phone, $c1_fullname, $c1_address, $c1_phone, $c1_note, $user_id, $team_id, $dpi, $ocupacion, $edad, $hijos, $genero, $funcion) {
    	$sql = "UPDATE alumn SET image='$image', name='$name', lastname='$lastname', email='$email', address='$address', phone='$phone', c1_fullname='$c1_fullname', c1_address='$c1_address', c1_phone='$c1_phone', c1_note='$c1_note', dpi='$dpi', ocupacion='$ocupacion', edad='$edad', hijos='$hijos', genero='$genero', funcion='$funcion', user_id='$user_id'
            WHERE id='$id'";
    		return ejecutarConsulta($sql);
	}

	// Método para desactivar registro
	public function desactivar($id){
		$sql = "UPDATE alumn SET is_active='0' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	// Método para activar registro
	public function activar($id){
		$sql = "UPDATE alumn SET is_active='1' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	// Método para mostrar un registro
	public function mostrar($id) {
		$sql = "SELECT id, image, name, lastname, email, address, phone, dpi, ocupacion, edad, hijos, genero, funcion
				FROM alumn WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}
	// Listar registros
	public function listar($team_id){
		$sql = "SELECT a.id, a.image, a.name, a.lastname, a.email, a.address, a.phone, a.c1_fullname, a.c1_address, a.c1_phone, a.c1_note, a.dpi, a.ocupacion, a.edad, a.hijos, a.genero, a.funcion, a.is_active, a.user_id 
				FROM alumn a INNER JOIN alumn_team alt ON a.id=alt.alumn_id 
				WHERE a.is_active=1 AND alt.team_id='$team_id' 
				ORDER BY a.id DESC";
		return ejecutarConsulta($sql);
	}

	// Método para verificar si el alumno ya está en el sistema
	public function verficar_alumno($team_id){
		$sql = "SELECT * FROM alumn a INNER JOIN alumn_team alt ON a.id=alt.alumn_id 
				WHERE a.is_active=1 AND alt.team_id='$team_id' 
				ORDER BY a.id DESC";
		return ejecutarConsultaSimpleFila($sql);
	}

	// Listar registros para calificaciones
	public function listar_calif($team_id){
		$sql = "SELECT a.id AS idalumn, a.image, a.name, a.lastname, a.email, a.address, a.phone, a.c1_fullname, a.c1_address, a.c1_phone, a.c1_note, a.dpi, a.ocupacion, a.edad, a.hijos, a.genero, a.funcion, a.is_active, a.user_id 
				FROM alumn a INNER JOIN alumn_team alt ON a.id=alt.alumn_id 
				WHERE a.is_active=1 AND alt.team_id='$team_id' 
				ORDER BY a.id DESC";
		return ejecutarConsulta($sql); 
	}

	public function listarPorActividad($idactividad) {
		$sql = "SELECT a.id, a.name, a.lastname 
				FROM alumn a
				JOIN actividad_detalle ad ON a.id = ad.id_beneficiario 
				WHERE ad.id_actividad = '$idactividad'";
		return ejecutarConsulta($sql);
	}

	 // Listar beneficiarios NO asignados a una actividad
	 public function listarNoAsignados($idactividad) {
        $sql = "SELECT a.id, a.name, a.lastname 
                FROM alumn a 
                WHERE a.id NOT IN (
                    SELECT ad.id_beneficiario 
                    FROM actividad_detalle ad 
                    WHERE ad.id_actividad = '$idactividad'
                )";
        return ejecutarConsulta($sql);
    }
	
}
?>
