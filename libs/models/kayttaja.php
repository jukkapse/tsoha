<?php

class Kayttaja {

  private $id;
  private $tunnus;
  private $salasana;
  private $errors = array();

  public function __construct($id, $tunnus, $salasana) {
    $this->id = $id;
	$this->tunnus = $tunnus;
    $this->salasana = $salasana;
  }
  public function getId(){
	return $this->id;
  }
  public function setId($id){
	$this->id = $id;
  }
  public function getTunnus(){
    return $this->tunnus;
  }
  public function setTunnus($tunnus){
	$this->tunnus = $tunnus;
	
	if (trim($this->tunnus) == '') {
        $this->virheet['tunnus'] = "Sinun täytyy antaa tunnus!";
    } else {
        unset($this->virheet['tunnus']);
    }
  }
  public function getSalasana(){
	return $this->salasana;
  }
  public function setSalasana($salasana){
	$this->salasana =$salasana;
	 if (trim($this->salasana) == '') {
            $this->virheet['salasana'] = "Sinun täytyy antaa salasana!";
        } else {
            unset($this->virheet['salasana']);
        }
  }
  public function lisaaTietokantaan(){
	$sql = "INSERT INTO kayttajat(tunnus,salasana) VALUES(?,?) RETURNING id";
	$kysely = getTietokantayhteys()->prepare($sql);
	
	$onnistui = $kysely->execute(array($this->tunnus, $this->salasana));
	if($onnistui){
		$this->id = $kysely->fetchColumn();
	}
	return $onnistui;
  }
  public function poistaTietokannasta(){
	$sql = "DELETE FROM kayttajat WHERE id=?";
	$kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($this->getId()));
  }
    public static function getKayttajat() {
        $sql = 'SELECT id, tunnus, salasana from kayttajat';
        $kysely = getTietokantayhteys()->prepare($sql); $kysely->execute();
         
        $tulokset = array();
        foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $id = $tulos->id;
            $tunnus = $tulos->tunnus;
            $salasana = $tulos->salasana;
            $kayttaja = new Kayttaja($id, $tunnus, $salasana);
            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }
  public function etsiKayttajaTunnuksilla($kayttaja,$salasana){
        $sql = "SELECT id, tunnus, salasana FROM kayttajat WHERE tunnus = ? AND salasana = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja($tulos->id, $tulos->tunnus, $tulos->salasana);

            return $kayttaja;
        }
  }
   public function getVirheet() {
        return $this->virheet;
    }
}
