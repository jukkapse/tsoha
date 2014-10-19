<?php

class Valiaika {

  private $valiaikatunnus;
  private $valiaikapistetunnus;
  private $kilpailijatunnus;
  private $valiaika;

  public function getValiaikatunnus(){
	return $this->valiaikatunnus;
  }
  public function getValiakapistetunnus() {
    return $this->valiakapistetunnus;
  }
  public function getKilpailijatunnus(){
	return $this->kilpailijatunnus;
  }
  public function getValiaika(){
	return $this->valiaika;
  }
  public function setValiaikatunnus($valiaikatunnus){
	$this->kilpailutunnus = siistiString($valiaikatunnus);
  }
  public function setValiaikapistetunnus($valiaikapistetunnus){
	$this->valiaikapistetunnus = siistiString($valiaikapistetunnus);
  }
  public function setKilpailijatunnus($kilpailijatunnus){
	$this->kilpailijatunnus = siistiString($kilpailijatunnus);
  }
  public function setValiaika($valiaika){
	$this->valiaika = siistiString($valiaika);
  }
  public function getValiajat($valiaikapistetunnus){
  $sql = 'SELECT valiaika.valiaikapistetunnus, valiaika.kilpailijatunnus, valiaika.valiaika, kilpailija.lahtoaika from valiaika, kilpailija where valiaika.kilpailijatunnus = kilpailija.kilpailijatunnus and valiaikapistetunnus = ? order by kilpailija.lahtoaika-valiaika.valiaika DESC';
		$kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($valiaikapistetunnus));
        
        $tulokset = array();
        foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $valiaika = new Valiaika();
			$valiaika->setValiaikapistetunnus($tulos->valiaikapistetunnus);
			$valiaika->setKilpailijatunnus($tulos->kilpailijatunnus);
			$valiaika->setValiaika($tulos->valiaika);

            $tulokset[] = $valiaika;
        }
        return $tulokset;
  }
  public function etsiValiaika($valiaikapistetunnus, $kilpailijatunnus){
  $sql = 'SELECT valiaikapistetunnus, kilpailijatunnus, valiaika from valiaika WHERE valiaikapistetunnus = ? AND kilpailijatunnus = ?  LIMIT 1';
	$kysely = getTietokantayhteys()->prepare($sql);
	$kysely->execute(array($valiaikapistetunnus,$kilpailijatunnus));
	
	$tulos = $kysely->fetchObject();
	if($tulos == null){
		return null;
	} else {
        $valiaika = new Valiaika();
		$valiaika->setValiaikapistetunnus($tulos->valiaikapistetunnus);
		$valiaika->setKilpailijatunnus($tulos->kilpailijatunnus);
		$valiaika->setValiaika($tulos->valiaika);

		return $valiaika;
	}
  }
	
  public function lisaaValiaika($valiaikapistetunnus, $kilpailijatunnus){
  $sql = "INSERT INTO valiaika (valiaikapistetunnus,kilpailijatunnus,valiaika) values (?,?,CURRENT_TIME) RETURNING valiaikatunnus";
    $kysely = getTietokantayhteys()->prepare($sql);
	$ok = $kysely->execute(array($valiaikapistetunnus, $kilpailijatunnus));
	if($ok){
		$this->valiaikatunnus = $kysely->fetchColumn();
	}
	return $ok;
  }

  public function poistaKannasta(){
    $sql = "DELETE FROM valiaika WHERE valiaikapistetunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getValiaikapistetunnus()));
  } 
}
