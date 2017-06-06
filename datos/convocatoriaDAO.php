<?php
include_once('Conexion.php');
include_once('../logica/Convocatoria.php');
  class convocatoriaDAO {

    public function __construct() {

    }

    public function insertarConvocatoria($convocatoria, $cuposA, $cuposB, $cuposTotal){
      session_start();
      $conn = new Conexion($_SESSION['usuario'], $_SESSION['pswd']);
      $array=$conn->conectar();
      if (!$array["estado"]) {
        $error = array(
            "estado" => false,
            "mensaje" => $array['mensaje'],
        );
        return $error;
      }else {
        $convocatoria="INSERT INTO CONVOCATORIA VALUES (
          incremento_id_convocatoria.nextval,
          TO_DATE('".$convocatoria->getF_INICONV()."','YYYY-MM-DD'),
          TO_DATE('".$convocatoria->getF_FINCONV()."','YYYY-MM-DD'),
          TO_DATE(SYSDATE,'YYYY-MM-DD'),
          ".$convocatoria->getV_COSTOALMUERZO().", ".$convocatoria->getQ_CUPOSDISP().", 'A',
          (SELECT LTRIM(USER, 'U') FROM DUAL), "."(SELECT K_IDPERACAD FROM PERIODOACADEMICO WHERE F_INIPERACAD>SYSDATE AND ROWNUM=1)".", ".$convocatoria->getK_IDANIOCONV().")";


        // en este momento debo tener id conocatoria recien creada


        $tipoa="INSERT INTO CUPOSCONVOCATORIA VALUES (incremento_id_cuposconv.nextval, 'A', ".$cuposA.", (SELECT MAX(K_IDCONV) FROM CONVOCATORIA))";

        $tipob="INSERT INTO CUPOSCONVOCATORIA VALUES (incremento_id_cuposconv.nextval, 'B', ".$cuposB.", (SELECT MAX(K_IDCONV) FROM CONVOCATORIA))";

        $tipot="INSERT INTO CUPOSCONVOCATORIA VALUES (incremento_id_cuposconv.nextval, 'T', ".$cuposTotal.",(SELECT MAX(K_IDCONV) FROM CONVOCATORIA))";

        $stid = oci_parse($array["conexion"], $convocatoria);
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
        $stid = oci_parse($array["conexion"], $tipoa);
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
        $stid = oci_parse($array["conexion"], $tipob);
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
        $stid = oci_parse($array["conexion"], $tipot);
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
        $rta = array(
            "estado" => true,
            "mensaje" => "bien",
        );
        $conn->desconectar($array["conexion"]);
        return $rta;
      }

    }


    public function consultarConvocatoriaActiva(){
      session_start();
      $conn = new Conexion("CREADOR_ESTUDIANTE","CREADOR_ESTUDIANTE"  );
      $array=$conn->conectar();
      if (!$array["estado"]) {
        $error = array(
            "estado" => false,
            "mensaje" => $array['mensaje'],
        );
        return $error;
      }else {
        $consulta = "SELECT F_INICONV, F_FINCONV, V_COSTOALMUERZO FROM CONVOCATORIA WHERE I_ESTADOCONV='A'"; 
        //echo "sql: ". $sql;        
        $stid = oci_parse($array["conexion"], $consulta);
        oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
        $sop = new Convocatoria($row["F_INICONV"], $row["F_FINCONV"],$row["V_COSTOALMUERZO"],NULL, NULL, NULL);          

        $rta = array(
            "estado" => true,
            "convocatoria" => $sop,            
        );
        $conn->desconectar($array["conexion"]);
        return $rta;
      }
    }


 }



?>
