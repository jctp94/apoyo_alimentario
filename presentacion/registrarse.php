<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Login</title>
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
		<div class="main row">
 			<div id="logo" align="center" style="text-align:center; max-width:800px; margin:0 auto;">
				<img src="img/logoud.png" style="width:200px;"  />
			</div>
		</div>
		<div style="margin:10px;" class="main row"></div>
		<div class="main row">
			<div class="col-xs-1 col-sm-2 col-md-3"></div>
			<div id="textoTitulo" align="center" class="col-xs-10 col-sm-8 col-md-6">
				Escriba su codigo de Estudiante:
			</div>
		</div>
		<div class="main row">
			<div class="col-xs-1 col-sm-2 col-md-3"></div>
			<div id="textoForm" align="center" style="font-size: 20px;" class="col-xs-10 col-sm-8 col-md-6">
				<div style="height: 10px;"></div>
				<form id="form-datos" name="form-datos" method="POST" >
					<div class="form-group">
						<label class="control-label col-md-6 col-xs-12" for="first-name">Codigo: <span class="required">*</span>
						</label>
						<div class="col-md-5 col-xs-12">
							<input type="number" min=0 class="entrada form-control col-md-3 col-xs-12" required id="codigo">
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-6 col-xs-12" for="first-name">Contraseña: <span class="required" >*</span>
						</label>
						<div class="col-md-5 col-xs-12">
							<input type="password" class="entrada form-control col-md-3 col-xs-12" required id="pswd">
						</div>
					</div>
					<br><br>
					<div class="form-group">
						<label class="control-label col-md-6 col-xs-12" for="first-name">Repita la contraseña: <span class="required" >*</span>
						</label>
						<div class="col-md-5 col-xs-12">
							<input type="password" class="entrada form-control col-md-3 col-xs-12" required id="pswd">
						</div>
					</div>
					<br><br>
					<button type="submit" class="botonSubmit">REGISTRARSE</button>
					<br>
					<br>
				</form>
			</div>
		</div>
				<br>
 			<div id="pata" align="center" style="text-align:center;">

			</div>

	</div>
<script src="js/jquery.js"></script>
<script>
	// FORMULARIO DATOS COMPAÑIA
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
		console.log(datos);
		$.ajax({
			url  : "../logica/dispatcher.php",
			type : "post",
			data : { registrarse : datos},
			beforeSend: function () {
                    $("#btn-enviar").val("Procesando, espere por favor...");
            },
			success: function(respuesta){
				if (respuesta[0]=="{") {
					var rta =JSON.parse(respuesta);
					swal("Usuario creado", "Usuario: "+rta.usuario +"\n"+"Contraseña: "+ rta.pswd, "success");
					//location.href='login.php';
				}else{
					swal("Error", respuesta, "error");
				}
				console.log(respuesta);

			}
		});
		return false;
	});

</script>


</body>
</html>
