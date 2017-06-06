<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Retirar Apoyo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css?v=2">
    <script src="dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<body>
	<div class="contenedor">
		<div style="margin:10px;" class="main row"></div>

		<div style="margin:10px;" class="main row"></div>
		<div class="main row">
			<div class="col-xs-1 col-sm-2 col-md-2"></div>
			<div id="textoTitulo" align="center" class="col-xs-10 col-sm-8 col-md-8">
				Retirar Apoyo a Estudiante Beneficiario
			</div>
		</div>
		<div class="main row">
			<form id="form-datos" class="form-horizontal " method="POST">
				<div class="col-xs-1 col-sm-2 col-md-2"></div>
				<div id="textoForm" align="center" style="font-size: 20px;" class="col-xs-10 col-sm-8 col-md-8">
					<div style="height: 10px;"></div>
				 
					<div class="form-group">
						<label class="control-label col-md-5 col-sm-3 col-xs-12" for="first-name">Codigo Estudiantil<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<select type="number" class="entrada form-control col-md-3 col-xs-12" required id="codigo">
								<option value="">Seleccione...</option>								
							</select>
						</div>
					</div>					  

					<button id="btn-enviar" type="submit" class="botonSubmit">ENVIAR</button>
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
<script>
	// FORMULARIO DATOS COMPAÑIA
	$(document).ready(function(){
		cargarListaCodigos();
		verlog();
        $("#inicio").click(function(){
            location.href='menu.php';
        });
	});

	function cargarListaCodigos(){
		$.ajax({
			url  : "../logica/dispatcher.php",
			type : "post",
			datatype : "json",
			data : { cargarListaCodigos : "Recuperar Lista de Codigos"},
			success: function(respuesta){			
				var datos=JSON.parse(respuesta);			
				console.log(datos);	
				$.each(datos, function( index, codigo ) {					
					construirItems(codigo);			
				});					
			}		
		});
	}

	function construirItems(codigo){
		var html= `
			<option value="`+codigo+`">`+codigo+`</option>
			`;		
		//$("#codigo").css("display","block");
		$("#codigo").append(html);
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
		});	
		//capturando selects
		$("#"+form+" select").each(function(i){
			var este 		= $(this),
				idinput 	= este.attr("id"),
				valorinput	= este.children(":selected").attr("value");
				if (valorinput!="") {
					datos[idinput] = valorinput;
				}
		});
		console.log(datos);

		$.ajax({
			url  : "../logica/dispatcher.php",
			type : "post",
			data : { retirarApoyo : datos["codigo"]},
			beforeSend: function () {
	                $("#btn-enviar").val("Procesando, espere por favor...");
	        },
			success: function(respuesta){
				console.log("res"+respuesta);
				if (respuesta=="bien") {
					swal({   title: "Operación exitosa",   
						text: "Se ha retirado correctamente al estudiante del apoyo",   
						type: "success",   
						showCancelButton: false,   
						closeOnConfirm: false,   
						showLoaderOnConfirm: true, 
					}, function(){   
						setTimeout(function(){     
							document.location.href='menu.php';   
						}, 1000); 
					});					
				}else {
					swal("Error",respuesta,"error")
				}

			}
		});
		return false;
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

</script>

</body>
</html>
