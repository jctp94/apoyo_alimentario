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
        $consulta = "select e.K_CODEST, e.N_NOMEST, e.N_PROYECTOEST, e.N_FACEST from ESTUDIANTE e, SOLICITUD s where e.K_CODEST=s.K_CODEST and s.I_ESTADOSOL='P'";              
        $stid = oci_parse($array["conexion"], $consulta);
        oci_execute($stid);        
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {        
          $estudiante = new Estudiante($row["K_CODEST"],
            $row["N_NOMEST"],$row["N_PROYECTOEST"],NULL,NULL, $row["N_FACEST"], NULL, NULL, NULL );  
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

    public function listarCodigos(){
      session_start();
      $conn = new Conexion($_SESSION['usuario'], $_SESSION['pswd']);
      $array=$conn->conectar();
      if (!$array["estado"]) {
        $error = array(
            "estado" => "noConexion",
            "mensaje" => $array['mensaje'],
        );
        return $error;
      }else {
        $sql="SELECT s.K_CODEST FROM SOLICITUD s, BENEFICIARIO b WHERE b.K_IDSOL=s.K_IDSOL AND  b.I_ESTADOBENEF='A' AND s.K_IDSOL=(select s.K_IDSOL from solicitud s, estudiante e where s.K_CODEST=e.K_CODEST)";
        $stid = oci_parse($array["conexion"], $sql);
        oci_execute($stid);
        $codigos= array();
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            foreach ($row as $key=>$value ) {
                 array_push($codigos,$value);
            }
        }
        $rta = array(
          "estado" => true,
          "codigos" => $codigos,            
        );
        $conn->desconectar($array["conexion"]);
        return $rta;
      }
    }

    public function listarFacultades(){
      session_start();
      $conn = new Conexion($_SESSION['usuario'], $_SESSION['pswd']  );
      $array=$conn->conectar();
      if (!$array["estado"]) {
        $error = array(
            "estado" => "noConexion",
            "mensaje" => $array['mensaje'],
        );
        return $error;
      }else {
        $sql="SELECT DISTINCT(N_FACEST) FROM ESTUDIANTE";
        $stid = oci_parse($array["conexion"], $sql);
        oci_execute($stid);
        $lista= array();
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            foreach ($row as $key=>$value ) {
                 array_push($lista,$value);
            }
        }
        $rta = array(
          "estado" => true,
          "lista" => $lista,            
        );
        $conn->desconectar($array["conexion"]);
        return $rta;
      }
    }

    public function listarProyectosCurriculares(){
      session_start();
      $conn = new Conexion($_SESSION['usuario'], $_SESSION['pswd']  );
      $array=$conn->conectar();
      if (!$array["estado"]) {
        $error = array(
            "estado" => "noConexion",
            "mensaje" => $array['mensaje'],
        );
        return $error;
      }else {
        $sql="SELECT DISTINCT(N_PROYECTOEST) FROM ESTUDIANTE";        
        $stid = oci_parse($array["conexion"], $sql);
        oci_execute($stid);
        $lista= array();
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            foreach ($row as $key=>$value ) {
                 array_push($lista,$value);
            }
        }
        $rta = array(
          "estado" => true,
          "lista" => $lista,            
        );
        $conn->desconectar($array["conexion"]);
        return $rta;
      }
    }

    public function filtrarPorFacultad($facultad){
      session_start();
      $conn = new Conexion($_SESSION['usuario'], $_SESSION['pswd']  );
      $array=$conn->conectar();
      if (!$array["estado"]) {
        $error = array(
            "estado" => "noConexion",
            "mensaje" => $array['mensaje'],
        );
        return $error;
      }else {
        $estudiantes= array();
        $sql="SELECT e.K_CODEST, e.N_NOMEST, e.N_PROYECTOEST,e.N_FACEST, s.I_ESTADOSOL FROM ESTUDIANTE e, SOLICITUD s 
        WHERE s.K_CODEST=e.K_CODEST and e.N_FACEST='".$facultad."'";        
        $stid = oci_parse($array["conexion"], $sql);
        oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {        
          $estudiante = new Estudiante($row["K_CODEST"],
            $row["N_NOMEST"],$row["N_PROYECTOEST"],$row["I_ESTADOSOL"],NULL, $row["N_FACEST"], NULL, NULL, NULL );  
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

    public function filtrarPorProyectoCurricular($proyectoCurricular){
      session_start();
      $conn = new Conexion($_SESSION['usuario'], $_SESSION['pswd']  );
      $array=$conn->conectar();
      if (!$array["estado"]) {
        $error = array(
            "estado" => "noConexion",
            "mensaje" => $array['mensaje'],
        );
        return $error;
      }else {
        $estudiantes= array();
        $sql="SELECT e.K_CODEST, e.N_NOMEST, e.N_PROYECTOEST,e.N_FACEST, s.I_ESTADOSOL FROM ESTUDIANTE e, SOLICITUD s 
        WHERE s.K_CODEST=e.K_CODEST and e.N_PROYECTOEST='".$proyectoCurricular."'";
        $stid = oci_parse($array["conexion"], $sql);
        oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {        
          $estudiante = new Estudiante($row["K_CODEST"],
            $row["N_NOMEST"],$row["N_PROYECTOEST"],$row["I_ESTADOSOL"],NULL, $row["N_FACEST"], NULL, NULL, NULL );  
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
