<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	require_once './libs/models/kilpailija.php';
	require_once './libs/models/valiaikapiste.php';

	if (isset($_SESSION['kirjautunut'])) {
		if (isset($_POST["hallinta"])) {
				header("Location: hallinta.php");
		}
	
		if (isset($_GET["poista"])) {
			$poistettava = Kilpailu::etsiKilpailu($_GET["poista"]);
			$kilpailijat = Kilpailija::lahtolista($_GET["poista"]);
			$valiaikapisteet = Valiaikapiste::getValiaikapisteet($_GET["poista"]);
			foreach($valiaikapisteet as $valiaikapiste) {
			$valiaikapiste->poistaKannasta();
			}
			foreach($kilpailijat as $kilpailija) {
			$kilpailija->poistaKannasta();
			}	
			$poistettava->poistaKannasta();
			$_SESSION['ilmoitus'] = "Kilpailu poistettiin onnistuneesti!";
			header("Location: hallinta.php");
			exit();
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
		
		if (isset($_POST["muokkaa"])) {
			$muokattu = Kilpailu::etsiKilpailu($_POST["kilpailutunnus"]);
			$muokattu->setNimi($_POST["nimi"]);
			$muokattu->setPaivamaara($_POST["paivamaara"]);
			$muokattu->setPaikkakunta($_POST["paikkakunta"]);
			if ($muokattu->onkoKelvollinen()) {
				$muokattu->paivitaKantaan();
				$_SESSION["ilmoitus"] = "Kilpailun muokkaus onnistui!";
				header("Location: hallinta.php");
			}
			else {
				naytaNakyma("kilpailunMuokkaus.php", array(
				'virheet' => $muokattu->getVirheet(),
				'kilpailutunnus' => $muokattu->getKilpailutunnus(),
				'nimi' => $muokattu->getNimi(),
				'paivamaara' => $muokattu->getPaivamaara(),
				'paikkakunta' => $muokattu->getPaikkakunta(),

				));
			}
		}
		
		if(isset($_GET["lisaa"])) {
			naytaNakyma('kilpailunLisays.php');	
		}	
		if(isset($_POST['lisattava'])){
			$kilpailu = new Kilpailu;
			$kilpailu->setNimi($_POST["nimi"]);
			$kilpailu->setPaikkakunta($_POST["paikkakunta"]);
			$kilpailu->setPaivamaara($_POST["paivamaara"]);
		
			if ($kilpailu->onkoKelvollinen()) {
				$kilpailu->lisaaKantaan();
				$_SESSION['ilmoitus'] = "Kilpailu lisätty onnistuneesti.";
				header('Location: hallinta.php');
			} else {
				naytaNakyma("kilpailunLisays.php", array(
				'virheet' => $kilpailu->getVirheet(),
				));
			}	
		}
	}	
?>
