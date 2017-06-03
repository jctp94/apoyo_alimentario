<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Crear Convocatoria</title>
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
				Crear Convocatoria
			</div>
		</div>
		<div class="main row">
			<form id="form-datos" class="form-horizontal " method="POST">
				<div class="col-xs-1 col-sm-2 col-md-2"></div>
				<div id="textoForm" align="center" style="font-size: 20px;" class="col-xs-10 col-sm-8 col-md-8">
					<div style="height: 10px;"></div>
				  <!--<div class="form-group">
						<label class="control-label col-md-5 col-sm-3 col-xs-12" for="first-name">Periodo Academico<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<select class="entrada form-control col-md-3 col-xs-12" required id="K_IDPERACAD">
								<option value="">Seleccione...</option>
								<option value="00000016">Segundo semestre anio 2017</option>
							</select>
						</div>
					</div> -->
					<div class="form-group">
						<label class="control-label col-md-5 col-sm-3 col-xs-12" for="first-name">Fecha de Apertura<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<input type="date" class="entrada form-control col-md-3 col-xs-12" required id="F_INICONV">
						</div>
					</div>
					  <div class="form-group">
					    <label class="control-label col-md-5 col-sm-3 col-xs-12" for="first-name">Fecha de Cierre<span class="required">*</span>
					    </label>
					    <div class="col-md-3 col-sm-6 col-xs-12">
							<input type="date" class="entrada form-control col-md-3 col-xs-12" required id="F_FINCONV">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-md-5 col-sm-3 col-xs-12" for="first-name">Costo total de cada almuerzo<span class="required">*</span>
					    </label>
					    <div class="col-md-3 col-sm-6 col-xs-12">
							<input type="number" class="entrada form-control col-md-3 col-xs-12" min="0" required id="V_COSTOALMUERZO">
					    </div>
					  </div>
				  	  <div class="form-group">
					    <label class="control-label col-md-5 col-sm-3 col-xs-12" for="first-name">Cupos Disponibles para Subsidio Tipo A<span class="required">*</span>
					    </label>
					    <div class="col-md-3 col-sm-6 col-xs-12">
							<input type="number" class="entrada form-control col-md-3 col-xs-12" min="0" required id="cuposTipoA">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-md-5 col-sm-3 col-xs-12" for="first-name">Cupos Disponibles para Subsidio Tipo B<span class="required">*</span>
					    </label>
					    <div class="col-md-3 col-sm-6 col-xs-12">
							<input type="number" class="entrada form-control col-md-3 col-xs-12" min="0" required id="cuposTipoB">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-md-5 col-sm-3 col-xs-12" for="first-name">Cupos Disponibles para Subsidio Total<span class="required">*</span>
					    </label>
					    <div class="col-md-3 col-sm-6 col-xs-12">
							<input type="number" class="entrada form-control col-md-3 col-xs-12" min="0" required id="cuposTotal">
					    </div>
					  </div>

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
<script>
	// FORMULARIO DATOS COMPAÑIA
	$(document).ready(function(){
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
