<?php
include_once('Conexion.php');
include_once('../logica/Soporte.php');

  class SoporteDAO {

    public function __construct() {

    }

    public function consultarSoportes($codigo){
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
        $soportes=array();
        $consulta = "select s.O_DOCSOP, s.N_VALORSOP, s.K_IDCOND from soporte s, condicion c where c.K_IDCOND=s.K_IDCOND and s.K_IDSOL=(select s.K_IDSOL from solicitud s, estudiante e where s.K_CODEST=e.K_CODEST and e.K_CODEST=".$codigo.")"; 
        //echo "sql: ". $sql;        
        $stid = oci_parse($array["conexion"], $consulta);
        oci_execute($stid);
        
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {        
          $sop = new Soporte($row["O_DOCSOP"],
          $row["N_VALORSOP"],
          $row["K_IDCOND"]);
          array_push($soportes, $sop);
        }       
        $rta = array(
            "estado" => true,
            "soporte" => $soportes,            
        );
        $conn->desconectar($array["conexion"]);
        return $rta;
      }
    }
  }

?>
