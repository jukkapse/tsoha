<?php

class Valiaikapiste {

  private $valiakapistetunnus;
  private $kilpailutunnus;
  private $matka;
  private $virheet = array();

  public function getValiaikapistetunnus() {
    return $this->valiaikapistetunnus;
  }
  public function getKilpailutunnus(){
	return $this->kilpailutunnus;
  }
  public function getMatka(){
	return $this->matka;
  }
  public function getVirheet(){
	return $this->virheet;
  }
  public function setValiaikapistetunnus($valiaikapistetunnus){
	$this->valiaikapistetunnus = siistiString($valiaikapistetunnus);
  }
  public function setKilpailutunnus($kilpailutunnus){
	$this->kilpailutunnus = siistiString($kilpailutunnus);
  }
  public function setMatka($matka){
	$this->matka = siistiString($matka);
	if (trim($this->matka) == null) {
            $this->virheet['matka'] = "Sinun täytyy antaa väliaikapisteen matka!";
        } else {
            unset($this->virheet['matka']);
        }
  }
  public function getValiaikapisteet($kilpailutunnus){
  $sql = 'SELECT valiaikapistetunnus, kilpailutunnus, matka from valiaikapiste where kilpailutunnus = ? order by matka';
		$kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kilpailutunnus));
        
        $tulokset = array();
        foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $valiaikapiste = new Valiaikapiste();
			$valiaikapiste->setValiaikapistetunnus($tulos->valiaikapistetunnus);
			$valiaikapiste->setKilpailutunnus($tulos->kilpailutunnus);
			$valiaikapiste->setMatka($tulos->matka);

            $tulokset[] = $valiaikapiste;
        }
        return $tulokset;
  } 
   public function etsiValiaikapiste($valiaikapistetunnus){
	$sql = 'SELECT valiaikapistetunnus, kilpailutunnus, matka from valiaikapiste WHERE valiaikapistetunnus = ? LIMIT 1';
	$kysely = getTietokantayhteys()->prepare($sql);
	$kysely->execute(array($valiaikapistetunnus));
	
	$tulos = $kysely->fetchObject();
	if($tulos == null){
		return null;
	} else {
        $valiaikapiste = new Valiaikapiste();
		$valiaikapiste->setValiaikapistetunnus($tulos->valiaikapistetunnus);
		$valiaikapiste->setKilpailutunnus($tulos->kilpailutunnus);
		$valiaikapiste->setMatka($tulos->matka);
		
		return $valiaikapiste;
	}
 }
  public function lisaaKantaan(){
  $sql = "INSERT INTO valiaikapiste (kilpailutunnus,matka) values (?,?) RETURNING valiaikapistetunnus";
    $kysely = getTietokantayhteys()->prepare($sql);
	$ok = $kysely->execute(array($this->getKilpailutunnus(), $this->getMatka()));
	if($ok){
		$this->valiaikapistetunnus = $kysely->fetchColumn();
	}
	return $ok;
  }
  public function paivitaKantaan(){
   $sql = "UPDATE valiaikapiste SET kilpailutunnus = ?, matka = ? WHERE valiaikapistetunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array(
			$this->getKilpailutunnus(),
            $this->getMatka(),
			$this->getValiaikapistetunnus()));
  }
  public function poistaKannasta(){
	     $sql = "DELETE FROM valiaika WHERE valiaikapistetunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getValiaikapistetunnus()));
        
    $sql = "DELETE FROM valiaikapiste WHERE valiaikapistetunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getValiaikapistetunnus()));
  } 
  public function onkoKelvollinen() {
        return empty($this->virheet);
  }
}
