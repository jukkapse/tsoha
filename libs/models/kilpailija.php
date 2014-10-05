<?php

class Kilpailija {

  private $kilpailutunnus;
  private $kilpailijatunnus;
  private $kilpailijanumero;
  private $nimi;
  private $seura;
  private $lahtoaika;
  private $loppuaika;
  private $virheet = array();

  public function getKilpailutunnus() {
    return $this->kilpailutunnus;
  }
  public function getKilpailijatunnus(){
	return $this->kilpailijatunnus;
  }
  public function getKilpailijanumero(){
	return $this->kilpailijanumero;
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
    public function getVirheet(){
	return $this->virheet;
  }
  public function setKilpailutunnus($kilpailutunnus){
	$this->kilpailutunnus = $kilpailutunnus;
  }
  public function setKilpailijatunnus($kilpailijatunnus){
	$this->kilpailijatunnus = $kilpailijatunnus;
  }
  public function setKilpailijanumero($kilpailijanumero){
	$this->kilpailijanumero = $kilpailijanumero;
  }
  public function setNimi($nimi){
	$this->nimi = $nimi;
	
	if (trim($this->nimi) == '') {
            $this->virheet['nimi'] = "Sinun täytyy antaa kilpailijan nimi!";
        } else {
            unset($this->virheet['nimi']);
        }
  }
  public function setSeura($seura){
	$this->seura = $seura;
	
	if (trim($this->seura) == '') {
            $this->virheet['seura'] = "Sinun täytyy antaa kilpailijan seura!";
        } else {
            unset($this->virheet['seura']);
        }
  }
  public function setLahtoaika($lahtoaika){
	$this->lahtoaika = $lahtoaika;
	
	if (trim($this->lahtoaika) == '') {
            $this->virheet['lahtoaika'] = "Sinun täytyy antaa kilpailijan lähtöaika!";
        } else {
            unset($this->virheet['lahtoaika']);
        }
  }
  public function setLoppuaika($loppuaika){
	$this->loppuaika = $loppuaika;
  }

	public static function getKilpailijat() {
        $sql = 'SELECT kilpailutunnus, kilpailijatunnus, kilpailijanumero, nimi, seura, lahtoaika, loppuaika from kilpailija order by lahtoaika';
        $kysely = getTietokantayhteys()->prepare($sql); $kysely->execute();
         
        $tulokset = array();
        foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kilpailija = new Kilpailija();
			$kilpailija->setKilpailutunnus($tulos->kilpailutunnus);
			$kilpailija->setKilpailijatunnus($tulos->kilpailijatunnus);
			$kilpailija->setKilpailijanumero($tulos->kilpailijanumero);
			$kilpailija->setNimi($tulos->nimi);
			$kilpailija->setSeura($tulos->seura);
			$kilpailija->setLahtoaika($tulos->lahtoaika);
			$kilpailija->setLoppuaika($tulos->getLoppuaika);
            $tulokset[] = $kilpailija;
        }
        return $tulokset;
    }

    
    public function lisaaKantaan(){
	$sql = "INSERT INTO kilpailija (kilpailutunnus,kilpailijanumero,nimi,seura,lahtoaika) values (?,?,?,?,?) RETURNING kilpailijatunnus";
    $kysely = getTietokantayhteys()->prepare($sql);
	$ok = $kysely->execute(array($this->getKilpailutunnus(), $this->getKilpailijanumero(), $this->getNimi(), $this->getSeura(), $this->getLahtoaika()));
	if($ok){
		$this->kilpailijatunnus = $kysely->fetchColumn();
	}
	return $ok;
  }
        public function poistaKannasta() {
        $sql = "DELETE FROM kilpailija WHERE kilpailijatunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getKilpailijatunnus()));
    }
	 public function paivitaKantaan() {
        $sql = "UPDATE kilpailija SET kilpailijanumero = ?, nimi = ?, seura = ?, lahtoaika = ? WHERE kilpailijatunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getKilpailutunnus(),
			$this->getKilpailijanumero(),
            $this->getNimi(),
            $this->getSeura(),
            $this->getLahtoaika()));
    }
	
	   public function onkoKelvollinen() {
        return empty($this->virheet);
    }
	
	public function lahtolista($id){
		$sql = 'SELECT kilpailutunnus, kilpailijatunnus, kilpailijanumero, nimi, seura, lahtoaika, loppuaika from kilpailija where kilpailutunnus = ? order by lahtoaika';
		$kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
        
        $tulokset = array();
        foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kilpailija = new Kilpailija();
			$kilpailija->setKilpailutunnus($tulos->kilpailutunnus);
			$kilpailija->setKilpailijatunnus($tulos->kilpailijatunnus);
			$kilpailija->setKilpailijanumero($tulos->kilpailijanumero);
			$kilpailija->setNimi($tulos->nimi);
			$kilpailija->setSeura($tulos->seura);
			$kilpailija->setLahtoaika($tulos->lahtoaika);
			$kilpailija->setLoppuaika($tulos->loppuaika);
            $tulokset[] = $kilpailija;
        }
        return $tulokset;
	}
	
	public function tuloslista($id){
		$sql = 'SELECT kilpailutunnus, kilpailijatunnus, kilpailijanumero, nimi, seura, lahtoaika, loppuaika from kilpailija where kilpailutunnus = ? order by loppuaika';
		$kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
        
        $tulokset = array();
        foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kilpailija = new Kilpailija();
			$kilpailija->setKilpailutunnus($tulos->kilpailutunnus);
			$kilpailija->setKilpailijatunnus($tulos->kilpailijatunnus);
			$kilpailija->setKilpailijanumero($tulos->kilpailijanumero);
			$kilpailija->setNimi($tulos->nimi);
			$kilpailija->setSeura($tulos->seura);
			$kilpailija->setLahtoaika($tulos->lahtoaika);
			$kilpailija->setLoppuaika($tulos->loppuaika);
			if($tulos->loppuaika != ""){
            $tulokset[] = $kilpailija;
			}
        }
        return $tulokset;
	}
	
	 public function etsiKilpailija($kilpailijatunnus){
	$sql = 'SELECT kilpailutunnus, kilpailijatunnus, kilpailijanumero, nimi, seura, lahtoaika, loppuaika from kilpailija WHERE kilpailijatunnus = ? LIMIT 1';
	$kysely = getTietokantayhteys()->prepare($sql);
	$kysely->execute(array($kilpailijatunnus));
	
	$tulos = $kysely->fetchObject();
	if($tulos == null){
		return null;
	} else {
        $kilpailija = new Kilpailija();
		$kilpailija->setKilpailutunnus($tulos->kilpailutunnus);
		$kilpailija->setKilpailijatunnus($tulos->kilpailijatunnus);
		$kilpailija->setKilpailijanumero($tulos->kilpailijanumero);
		$kilpailija->setNimi($tulos->nimi);
		$kilpailija->setSeura($tulos->seura);
		$kilpailija->setLahtoaika($tulos->lahtoaika);
		$kilpailija->setLoppuaika($tulos->loppuaika);
		
		return $kilpailija;
	}
 }
	public function maaliaika($kilpailijatunnus){
	 $sql = "UPDATE kilpailija SET loppuaika = ? WHERE kilpailijatunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getLoppuaika()));
    }
	
}
