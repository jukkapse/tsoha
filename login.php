<?php
	require_once './libs/common.php';
	require_once "./libs/models/kayttaja.php";

if (!isset($_POST["submit"])) {
    naytaNakyma('loginform.php');
}
if (empty($_POST["tunnus"])) {
    naytaNakyma("loginform.php", array(
        'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
}
$tunnus = $_POST["tunnus"];

if (empty($_POST["salasana"])) {
    naytaNakyma("loginform.php", array(
        'tunnus' => $tunnus,
        'virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa.",
    ));
}
$salasana = $_POST["salasana"];

/* Tarkistetaan onko parametrina saatu oikeat tunnukset */
$kayttaja = Kayttaja::etsiKayttajaTunnuksilla($tunnus, $salasana);

if (isset($kayttaja)) {
      $_SESSION['kirjautunut'] = $kayttaja->getId();
		header('Location: ./hallinta.php');
} else {
    /* Väärän tunnuksen syöttänyt saa eteensä lomakkeen ja virheen.
     * Tässä käytetään omassa kirjastotiedostossa määriteltyjä yleiskäyttöisiä funktioita.
     */
    naytaNakyma("loginform.php", array(
        /* Välitetään näkymälle tieto siitä, kuka yritti kirjautumista */
        'tunnus' => $tunnus,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.",
    ));
}
