<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Crear Solicitud</title>
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
				Crear Solicitud para Apoyo Alimentario
			</div>
		</div>
		<div class="main row">
			<form id="form-datos" name="form-datos" enctype="multipart/form-data"  class="form-horizontal form-label-left" method="POST">
				<div class="col-xs-1 col-sm-2 col-md-1"></div>
				<div id="textoForm" align="center" style="font-size: 20px;" class="col-xs-10 col-sm-8 col-md-10">
					<div id="infoEstudiante">

					</div>
					<div style="height: 10px;"></div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ingresos Familiares<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-6 col-xs-12">
						<select class="entrada form-control col-md-3 col-xs-12" required id="ingresosFamiliares" name="ingresosFamiliares">
						<option value="">Seleccione...</option>
						<option value="11">0-1 SMMLV	</option>
						<option value="12">1-2 SMMLV</option>
						<option value="13">2-3 SMMLV</option>
						<option value="14">Mas de 3 SMMLV</option>
						</select>
						</div>
						<div class="col-md-5 col-sm-6 col-xs-12">
						<input type="file" required name="docIngresosFamiliares" id="docIngresosFamiliares" class="form-control col-md-7 col-xs-12" accept=".pdf">
						</div>
					</div>
					<div class="form-group">
					    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Condiciones Familiares <span class="required">*</span>
					    </label>
					    <div class="grupoInputs col-md-9 col-sm-6 col-xs-12">
					    	<div class="row">
					    		<div class="checkbox col-md-6">
								  <label><input type="checkbox" id="21" name="21"  value="21">Sostiene el hogar en el que vive.</label>
								</div>
								<div id="div21" style="display:none;" class="checkbox col-md-6">
								  <input type="file" name="doc21" id="doc21"  class="form-control col-md-7 col-xs-12" accept=".pdf">
								</div>
					    	</div>
					    	<div class="row">
					    		<div class="checkbox col-md-6">
								  <label><input type="checkbox" id="22" value="ingresosFamiliares">Se sostiene a si mismo.</label>
								</div>
								<div id="div22" style="display:none;" class="checkbox col-md-6">
								  <input type="file" id="doc22" name="doc22"    class="form-control col-md-7 col-xs-12" accept=".pdf">
								</div>
					    	</div>
					    	<div class="row">
					    		<div class="checkbox col-md-6">
								  <label><input type="checkbox" id="23" value="ingresosFamiliares">Vive fuera de su nucleo familiar inmediato</label>
								</div>
								<div  id="div23" style="display:none;" class="checkbox col-md-6">
								  <input type="file" id="doc23" name="doc23"  class="form-control col-md-7 col-xs-12" accept=".pdf">
								</div>
					    	</div>
					    	<div class="row">
					    		<div class="checkbox col-md-6">
								  <label><input type="checkbox" id="24"  value="ingresosFamiliares">Tiene conyuge, hijos y/u otras personas a cargo.</label>
								</div>
								<div id="div24" style="display:none;" class="checkbox col-md-6">
								  <input type="file" id="doc24" name="doc24"   class="form-control col-md-7 col-xs-12" accept=".pdf">
								</div>
					    	</div>

					    </div>
					    <div class="col-md-1 col-sm-6 col-xs-12">

					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Procedencia y lugar de residencia <span class="required">*</span>
					    </label>
					    <div class="col-md-9 grupoInputs col-sm-6 col-xs-12">
					    	<div class="row">
					    		<div class="checkbox col-md-6">
								  <label><input type="checkbox" id="31"  value="ingresosFamiliares">Vive en casa del empleador.</label>
								</div>
								<div  id="div31" style="display:none;" class="checkbox col-md-6">
								  <input type="file" id="doc31" name="doc31" class="form-control col-md-7 col-xs-12" accept=".pdf">
								</div>
					    	</div>
					    	<div class="row">
					    		<div class="checkbox col-md-6">
								  <label><input type="checkbox" id="32" value="ingresosFamiliares">Se encuentra en condicion de desplazamiento forzado.</label>
								</div>
								<div id="div32" style="display:none;" class="checkbox col-md-6">
								  <input type="file" id="doc32" name="doc32" class="form-control col-md-7 col-xs-12" accept=".pdf">
								</div>
					    	</div>
					    	<div class="row">
					    		<div class="checkbox col-md-6">
								  <label><input type="checkbox" id="33"  value="ingresosFamiliares">Proviene de municipios distintos a Bogota.</label>
								</div>
								<div id="div33" style="display:none;" class="checkbox col-md-6">
								  <input type="file" id="doc33" name="doc33"  class="form-control col-md-7 col-xs-12" accept=".pdf">
								</div>
					    	</div>
					    	<div class="row">
					    		<div class="checkbox col-md-6">
								  <label><input type="checkbox" id="34"  value="ingresosFamiliares">Reside en zonas de alto grado de vulnerabilidad social y economica.</label>
								</div>
								<div id="div34" style="display:none;" class="checkbox col-md-6">
								  <input type="file" id="doc34" name="doc34"  class="form-control col-md-7 col-xs-12" accept=".pdf">
								</div>
					    	</div>

					    </div>

					  </div>
					  <div class="form-group">
					    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Condiciones de Salud<span class="required">*</span>
					    </label>
					     <div class="grupoInputs col-md-9 col-sm-6 col-xs-12">
					    	<div class="row">
					    		<div class="checkbox col-md-6">
								  <label><input type="checkbox" id="41" value="ingresosFamiliares">Presenta algun tipo de discapacidad fisica o mental.</label>
								</div>
								<div id="div41" style="display:none;" class="checkbox col-md-6">
								  <input type="file" name="doc41" id="doc41"  class="form-control col-md-7 col-xs-12" accept=".pdf">
								</div>
					    	</div>
					    	<div class="row">
					    		<div class="checkbox col-md-6">
								  <label><input type="checkbox" id="42"  value="ingresosFamiliares">Sufre alguna patologia o sintomatologia asociada con problemas de alimentacion.</label>
								</div>
								<div id="div42" style="display:none;" class="checkbox col-md-6">
								  <input type="file" name="doc42" id="doc42"  class="form-control col-md-7 col-xs-12" accept=".pdf">
								</div>
					    	</div>
					    </div>
					  </div>
					<button type="submit" class="botonSubmit">ENVIAR</button>
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


