<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	require_once './libs/models/kilpailija.php';
	
	if (isset($_GET["kilpailijatunnus"])) {
	$_SESSION['kilpailijatunnus'] = $_GET["kilpailijatunnus"];
		naytaNakyma('kilpailijasivu.php');
	}
	
	if (isset($_SESSION['kirjautunut'])) {
		if (isset($_GET["poista"])) {
			$poistettava = Kilpailija::etsiKilpailija($_GET["poista"]);
			$poistettava->poistaKannasta();
			$_SESSION['ilmoitus'] = "Kilpailija poistettiin onnistuneesti!";
			header('Location:' . $_SERVER['HTTP_REFERER']);  
			exit();
		}
				
		if (isset($_GET["lisaa"])) {
			$_SESSION['kilpailutunnus'] = $_GET['lisaa'];
			naytaNakyma('kilpailijanLisays.php');

		}
		
		if(isset($_POST['lisattava'])){
			$kilpailija = new Kilpailija;
			$kilpailija->setKilpailutunnus($_POST["kilpailutunnus"]);
			$kilpailija->setKilpailijanumero($_POST["kilpailijanumero"]);
			$kilpailija->setNimi($_POST["nimi"]);
			$kilpailija->setSeura($_POST["seura"]);
			$kilpailija->setLahtoaika($_POST["lahtoaika"]);
			$kilpailutunnus = $_POST["kilpailutunnus"];
			
			if ($kilpailija->onkoKelvollinen()) {
				$kilpailija->lisaaKantaan();
				$_SESSION['ilmoitus'] = "Kilpailija lisätty onnistuneesti.";
				header("Location: kilpailijat.php?kilpailijat=$kilpailutunnus");
			} else {
				naytaNakyma("kilpailijanLisays.php", array(
				'virheet' => $kilpailija->getVirheet(),
				));
			}
		}	
		
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

		if (isset($_POST["muokkaa"])) {
			$muokattu = Kilpailija::etsiKilpailija($_POST["kilpailijatunnus"]);
			$muokattu->setKilpailijanumero($_POST["kilpailijanumero"]);
			$muokattu->setNimi($_POST["nimi"]);
			$muokattu->setSeura($_POST["seura"]);
			$muokattu->setLahtoaika($_POST["lahtoaika"]);
			$kilpailuid = $_POST['kilpailutunnus'];
	
			if ($muokattu->onkoKelvollinen()) {
				$muokattu->paivitaKantaan();
				$_SESSION["ilmoitus"] = "Kilpailijan muokkaus onnistui!";
				header("Location: kilpailijat.php?kilpailijat=$kilpailuid");
			}
			else {
				naytaNakyma("kilpailijanMuokkaus.php", array(
					'virheet' => $muokattu->getVirheet(),
					'kilpailutunnus' => $muokattu->getKilpailutunnus(),
					'kilpailijatunnus' => $muokattu->getKilpailijatunnus(),
					'kilpailijanumero' => $muokattu->getKilpailijanumero(),
					'nimi' => $muokattu->getNimi(),
					'seura' => $muokattu->getSeura(),
					'lahtoaika' => $muokattu->getLahtoaika(),
					));
			}
		}

	}
?>
