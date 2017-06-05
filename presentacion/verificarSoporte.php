<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Verificar Soporte</title>
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
				Verificar Soporte
			</div>
		</div>
		<div class="main row">			
			<div class="col-xs-1 col-sm-2 col-md-2"></div>
			<div id="textoForm" align="center" style="font-size: 20px;" class="col-xs-10 col-sm-8 col-md-8 tablaVerificar">
				<div style="height: 10px;"></div>
				Listado de personas inscritas al apoyo alimentario
				<br><br>
				<table class="table table-bordered centrado" >
					<thead>
						<tr>
							<th class="centrado">NOMBRE COMPLETO</th>
							<th class="centrado">CODIGO</th>
							<th class="centrado">VERIFICAR</th>
						</tr>
					</thead>
					<tbody id="cuerpoLista">
						<tr>
							<td>Edgar Mauricio Parada Colmenares asdasdasd</td>
							<td>20112020018</td>
							<td style='text-align: center;'><button type='button' onclick='javascript:location.href="verificarSoporteEstudiante.php?estudiante=20112020048"' class='btnAgregar btn btn-success'><span class='glyphicon glyphicon-cloud-upload' aria-hidden='true'></span></button></td>
						</tr>
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
				console.log(String(respuesta));
				console.log("hola");
			}
		});
	}

	function cargarDatos(){
		$.ajax({
			url  : "../logica/dispatcher.php",
			type : "post",
			datatype : "json",
			data : { cargarDatosListadoInscritos : "true"},
			success: function(respuesta){			
				var datos=JSON.parse(respuesta);			
				console.log(datos);
				$.each(datos, function( index, soporte ) {
					var grupo=soporte.K_IDCOND.substr(0,1);
					var tipo=retornarTituloGrupo(grupo);	
					var valor=soporte.N_VALORSOP;			
					var rutaDocumento=soporte.O_DOCSOP;
					var idCondicion=soporte.K_IDCOND;
					construirItems(grupo,tipo,valor,rutaDocumento,idCondicion);			
				});
			}
			
		});
	}

	function construirItems(grupo, tipo,valor, rutaDocumento,idCondicion){
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
					<label class="radio-inline"><input required type="radio" id="autorizacionSi" name="`+idCondicion+`" value='SI'>Si</label>
					<label class="radio-inline"><input type="radio" id="autorizacionNo" name="`+idCondicion+`" value='NO' >No</label>
				</div>
			</div>
			<!--Fin Grupo -->
		`;
		$("#grupo"+grupo).css("display","block");
		$("#grupo"+grupo).append(html);
	}






	$('#form-datos').submit(function(){
		event.preventDefault();
		//alert("enviando");
		// Capturando datos
		var datos = {},
			form  = $(this).attr("id");
		// input style="font-size:12px; background-color:#EFF0F0; border-radius: 0px; border:0px;"s text y select style="font-size:12px; background-color:#EFF0F0; border-radius: 0px; border:0px;"s
		$("#"+form+" input:not([type=submit], [type=radio])").each(function(i){
			var este 		= $(this),
				idinput 	= este.attr("id"),
				valorinput	= este.val();
				if (este.val()!="") {
					datos[idinput] = valorinput;
		}
		//capturando selects
		$("#"+form+" select").each(function(i){
			var este 		= $(this),
				idinput 	= este.attr("id"),
				valorinput	= este.children(":selected").attr("value");
				if (valorinput!="") {
					datos[idinput] = valorinput;
				}
		});

	});

	console.log(datos);

	$.ajax({
		url  : "../logica/dispatcher.php",
		type : "post",
		data : { convocatoria : datos},
		beforeSend: function () {
                $("#btn-enviar").val("Procesando, espere por favor...");
        },
		success: function(respuesta){
			console.log("res"+respuesta);
			if (respuesta=="bien") {
				swal("Operación exitosa", "La convocatoria se ha creado", "success");
				//location.href='crearSolicitud.php';
			}else {
				swal("Error",respuesta,"error")
			}

		}
	});
	return false;
	});

</script>

</body>
</html>
