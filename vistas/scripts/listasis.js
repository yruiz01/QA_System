var tabla;

//funcion que se ejecuta al inicio
function init(){

   listar();
   listarc();
   listar_calificacion();
   listar_actividades(); 
   $("#fecha_inicio").change(listar);
   $("#fecha_fin").change(listar);

   $("#fecha_inicioc").change(listarc);
   $("#fecha_finc").change(listarc);
}

//funcion listar asistencia
function listar(){
	var  fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
	var  team_id = $("#idgrupo").val();
	$.post("../ajax/consultas.php?op=lista_asistencia",{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin, idgrupo:team_id},
		function(data,status)
		{
			console.log(data);
			$("#data").html(data);
		})
}

//funcion listar comportamiento
function listarc(){
    var fecha_inicio = $("#fecha_inicioc").val();
    var fecha_fin = $("#fecha_finc").val();
    var team_id = $("#idgrupo").val();
    
    $.post("../ajax/consultas.php?op=lista_comportamiento", {fecha_inicioc: fecha_inicio, fecha_finc: fecha_fin, idgrupo: team_id},
        function(data, status) {
            console.log(data);
            $("#datac").html(data);
        }
    );
}


//funcion listar comportamiento
function listar_calificacion(){
 
	var  team_id = $("#idgrupo").val();
	$.post("../ajax/consultas.php?op=listar_calificacion",{idgrupo:team_id},
		function(data,status)
		{
			console.log(data);
			$("#datacalif").html(data);
		})
}

function listar_actividades() {
    var fecha_inicio = $("#fecha_inicioa").val();  // Fecha de inicio de actividades
    var fecha_fin = $("#fecha_fina").val();        // Fecha de fin de actividades
    var team_id = $("#idgrupo").val();             // ID del grupo seleccionado

    $.post("../ajax/consultas.php?op=lista_actividades", { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, idgrupo: team_id },
        function(data, status) {
            console.log(data);                     // Mostrar los datos obtenidos en la consola para depuración
            $("#dataa").html(data);                // Insertar los datos en el contenedor #dataa
        });
}
init();