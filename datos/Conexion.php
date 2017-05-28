<?php
  class Conexion {
    private $usuario;
    private $paswd;
    private $conn;
    public function __construct($usuario,$paswd) {
      $this->usuario=$usuario;
      $this->paswd=$paswd;
    }
    public function conectar(){
        $conn = @oci_connect($this->usuario, $this->paswd, 'localhost/XE');
        if (!$conn) {
          $e = oci_error();   // Para errores de oci_connect errors, no pase un gestor
          $error = array(
              "estado" => false,
              "mensaje" => $e['message'],
          );
          return $error;
        }else {
          $conexion = array(
              "estado" => true,
              "conexion" => $conn,
          );
          return $conexion;
        }
    }

    public function desconectar($conn){
      oci_close($conn);
    }
  }
// Conectar al servicio Oracle Database
// syntaxis: oci_connect(usuario oracle, clave, servidor/nombre servicio)
?>
