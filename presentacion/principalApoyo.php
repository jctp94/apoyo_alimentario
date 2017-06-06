<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>CODIGO</title>
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
		<div class="col-md-1"></div>
		<div class="main row col-md-3">
 			<div id="logo" align="center" style="text-align:center; max-width:800px; margin:0 auto;">
				<img src="img/logoud.png" style="width:200px;"  />
			</div>
		</div>
		<div id="tituloConvocatoria" class="main row col-md-7" style="display:none;">
 			CONVOCATORIA ABIERTA PARA EL APOYO ALIMENTARIO EN LA UNIVERSIDAD DISTRITAL FRANCISCO JOSE DE CALDAS <br>
 			<div id="textoConvocatoria">
 				<br>
	 				 			
 			</div>
		</div>
		<div style="margin:100px;" class="main row"></div>
		
		<div class="row">
			<div class="col-md-3"></div>
			<div class="main row col-md-6">
				<div class="col-md-3"></div>
				<div id="textoTitulo" align="center" class="col-xs-10 col-sm-8 col-md-12">
					BIENVENIDO AL PROGRAMA DE APOYO ALIMENTARIO
				</div>
			</div>
		</div>		

		<div class="row">
			<div class="col-md-3"></div>
			<div class="main row col-md-6">
				<div class="col-xs-1 col-sm-2 col-md-3"></div>
				<div id="textoForm" align="center" style="font-size: 20px;" class="col-md-12">
					<div style="height: 10px;"></div>
					ELIGE UNA DE LAS OPCIONES:
					<br><br>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4">
							<form name="logueo" action="login.php" method="POST" class="md-col-4" >
								<button type="submit" class="botonSubmit">Iniciar sesion</button>
							</form>
						</div>
						<div class="col-md-4">
							<form name="logueo" action="registrarse.php" method="POST" class="md-col-4">
								<button type="submit" class="botonSubmit">Registrarse</button>
							</form>
						</div>					
					</div>
					<br><br>
				</div>
			</div>
		</div>
	
 			
	</div>

<script src="js/jquery.js"></script>
<script>
$(document).ready(function(){
	cargarDatosConvocatoria();
});

function cargarDatosConvocatoria(){

	$.ajax({
		url  : "../logica/dispatcher.php",
		type : "post",
		datatype : "json",
		data : { cargarDatosConvocatoria : "Convocatoria Activa en Home"},
		success: function(respuesta){			
			var datos=JSON.parse(respuesta);			
			console.log(datos);	
			if (datos["F_INICONV"]!== null) {
				construirItems(datos["F_INICONV"], datos["F_FINCONV"], datos["V_COSTOALMUERZO"] );										
			}
		}		
	});
}

function construirItems(inicio, fin, valor){
	var html= `
		<!--Inicio Grupo -->
		Entre `+inicio+`  y `+fin+` <br>
		Costo por Almuerzo: $`+valor+`<br>		
		<!--Fin Grupo -->
	`;		
	$("#tituloConvocatoria").css("display","block");
	$("#tituloConvocatoria").append(html);
}


</script>


</body>
</html>
