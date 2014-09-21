<?php

class Kilpailija {

  private $kilpailutunnus;
  private $kilpailijatunnus;
  private $nimi;
  private $seura;
  private $lahtoaika;
  private $loppuaika;

  public function __construct($kilpailutunnus, $kilpailijatunnus, $nimi, $seura, $lahtöaika, $loppuaika) {
    $this->kilpailutunnus = $kilpailutunnus;
	$this->kilpailijatunnus = $kilpailijatunnus;
	$this->nimi = $nimi;
	$this->seura = $seura;
	$this->lahtoaika = $lahtoaika;
    $this->loppuaika = $loppuaika;
  }

  public function getKilpailutunnus() {
    return $this->kilpailutunnus;
  }
  public function getKilpailijatunnus(){
	return $this->kilpailijatunnus;
  }
  public function getNimi(){
	return $this->nimi;
  }
  public function getSeura(){
	return $this->seura;
  }
  public function getLahtoaika(){
	return $this->lahtoaika;
  }
  public function getLoppuaika(){
	return $this->loppuaika;
  }
  public function setNimi($nimi){
	$this->nimi = $nimi;
  }
  public function setSeura($seura){
	$this->seura = $seura;
  }
  public function setLahtoaika($lahtoaika){
	$this->lahtoaika = $lahtoaika;
  }
  public function setLoppuaika($loppuaika){
	$this->loppuaika = $loppuaika;
  }
}
