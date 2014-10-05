<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailija.php';

	if (isset($_SESSION['kirjautunut'])) {
	
	if (isset($_GET["muokattava"])) {
    $muokattava = Kilpailija::etsiKilpailija($_GET["muokattava"]);

    if ($muokattava == null) {
        naytaNakyma("hallinta.php", array('virheet' => "Kilpailijaa ei ole olemassa"));
    } else {
        naytaNakyma("kilpailijanMuokkaus.php", array(
            'kilpailutunnus' => $muokattava->getKilpailutunnus(),
			'kilpailijatunnus' => $muokattava->getKilpailijatunnus(),
			'kilpailijanumero' => $muokattava->getKilpailijanumero(),
            'nimi' => $muokattava->getNimi(),
            'seura' => $muokattava->getSeura(),
            'lahtoaika' => $muokattava->getLahtoaika(),
        ));
    }
}

if (isset($_POST["tallennaNappi"])) {
    $muokattavalomakkeelta = Kilpailija::etsiKilpailija($_POST["kilpailijatunnus"]);
	$muokattavalomakkeelta->setKilpailijanumero($_POST["kilpailijanumero"]);
	$muokattavalomakkeelta->setNimi($_POST["nimi"]);
    $muokattavalomakkeelta->setSeura($_POST["seura"]);
    $muokattavalomakkeelta->setLahtoaika($_POST["lahtoaika"]);
	
	if ($muokattavalomakkeelta->onkoKelvollinen()) {
        $muokattavalomakkeelta->paivitaKantaan();
        $_SESSION["ilmoitus"] = "Kilpailijan muokkaus onnistui!";
        header("Location: hallinta.php");
		}
     else {
        naytaNakyma("kilpailijanMuokkaus.php", array(
            'virheet' => $muokattavalomakkeelta->getVirheet(),
            'kilpailutunnus' => $muokattavalomakkeelta->getKilpailutunnus(),
			'kilpailijatunnus' => $muokattavalomakkeelta->getKilpailijatunnus(),
			'kilpailijanumero' => $muokattavalomakkeelta->getKilpailijanumero(),
            'nimi' => $muokattavalomakkeelta->getNimi(),
            'seura' => $muokattavalomakkeelta->getSeura(),
            'lahtoaika' => $muokattavalomakkeelta->getLahtoaika(),

        ));
    }
	}
}
	
?>
