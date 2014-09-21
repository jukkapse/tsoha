<?php

class Kilpailu {

  private $kilpailutunnus;
  private $nimi;
  private $paikkakunta;
  private $paivamaara;

  public function __construct($kilpailutunnus, $nimi, $paikkakunta, $paivamaara) {
    $this->kilpailutunnus = $kilpailutunnus;
	$this->nimi = $nimi;
    $this->paikkakunta = $paikkakunta;
	$this->paivamaara = $paivamaara;
  }

  public function getNimi() {
    return $this->nimi;
  }
  public function getPaikkakunta(){
	return this->paikkakunta;
  }
  public function getPaivamaara(){
	return this->paivamaara;
  }
  public function getKilpailutunnus(){
	return this->kipailutunnus;
  }

  public function setNimi($nimi){
	$this->nimi = $nimi;
  }
  
  public function setPaikkakunta($paikkakunta){
	$this->paikkakunta = $paikkakunta;
  }
  
  public function setPaivamaara($paivamaara){
	$this->paivamaara = $paivamaara;
  }
}
