<?php

class Kilpailu {

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
	return $this->kipailutunnus;
  }
  public function setKilpailutunnus($kilpailutunnus){
	$this->kilpailutunnus = $kilpailutunnus;
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
  
 public static function getKilpailut() {
        $sql = 'SELECT kilpailutunnus, nimi, paikkakunta, paivamaara from kilpailu';
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
}
