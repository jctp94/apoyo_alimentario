<?php
class Solicitud {

  public $k_idsol;
  public $i_estadosol;
  public $q_tpuntajesol;
  public $n_descsol;
  public $l_codest;
  public $k_idconv;

  public function __construct($k_idsol, $i_estadosol, $q_tpuntajesol, $n_descsol, $l_codest, $k_idconv) {
    $this->k_idsol = $k_idsol;
    $this->i_estadosol = $i_estadosol;
    $this->q_tpuntajesol = $q_tpuntajesol;
    $this->n_descsol = $n_descsol;
    $this->l_codest = $l_codest;
    $this->k_idconv = $k_idconv;
  }

  public function getK_idsol(){
		return $this->k_idsol;
	}

	public function setK_idsol($k_idsol){
		$this->k_idsol = $k_idsol;
	}

	public function getI_estadosol(){
		return $this->i_estadosol;
	}

	public function setI_estadosol($i_estadosol){
		$this->i_estadosol = $i_estadosol;
	}

	public function getQ_tpuntajesol(){
		return $this->q_tpuntajesol;
	}

	public function setQ_tpuntajesol($q_tpuntajesol){
		$this->q_tpuntajesol = $q_tpuntajesol;
	}

	public function getN_descsol(){
		return $this->n_descsol;
	}

	public function setN_descsol($n_descsol){
		$this->n_descsol = $n_descsol;
	}

	public function getL_codest(){
		return $this->l_codest;
	}

	public function setL_codest($l_codest){
		$this->l_codest = $l_codest;
	}

	public function getK_idconv(){
		return $this->k_idconv;
	}

	public function setK_idconv($k_idconv){
		$this->k_idconv = $k_idconv;
	}
}
?>