$(document).ready(function(){
	verlog();
	$("input[type='checkbox']").change(function() {			
		var id=this.getAttribute("id");
    	//alert(id);
	    if(this.checked) {
	    	$("#div"+id).css("display","block");
	    	$("#doc"+id).attr("required","true");
	    }else{
	    	$("#div"+id).css("display","none");
	    	$("#doc"+id).attr("required","false");
	    }
	});

});
function verlog(){

	$.ajax({
		url  : "../logica/dispatcher.php",
		type : "post",
		datatype : "json",
		data : { log : "estudiante"},
		success: function(respuesta){
			if (respuesta=="no") {
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
		data : { cargarDatosEst : "estudiante"},
		success: function(respuesta){
			console.log("respuesta:"+respuesta);
			var datos=JSON.parse(respuesta);

        // Recorrer el vector de objetos e imprimir la propiedad "nombre" en la consola
        $("#infoEstudiante").append("Codigo Estudiante: "+datos['K_CODEST']+"<br>"+
			"Estudiante: "+datos['N_NOMEST']+"<br>Correo: "+datos['N_CORREOEST']+"<br>"+
			"Facultad: "+datos['N_FACEST']+"<br> Proyecto Curricular: "+datos['N_PROYECTOEST']+"<br>");
		}
	});
}
$('#form-datos').submit(function(){
	event.preventDefault();

	form  = $(this).attr("id");
	datos={};
	//capturando selects
	$("#"+form+" select").each(function(i){
		var este 		= $(this),
			idinput 	= este.attr("id"),
			valorinput	= este.children(":selected").attr("value");
			if (valorinput!="") {
				switch (valorinput){
					case "11":
						$("#docIngresosFamiliares").attr("name","doc11");
						$("#docIngresosFamiliares").attr("id","doc11");
						break;
					case "12":
						$("#docIngresosFamiliares").attr("name","doc12");
						$("#docIngresosFamiliares").attr("id","doc12");

						break;
					case "13":
						$("#docIngresosFamiliares").attr("name","doc13");
						$("#docIngresosFamiliares").attr("id","doc13");
						break;
					default:
						$("#docIngresosFamiliares").attr("name","doc14");
						$("#docIngresosFamiliares").attr("id","doc14");
				}
				datos[idinput] = valorinput;
			}
	});

	$("#"+form+" input:not([type=submit], [type=radio])").each(function(i){
		var este 		= $(this),
			idinput 	= este.attr("id"),
			valorinput	= este.val();
			if (este.val()!="") {
				datos[idinput] = valorinput;
			}
	});

	var formData = new FormData(document.getElementById("form-datos"));

	console.log(formData);
	$.ajax({
					url: "../logica/dispatcher.php",
					type: "POST",
					data: formData,
					contentType: false,
			processData: false,
			success: function(respuesta){
				if (respuesta=="bien") {
					swal("Solicitud enviada", "Le confirmaremos su estado pronto", "success");
					//location.href='login.php';
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

	// FORMULARIO DATOS COMPAÑIA
/*	$('#form-datos').submit(function(){
		event.preventDefault();



		$.ajax({
			url  : "../logica/dispatcher.php",
			type : "post",
			data : { solicitud : "crearSolicitud"},
			beforeSend: function () {
                    $("#btn-enviar").val("Procesando, espere por favor...");
            },
			success: function(respuesta){
				console.log("res"+respuesta);

			}
		});
		return false;
	}); */

</script>

</body>
</html>
