<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Puntajes Asignados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
    <script src="dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<body>
	<div class="contenedor">
		<div style="margin:10px;" class="main row"></div>

		<div style="margin:10px;" class="main row"></div>
		<div class="main row">
			<div class="col-xs-1 col-sm-2 col-md-2"></div>
			<div id="textoTitulo" align="center" class="col-xs-10 col-sm-8 col-md-8">
				Puntajes Asignados
			</div>
		</div>
		<div class="main row">
			<div class="col-xs-1 col-sm-2 col-md-2"></div>
			<div id="textoForm" align="center" style="font-size: 20px;" class="col-xs-10 col-sm-8 col-md-8 tablaVerificar">
				<div style="height: 10px;"></div>
				Puntajes asignados a las solicitudes con base en los soportes
				<br><br>
				<table class="table table-bordered centrado" >
					<thead>
						<tr>
							<th class="centrado">NOMBRE COMPLETO</th>
							<th class="centrado">CODIGO</th>
							<th class="centrado">PROYECTO CURRICULAR</th>
							<th class="centrado">FACULTAD</th>
							<th class="centrado">PUNTAJE</th>
						</tr>
					</thead>
					<tbody id="cuerpoLista" style="color: black;">

					</tbody>
				</table>


				<br><br>
			</div>
		</div>
		<br>
	</div>
<script src="js/jquery.js"></script>
<script>
	// FORMULARIO DATOS COMPAÑIA
	$(document).ready(function(){
		cargarDatos();
		verlog();
        $("#inicio").click(function(){
            location.href='menu.php';
        });
	});
	function verlog(){
		$.ajax({
			url  : "../logica/dispatcher.php",
			type : "post",
			datatype : "json",
			data : { log : "estudiante"},
			success: function(respuesta){
				if (respuesta!="si") {
					location.href='principalApoyo.php';
				}

			}
		});
	}

	function cargarDatos(){
		$.ajax({
			url  : "../logica/dispatcher.php",
			type : "post",
			datatype : "json",
			data : { calcularPuntaje : "true"},
			success: function(respuesta){
                console.log(respuesta+"siiiiiiiii");
				var datos=JSON.parse(respuesta);
				console.log(datos);
				$.each(datos, function( index, estudiante ) {
					construirItems(estudiante.K_CODEST,estudiante.N_NOMEST,estudiante.N_PROYECTOEST,estudiante.N_FACEST,estudiante.Q_ASIGPERDEST);
				});
			}

		});
	}

	function construirItems(codigo, nombre, proyecto, facultad,puntaje){
		var html= `
			<!--Inicio Grupo -->
			<tr>
				<td>`+nombre+`</td>
				<td>`+codigo+`</td>
				<td>`+proyecto+`</td>
				<td>`+facultad+`</td>
				<td>`+puntaje+`</td>
			</tr>
			<!--Fin Grupo -->
		`;
		$("#cuerpoLista").append(html);
	}

</script>
</body>
</html>
