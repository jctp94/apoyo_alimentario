<?php
include_once('Conexion.php');
include_once('../logica/Estudiante.php');

  class EstudianteDAO {

    public function __construct() {

    }
    public function consultarEstudiante(){
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
        $consulta = "SELECT * FROM ESTUDIANTE WHERE K_CODEST=LTRIM('".$_SESSION['usuario']."', 'U')";
        $stid = oci_parse($array["conexion"], $consulta);
        oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
        $est = new Estudiante($row["K_CODEST"],
        $row["N_NOMEST"],
        $row["N_PROYECTOEST"],
        $row["N_DIREST"],
        $row["N_CORREOEST"],
        $row["N_FACEST"],
        $row["I_ESTADOEST"],
        $row["V_PROMEST"],
        $row["Q_ASIGPERDEST"]);
        $rta = array(
            "estado" => true,
            "estudiante" => $est,
        );
        $conn->desconectar($array["conexion"]);
        return $rta;
      }

    }

    public function listarEstudiantesPendientes(){
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
        $estudiantes=array();
        $consulta = "select e.N_NOMEST, e.K_CODEST,$N_FACEST, e.N_PROYECTOEST from ESTUDIANTE e, SOLICITUD s where e.K_CODEST=s.K_CODEST and s.I_ESTADOSOL='P'";              
        $stid = oci_parse($array["conexion"], $consulta);
        oci_execute($stid);        
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {        
          $estudiante = new Estudiante($row["N_NOMEST"],
          $row["K_CODEST"],
          $row["N_PROYECTOEST"]);
          array_push($estudiantes, $estudiante);
        }       
        $rta = array(
            "estado" => true,
            "estudiantes" => $estudiantes,            
        );
        $conn->desconectar($array["conexion"]);
        return $rta;
      }
    }
  }

?>
