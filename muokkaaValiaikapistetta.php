<?php
	require_once './libs/common.php';
	require_once './libs/models/valiaikapiste.php';

	if (isset($_SESSION['kirjautunut'])) {
	
	if (isset($_GET["muokattava"])) {
    $muokattava = Valiaikapiste::etsiValiaikapiste($_GET["muokattava"]);

    if ($muokattava == null) {
        naytaNakyma("hallinta.php", array('virheet' => "Väliaikapistettä ei ole olemassa"));
    } else {
        naytaNakyma("valiaikapisteenMuokkaus.php", array(
            'matka' => $muokattava->getMatka(),
			'valiaikapistetunnus' => $muokattava->getValiaikapistetunnus(),
			'kilpailutunnus' => $muokattava->getKilpailutunnus(),
        ));
    }
}

if (isset($_POST["muokkaa"])) {
    $muokattavalomakkeelta = Valiaikapiste::etsiValiaikapiste($_POST["valiaikapistetunnus"]);
	$muokattavalomakkeelta->setKilpailutunnus($_POST["kilpailutunnus"]);
	$muokattavalomakkeelta->setMatka($_POST["matka"]);
	$valiaikaid = $_POST['kilpailutunnus'];
	
        $muokattavalomakkeelta->paivitaKantaan();
        $_SESSION["ilmoitus"] = "Väliaikapisteen muokkaus onnistui!";
        header("Location: valiaikapisteet.php?valiaika=$valiaikaid");
    
	}
}
	
?>
