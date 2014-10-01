<?php

class Kilpailu {
  private $kilpailutunnus;
  private $nimi;
  private $paivamaara;
  private $paikkakunta;
  private $virheet = array();
  
  public function getNimi() {
    return $this->nimi;
  }
  public function getPaikkakunta(){
	return $this->paikkakunta;
  }
  public function getPaivamaara(){
	return $this->paivamaara;
  }
  public function getKilpailutunnus(){
	return $this->kilpailutunnus;
  }
  public function getVirheet(){
	return $this->virheet;
  }
  
  public function setKilpailutunnus($kilpailutunnus){
	$this->kilpailutunnus = $kilpailutunnus;
  }
  
  public function setNimi($nimi){
	$this->nimi = siistiString($nimi);
	
	if (trim($this->nimi) == '') {
            $this->virheet['nimi'] = "Sinun täytyy antaa kilpailulle nimi!";
        } else {
            unset($this->virheet['nimi']);
        }
  }
  
  public function setPaikkakunta($paikkakunta){
	$this->paikkakunta = siistiString($paikkakunta);
	if (trim($this->paikkakunta) == '') {
            $this->virheet['paikkakunta'] = "Sinun täytyy antaa paikkakunta!";
        } else {
            unset($this->virheet['paikkakunta']);
        }
  }
  
  public function setPaivamaara($paivamaara){
	$this->paivamaara =  siistiString($paivamaara);
	
	if (trim($this->paivamaara) == '') {
            $this->virheet['paivamaara'] = "Sinun täytyy antaa kilpailun päivämäärä!";
        } else {
            unset($this->virheet['paivamaara']);
        }
  }
  
 public function etsiKilpailu($kilpailutunnus){
	$sql = 'SELECT kilpailutunnus, nimi, paikkakunta, paivamaara from kilpailu WHERE kilpailutunnus = ? LIMIT 1';
	$kysely = getTietokantayhteys()->prepare($sql);
	$kysely->execute(array($kilpailutunnus));
	
	$tulos = $kysely->fetchObject();
	if($tulos == null){
		return null;
	} else {
        $kilpailu = new Kilpailu();
		$kilpailu->setKilpailutunnus($tulos->kilpailutunnus);
		$kilpailu->setNimi($tulos->nimi);
		$kilpailu->setPaikkakunta($tulos->paikkakunta);
		$kilpailu->setPaivamaara($tulos->paivamaara);
		
		return $kilpailu;
	}
 }
  
 public static function getKilpailut() {
        $sql = 'SELECT kilpailutunnus, nimi, paikkakunta, paivamaara from kilpailu order by paivamaara';
        $kysely = getTietokantayhteys()->prepare($sql); $kysely->execute();
         
        $tulokset = array();
        foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kilpailu = new Kilpailu();
			$kilpailu->setKilpailutunnus($tulos->kilpailutunnus);
			$kilpailu->setNimi($tulos->nimi);
			$kilpailu->setPaikkakunta($tulos->paikkakunta);
			$kilpailu->setPaivamaara($tulos->paivamaara);
            $tulokset[] = $kilpailu;
        }
        return $tulokset;
    }
  public function lisaaKantaan(){
	$sql = "INSERT INTO kilpailu (nimi,paikkakunta,paivamaara) values (?,?,?) RETURNING kilpailutunnus";
    $kysely = getTietokantayhteys()->prepare($sql);
	$ok = $kysely->execute(array($this->getNimi(), $this->getPaikkakunta(), $this->getPaivamaara()));
	if($ok){
		$this->kilpailutunnus = $kysely->fetchColumn();
	}
	return $ok;
  }
      public function poistaKannasta() {
        $sql = "DELETE FROM kilpailu WHERE kilpailutunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getKilpailutunnus()));
    }
	 public function paivitaKantaan() {
        $sql = "UPDATE kilpailu SET nimi = ?, paikkakunta = ?, paivamaara = ? WHERE kilpailutunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getNimi(),
            $this->getPaikkakunta(),
            $this->getPaivamaara(),
            $this->getKilpailutunnus()));
    }
	
	   public function onkoKelvollinen() {
        return empty($this->virheet);
    }
}
