<?php
include_once('Conexion.php');
include_once('../logica/Solicitud.php');

  class SolicitudDAO {

    public function __construct() {

    }
    public function registrarSolicitud($docs){
      session_start();
      $conn = new Conexion($_SESSION['usuario'], $_SESSION['pswd']  );
      $array=$conn->conectar();
      if (!$array["estado"]) {
        $error = array(
            "estado" => false,
            "mensaje" => $array['mensaje'],
        );
        return $error;
      }else {
        $consulta="INSERT INTO SOLICITUD VALUES (incremento_id_solicitud.nextval,'P', NULL, 'Solicitud pendiente de revisión',(SELECT LTRIM(USER, 'U') FROM DUAL), (SELECT K_IDCONV FROM CONVOCATORIA WHERE I_ESTADOCONV='A'))";
        $stid = oci_parse($array["conexion"], $consulta);
        $r = @oci_execute($stid);
        if (!$r) {
            $e = oci_error($stid);  // Para errores de oci_execute, pase el gestor de sentencia
            echo
            $rta = array(
                "estado" => false,
                "mensaje" => $e['message'],
            );
            $conn->desconectar($array["conexion"]);
            return $rta;
        }
      	for ($i=0; $i < count($docs) ; $i++) {
      		if( isset($_FILES[$docs[$i]])){
      			$pdf = new upload($_FILES[$docs[$i]]);
      			if ($pdf->uploaded)
      			{
      				$pdf->image_resize         		= true; // default is true
      				$pdf->image_x              		= 1000; // para el ancho a cortar
      				$pdf->image_ratio_y        		= true; // para que se ajuste dependiendo del ancho definido
      				$pdf->file_new_name_body   		=  $_SESSION['usuario'].$docs[$i]; // agregamos un nuevo nombre
      				$pdf->image_watermark      		= 'watermark.png'; // marcado de agua
      				$pdf->image_watermark_position 	= 'BR'; // donde se ub icara el marcado de agua. Bottom Right
      				$pdf->process('../archivos/');
              $ruta="../archivos/".$_SESSION['usuario'].$docs[$i];
      				//echo 'El pdf ha sido subido correctamente';
              $insertar="INSERT INTO SOPORTE VALUES (incremento_id_soporte.nextval,'".$ruta."', (SELECT N_DESCCOND FROM CONDICION WHERE K_IDCOND=".substr($docs[$i], -2)."), 'P', NULL,(SELECT K_IDSOL FROM SOLICITUD WHERE K_CODEST=(SELECT LTRIM(USER, 'U') FROM DUAL)) ,".substr($docs[$i], -2).")";
              $stid = oci_parse($array["conexion"], $insertar);
              $r = @oci_execute($stid);
              if (!$r) {
                  $e = oci_error($stid);  // Para errores de oci_execute, pase el gestor de sentencia
                  echo
                  $rta = array(
                      "estado" => false,
                      "mensaje" => $e['message'],
                  );
                  $conn->desconectar($array["conexion"]);
                  return $rta;
              }
      			}
      			else
      			{
      				//echo 'error : ' . $pdf->error;
      			}
      		}
      	}

        $rta = array(
            "estado" => true,
            "mensaje" => "bien",
        );
        $conn->desconectar($array["conexion"]);
        return $rta;
      }

    }
  }

?>
