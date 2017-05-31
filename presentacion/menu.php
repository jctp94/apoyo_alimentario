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
		<div class="main row">
 			<div id="logo" align="center" style="text-align:center; max-width:800px; margin:0 auto;">
				<img src="img/logoud.png" style="width:200px;"  />
			</div>
		</div>
		<div style="margin:10px;" class="main row"></div>
		<div class="main row">
			<div class="col-xs-1 col-sm-2 col-md-3"></div>
			<div id="textoTitulo" align="center" class="col-xs-10 col-sm-8 col-md-6">
				BIENVENIDO AL PROGRAMA DE APOYO ALIMENTARIO
			</div>
		</div>
		<div class="main row">
			<div class="col-xs-1 col-sm-2 col-md-3"></div>
			<div id="textoForm" align="center" style="font-size: 20px;" class="col-xs-10 col-sm-8 col-md-6">
				<div style="height: 10px;"></div>
				ELIGE UNA DE LAS OPCIONES:
				<br><br>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<form name="logueo" action="crearSolicitud.php" method="POST" class="md-col-4" >
							<button type="submit" class="botonSubmit">SOLICITAR APOYO</button>
						</form>
					</div>
					<div class="col-md-4">
						<form name="logueo" action="crearConvocatoria.php" method="POST" class="md-col-4">
				        	<button type="submit" class="botonSubmit">CREAR CONVOCATORIA</button>
						</form>
					</div>	
				</div>
                <div class="row">
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button id="salir" class="botonSubmit">Salir</button>
					</div>	
                </div>
				<br>
			</div>
		</div>
		<br>
 		
	</div>


</body>
</html>
    
<script src="js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#salir").click(function(){
            $.ajax({
			 url  : "../logica/dispatcher.php",
			 type : "post",
			 datatype : "json",
			 data : { salir : "salir"},
			 success: function(respuesta){
				location.href='principalApoyo.php';
			 }
		    });
        });
	});    
</script>
