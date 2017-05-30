<?php
include_once('Conexion.php');
include_once('../logica/Registro.php');
  class RegistroDAO {

    public function __construct() {

    }

    public function registrarse($registro){
      if ($registro->getRol()=="estudiante") {
        $conn = new Conexion('CREADOR_ESTUDIANTE','CREADOR_ESTUDIANTE');
        $array=$conn->conectar();
        if (!$array["estado"]) {
          $error = array(
              "estado" => "noConexion",
              "mensaje" => $array['mensaje'],
          );
          return $error;
        }else {
          $stid = oci_parse($array["conexion"], 'SELECT K_CODEST FROM estudiante');
          oci_execute($stid);
          $codigos= array();
          while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
              foreach ($row as $key=>$value ) {
      			       array_push($codigos,$value);
              }
          }
          if(in_array($registro->getUsuario(),$codigos)){
            $stid = oci_parse($array["conexion"], "SELECT USERNAME FROM DBA_USERS WHERE USERNAME='U".$registro->getUsuario()."'");
            oci_execute($stid);
            $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
            if($row["USERNAME"]==""){
              $stid = oci_parse($array["conexion"], "CREATE USER U".$registro->getUsuario()." IDENTIFIED BY ".$registro->getPswd());
              oci_execute($stid);
              $stid = oci_parse($array["conexion"], "GRANT CONNECT,ROLE_ESTUDIANTE TO U".$registro->getUsuario());
              oci_execute($stid);
              $registro->setUsuario("U".$registro->getUsuario());
              $rta = array(
                  "estado" => "creado",
                  "registro" => $registro,
              );
              $conn->desconectar($array["conexion"]);
              return $rta;
          	}else {
              $rta = array(
                  "estado" => "existe",
                  "mensaje" => "El usuario ya existe",
              );
              $conn->desconectar($array["conexion"]);
              return $rta;
          	}
          }else {
            $rta = array(
                "estado" => "inactivo",
                "mensaje" => "El codigo ingresado no corresponde a un estudiante activo",
            );
            $conn->desconectar($array["conexion"]);
            return $rta;
          }
        }

      }

    }
  }

?>
