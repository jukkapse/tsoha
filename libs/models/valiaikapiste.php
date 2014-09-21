<?php

class Valiakapiste {

  private $valiakapistetunnus;
  private $kilpailijatunnus;
  private $matka;
  private $kilpailijanumero;
  private $valiaika;

  public function __construct($valiaikapistetunnus, $kilpailijatunnus, $matka, $kilpailijanumero, $valiaika) {
    $this->valiaikapistetunnus = $valiaikapistetunnus;
    $this->kilpailijatunnus = $kilpailijatunnus;
	$this->matka = $matka;
	$this->kilpailijanumero = $kilpailijanumero;
	$this->valiaika = $valiaika;
  }
  public function getValiakapistetunnus() {
    return $this->valiakapistetunnus;
  }
  public function getKilpailijatunnus(){
	return $this->kilpailijatunnus;
  }
  public function getMatka(){
	return $this->kilpailijatunnus;
  }
  public function getKilpailijanumero(){
	return $this->kilpailijanumero;
  }
  public function getValiaika(){
	return $this->valiaika;
  }
  public function setMatka($matka){
	$this->matka = $matka;
  }
  public function setKilpailijanumero($kilpailijanumero){
	$this->kilpailijanumero = $kilpailijanumero;
  }
  public function setValitaika($valikaika){
	$this->valiaika = $valiaika;
  }

}
