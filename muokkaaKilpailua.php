<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';

	if (isset($_SESSION['kirjautunut'])) {
	
	if (isset($_POST["paluu"])) {
    header("Location: hallinta.php");
	}
	
	if (isset($_GET["muokattava"])) {
    $muokattava = Kilpailu::etsiKilpailu($_GET["muokattava"]);

    if ($muokattava == null) {
        naytaNakyma("hallinta.php", array('virheet' => "Kilpailua ei ole olemassa"));
    } else {
        naytaNakyma("kilpailunMuokkaus.php", array(
            'kilpailutunnus' => $muokattava->getKilpailutunnus(),
            'nimi' => $muokattava->getNimi(),
            'paikkakunta' => $muokattava->getPaikkakunta(),
            'paivamaara' => $muokattava->getPaivamaara(),
        ));
    }
}

if (isset($_POST["tallennaNappi"])) {
    $muokattavalomakkeelta = Kilpailu::etsiKilpailu($_POST["kilpailutunnus"]);
    $muokattavalomakkeelta->setNimi($_POST["nimi"]);
    $muokattavalomakkeelta->setPaivamaara($_POST["paivamaara"]);
    $muokattavalomakkeelta->setPaikkakunta($_POST["paikkakunta"]);
	if ($muokattavalomakkeelta->onkoKelvollinen()) {
        $muokattavalomakkeelta->paivitaKantaan();
        $_SESSION["ilmoitus"] = "Kilpailun muokkaus onnistui!";
        header("Location: hallinta.php");
		}
     else {
        naytaNakyma("kilpailunMuokkaus.php", array(
            'virheet' => $muokattavalomakkeelta->getVirheet(),
            'kilpailutunnus' => $muokattavalomakkeelta->getKilpailutunnus(),
            'nimi' => $muokattavalomakkeelta->getNimi(),
            'paivamaara' => $muokattavalomakkeelta->getPaivamaara(),
            'paikkakunta' => $muokattavalomakkeelta->getPaikkakunta(),

        ));
    }
	}
}
	
?>
