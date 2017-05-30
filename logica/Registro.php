<?php

class Registro {

    public $usuario;
    public $pswd;
    public $rol;

	   public function __construct($usuario,$pswd,$rol) {
      $this->usuario=$usuario;
      $this->rol=$rol;
      $this->pswd = $pswd;
   	}
    public function getRol(){
        return $this->rol;
    }
    public function setRol($rol){
        $this->rol = $rol;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function getPswd(){
        return $this->pswd;
    }
    public function setPswd($pswd){
        $this->pswd = $pswd;
    }


}

?>
