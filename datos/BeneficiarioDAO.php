<?php
include_once('Conexion.php');
include_once('../logica/Beneficiario.php');

  class BeneficiarioDAO {

    public function __construct() {

    }

    function retirarApoyo($codigo){
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
        $consulta="UPDATE BENEFICIARIO SET I_ESTADOBENEF='R' WHERE K_IDSOL=(select s.K_IDSOL from solicitud s, estudiante e where s.K_CODEST=e.K_CODEST and e.K_CODEST=".$codigo.")";                    
        $stid = oci_parse($array["conexion"], $consulta);
        $r = oci_execute($stid);  
        if (!$r) {
          $e = oci_error($stid);  // Para errores de oci_execute, pase el gestor de sentencia
          $rta = array(
              "estado" => false,
              "mensaje" => $e['message'],
          );
          $conn->desconectar($array["conexion"]);
          return $rta;
        }
        
      }
      $rta = array(
          "estado" => true,
          "mensaje" => "bien",            
      );
      $conn->desconectar($array["conexion"]);
      return $rta;
    }

  }//FIN CLASS
  

?>
