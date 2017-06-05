<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Verificar Soportes</title>
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
			<div class="col-xs-1 col-sm-2 col-md-1"></div>
			<div id="textoTitulo" align="center" class="col-xs-10 col-sm-8 col-md-10">
				Verificación de Soportes ingresados en el sistema
			</div>
		</div>
		<div class="main row">
			<form id="form-datos" name="form-datos" class="form-horizontal form-label-left" method="POST">
				<div class="col-xs-1 col-sm-2 col-md-1"></div>
				<div id="textoForm" align="center" style="font-size: 20px;" class="col-xs-10 col-sm-8 col-md-10">
					
					<div style="height: 10px;"></div>

					<div id="main">
						<div id="grupo1" style="display:none;">
							<div class="row">
								<label class="control-label col-md-5 col-sm-3 col-xs-12 tituloGrupo">Ingresos Familiares</label>
							</div>
						</div>

						<div id="grupo2" style="display:none;">
							<div class="row">
								<label class="control-label col-md-5 col-sm-3 col-xs-12 tituloGrupo">Condiciones familiares</label>
							</div>
						</div>

						<div id="grupo3" style="display:none;">
							<div class="row">
								<label class="control-label col-md-5 col-sm-3 col-xs-12 tituloGrupo">Procedencia y lugar de residencia</label>
							</div>
						</div>

						<div id="grupo4" style="display:none;">
							<div class="row">
								<label class="control-label col-md-3 col-sm-3 col-xs-12 tituloGrupo">Condiciones de salud</label>
							</div>
						</div>
					</div>

					<input type="hidden" id="codigoEstudiante" value="<?php echo $_GET["estudiante"]?>" >

					<button type="submit" class="botonSubmit">ENVIAR</button>
                    <button id="inicio" class="botonSubmit">INICIO</button>
					<br><br>
				</div>
			</form>
		</div>
				<br>
 			<div id="pata" align="center" style="text-align:center;">

			</div>

	</div>

<script src="js/jquery.js"></script>

<?php
	//utilizado para recibir por parametros get el codigo del estudiante.
	if (isset($_GET["estudiante"])) {
		echo "<script type='text/javascript'>var estudiante=".$_GET["estudiante"].";</script>";		
	}else{
		echo "<script type='text/javascript'>window.location='verificarSoporte.php';</script>";				
	}

?>
<script>
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
			console.log(String(respuesta));
		}
	});
}

function cargarDatos(){
	$.ajax({
		url  : "../logica/dispatcher.php",
		type : "post",
		datatype : "json",
		data : { cargarDatosverificarSoporte : estudiante},
		success: function(respuesta){			
			var datos=JSON.parse(respuesta);			
			console.log(datos);
			$.each(datos, function( index, soporte ) {
				var grupo=soporte.K_IDCOND.substr(0,1);
				var tipo=retornarTituloGrupo(grupo);	
				var valor=soporte.N_VALORSOP;			
				var rutaDocumento=soporte.O_DOCSOP;
				var idCondicion=soporte.K_IDCOND;
				var idSoporte=soporte.K_IDSOP;
				construirItems(grupo,tipo,valor,rutaDocumento,idCondicion,idSoporte);			
			});			
		}
		
	});
}

function construirItems(grupo, tipo,valor, rutaDocumento,idCondicion, idSoporte){
	var html= `
		<!--Inicio Grupo -->
		<div class="form-group">				
			<div class="col-md-7 col-xs-12 izq">
				<label class="entrada form-control col-md-3 col-xs-12" for="">`+valor+`</label>
			</div>
			<div class="col-md-2 col-sm-6 col-xs-12">
				<a  class="form-control col-md-7 col-xs-12" target="_blank" href="`+rutaDocumento+`.pdf">Ver Soporte</a>							
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label for="">¿Válido?</label>
				<label class="radio-inline"><input required type="radio" id="autorizacionSi" name="`+idSoporte+`" value='SI'>Si</label>
				<label class="radio-inline"><input type="radio" id="autorizacionNo" name="`+idSoporte+`" value='NO' >No</label>
			</div>
		</div>
		<!--Fin Grupo -->
	`;
	$("#grupo"+grupo).css("display","block");
	$("#grupo"+grupo).append(html);
}

function retornarTituloGrupo(numero){	
	switch (numero) { 
		case "1": 
			return 'Ingresos familiares';
			break;
		case '2': 
			return 'Condiciones familiares';
			break;
		case '3': 
			return 'Procedencia y lugar de residencia';
			break;		
		case '4': 
			return 'Condiciones de salud';
			break;
		default:
			return 'Ninguno';
	}
}


$('#form-datos').submit(function(){
	event.preventDefault();
	form  = $(this).attr("id");
	datos={};

	$("#"+form+" input:not([type=submit], [type=radio], [type=checkbox] )").each(function(i){
		var este 		= $(this),
			idinput 	= este.attr("id"),
			valorinput	= este.val();
			datos[idinput] = valorinput; 
	});
	
	//capturando RADIO
	$("input:checked").each(function(i){
		var este 		= $(this),
		idinput 	= este.attr("name"),
		valorinput	= este.val();		
		datos[idinput] = valorinput; 
	});	

	console.log(datos);	

	$.ajax({
		url  : "../logica/dispatcher.php",
		type : "post",
		datatype : "json",
		data : { verficarSoporte : datos},	
		success: function(respuesta){
			if (respuesta=="bien") {
				swal("Solicitud Verificada", "Estado de la Solicitud Guardada.", "success");
				//location.href='verificarSoporte.php';
			}else{
				swal("Error", respuesta, "error");
			}
		},
		complete : function(xhr, status) {
		//location.href='login.php';
		}
	});
	return false;
});
</script>
</body>
</html>
