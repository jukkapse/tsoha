<?php

//require_once './libs/models/kayttaja.php';

session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require_once 'views/yla.php';
    require_once 'views/' . $sivu;
    require_once 'views/ala.php';
    exit();
}
function getTietokantayhteys() {

    static $yhteys = null;

    if ($yhteys == null) {
        $yhteys = new PDO('pgsql:');
        $yhteys->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

     return $yhteys;
}
