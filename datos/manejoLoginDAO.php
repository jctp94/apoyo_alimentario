<?php
require('Conexion.php');
include_once('../logica/Login.php');
  class manejoLoginDAO {

    public function __construct() {

    }

    public function mostrarInterfaz($login){
      $conn = new Conexion($login->getUsuario(),$login->getPswd());
      $array=$conn->conectar();
      if (!$array["estado"]) {
        $error = array(
            "estado" => false,
            "mensaje" => $array['mensaje'],
        );
        return $error;
      }else {
        $stid = oci_parse($array["conexion"], 'SELECT GRANTED_ROLE FROM USER_ROLE_PRIVS');
        oci_execute($stid);
        $priv= array();
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            foreach ($row as $key=>$value ) {
    			       array_push($priv,$value);
            }
        }
        if(in_array("ROLE_ESTUDIANTE",$priv)){
            $login->setRol("estudiante");
        }elseif (in_array("ADMIN_APOYO",$priv)) {
            $login->setRol("adminapoyo");
        }else{
          $login->setRol("otro");
        }
      }
      $rta = array(
          "estado" => true,
          "login" => $login,
      );
      $conn->desconectar($array["conexion"]);
      return $rta;
    }
  }

?>
