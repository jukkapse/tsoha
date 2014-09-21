<?php

//require_once './libs/models/kayttaja.php';

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require_once 'views/yla.php';
    require_once 'views/' . $sivu;
    require_once 'views/ala.php';
    exit();
}
function getTietokantayhteys() {

    static $yhteys = null; //Muuttuja, jonka sisältö säilyy getTietokantayhteys-kutsujen välillä.

    if ($yhteys === null) {
        //Tämä koodi suoritetaan vain kerran, sillä seuraavilla 
        //funktion suorituskerroilla $yhteys-muuttujassa on sisältöä.
        $yhteys = new PDO('pgsql:');
        $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $yhteys;
}