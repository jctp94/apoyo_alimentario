<?php
include_once('Conexion.php');
include_once('../logica/Condicion.php');
  class convocatoriaDAO {

    public function __construct() {

    }

    public function obtenerCondicion($condicicion){

      //pruebas
     /*
      $sql="INSERT INTO CONVOCATORIA VALUES (
        (SELECT MAX(K_IDCONV)+1 FROM CONVOCATORIA),
        TO_DATE('".$convocatoria->getF_INICONV()."','YYYY-MM-DD'),
        TO_DATE('".$convocatoria->getF_FINCONV()."','YYYY-MM-DD'),
        TO_DATE(SYSDATE,'YYYY-MM-DD'),
        ".$convocatoria->getV_COSTOALMUERZO().", ".$convocatoria->getQ_CUPOSDISP().", 'A',
        (SELECT USER FROM DUAL), ".$convocatoria->getK_IDPERACAD().", ".$convocatoria->getK_IDANIOCONV().");
        ";*/

      $sql="INSERT INTO CONVOCATORIA VALUES (
        1,
        TO_DATE('".$convocatoria->getF_INICONV()."','YYYY-MM-DD'),
        TO_DATE('".$convocatoria->getF_FINCONV()."','YYYY-MM-DD'),
        TO_DATE(SYSDATE,'YYYY-MM-DD'),
        ".$convocatoria->getV_COSTOALMUERZO().", ".$convocatoria->getQ_CUPOSDISP().", 'A',
        (SELECT LTRIM(USER, 'U') FROM DUAL), ".$convocatoria->getK_IDPERACAD().", ".$convocatoria->getK_IDANIOCONV().");
        ";
      echo $sql;


      // en este momento debo tener id conocatoria recien creada
      $idConvocatoria=1;


      $sql="INSERT INTO CUPOSCONVOCATORIA VALUES ((SELECT MAX(K_IDCUPOSCONV)+1 FROM CUPOSCONVOCATORIA), 'A', ".$cuposA.", ".$idConvocatoria.");";
      echo $sql;
      $sql="INSERT INTO CUPOSCONVOCATORIA VALUES ((SELECT MAX(K_IDCUPOSCONV)+1 FROM CUPOSCONVOCATORIA), 'B', ".$cuposB.", ".$idConvocatoria.");";
      echo $sql;
      $sql="INSERT INTO CUPOSCONVOCATORIA VALUES ((SELECT MAX(K_IDCUPOSCONV)+1 FROM CUPOSCONVOCATORIA), 'T', ".$cuposTotal.", ".$idConvocatoria.");";
      echo $sql;




/*

      session_start();
      $conn = new Conexion($_SESSION['usuario'], $_SESSION['pswd']);
      $array=$conn->conectar();
      if (!$array["estado"]) {
        $error = array(
            "estado" => false,
            "mensaje" => $array['mensaje'],
        );
        return $error;
      }else {//resulto satisfactoria la conexion

          $r = @oci_execute($sql, OCI_NO_AUTO_COMMIT);
          if (!$r) {
              $e = oci_error($stid);
              trigger_error(htmlentities($e['message']), E_USER_ERROR);
          }
          $stid = oci_parse($conn, 'INSERT INTO myschedule (startday) VALUES (12)');
          $r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
          if (!$r) {
              $e = oci_error($stid);
              oci_rollback($conn);  // revertir los cambios en ambas tablas
              trigger_error(htmlentities($e['message']), E_USER_ERROR);
          }

          // Consignar los cambios de ambas tablas
          $r = oci_commit($conn);


        $stid = oci_parse($array["conexion"], 'SELECT GRANTED_ROLE FROM USER_ROLE_PRIVS');
        oci_execute($stid);
        $priv= array();
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            foreach ($row as $key=>$value ) {
                       array_push($priv,$value);
            }
        }

      }
      $rta = array(
          "estado" => true,
          "login" => $login,
      );
      return $rta;*/
    }
 }



?>
