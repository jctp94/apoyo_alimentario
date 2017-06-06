<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Listas filtradas</title>
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
				Listado de personas que han generado Solicitud para el Apoyo Alimentario
			</div>
		</div>
		<div class="main row">			
			<div class="col-xs-1 col-sm-2 col-md-2"></div>
			<div id="textoForm" align="center" style="font-size: 20px;" class="col-xs-10 col-sm-8 col-md-8 tablaVerificar">
				<div style="height: 10px;"></div>
				
				
				<div class="row">
					<div class="col-md-6">
						Filtrar por Facultad
						<select type="number" class="entrada form-control col-md-3 col-xs-12" required id="facultad">
							<option value="">Seleccione...</option>																					
						</select>

						<br><br>
				
					</div>
					<div class="col-md-6">
						Filtrar por Proyecto Curricular
						<select type="number" class="entrada form-control col-md-3 col-xs-12" required id="proyectoCurricular">
							<option value="">Seleccione...</option>																						
						</select>
					</div>
				</div>
				<div style="margin:10px;" class="main row"></div>



				<table class="table table-bordered centrado" >
					<thead>
						<tr>
							<th class="centrado">NOMBRE COMPLETO</th>
							<th class="centrado">CODIGO</th>
							<th class="centrado">PROYECTO CURRICULAR</th>
							<th class="centrado">FACULTAD</th>
							<th class="centrado">ESTADO SOLICITUD</th>
						</tr>
					</thead>
					<tbody id="cuerpoLista">
						
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
		cargarFiltros();
		verlog();
        $("#inicio").click(function(){
            location.href='menu.php';
        });

        
		$("#facultad").change(function() {
			//alert("cambio");			
			var valor = $(this).children(":selected").attr("value");	    	
		    cargarTabla("facultad", valor);
		});

		$("#proyectoCurricular").change(function() {
			var valor = $(this).children(":selected").attr("value");			
		    cargarTabla("proyectoCurricular", valor);
		});




	});

	function cargarTabla(tipo, valor){
		$.ajax({
			url  : "../logica/dispatcher.php",
			type : "post",
			datatype : "json",
			data : { filtrar : tipo, valor:valor},
			success: function(respuesta){			
				var datos=JSON.parse(respuesta);			
				console.log(datos);
				$.each(datos, function( index, estudiante ) {					
					construirItems(estudiante.K_CODEST,estudiante.N_NOMEST,estudiante.N_PROYECTOEST,estudiante.N_FACEST, estudiante.N_DIREST);			
				});
			}
			
		});
	}



	function construirItems(codigo, nombre, proyecto, facultad, estado){
		$("#cuerpoLista").html("");
		var html= `
			<!--Inicio Grupo -->
			<tr>
				<td>`+nombre+`</td>
				<td>`+codigo+`</td>
				<td>`+proyecto+`</td>
				<td>`+facultad+`</td>
				<td>`+estado+`</td>				
			</tr>
			<!--Fin Grupo -->
		`;		
		$("#cuerpoLista").append(html);
	}


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
				console.log(String(respuesta));
				console.log("hola");
			}
		});
	}

	function cargarFiltros(){
		//para facultad
		$.ajax({
			url  : "../logica/dispatcher.php",
			type : "post",
			datatype : "json",
			data : { cargarDatosFacultades : "true"},
			success: function(respuesta){
				var datos=JSON.parse(respuesta);			
				console.log(datos);	
				$.each(datos, function( index, value ) {					
					var html= `
						<option value="`+value+`">`+value+`</option>
						`;		
					//$("#codigo").css("display","block");
					$("#facultad").append(html);		
				});
			}
			
		});

		//para proyecto
		$.ajax({
			url  : "../logica/dispatcher.php",
			type : "post",
			datatype : "json",
			data : { cargarDatosProyectosCurriculares : "true"},
			success: function(respuesta){			
				var datos=JSON.parse(respuesta);			
				console.log(datos);
				$.each(datos, function( index, value ) {					
					var html= `
						<option value="`+value+`">`+value+`</option>
						`;		
					//$("#codigo").css("display","block");
					$("#proyectoCurricular").append(html);	
				});
			}
			
		});
	}

	

</script>
</body>
</html>
