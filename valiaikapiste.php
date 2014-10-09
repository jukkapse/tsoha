<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	require_once './libs/models/valiaikapiste.php';
	
	if (isset($_SESSION['kirjautunut'])) {
		if (isset($_GET["valiaika"])) {
			$_SESSION['kilpailutunnus'] = $_GET["valiaika"];
			naytaNakyma('valiaikapisteetListaus.php');
		}
		if (isset($_GET["poista"])) {
			$poistettava = Valiaikapiste::etsiValiaikapiste($_GET["poista"]);
			$poistettava->poistaKannasta();
			$_SESSION['ilmoitus'] = "Väliaikapiste poistettiin onnistuneesti!";
			header('Location:' . $_SERVER['HTTP_REFERER']);
			exit();
		}
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
			$muokattu = Valiaikapiste::etsiValiaikapiste($_POST["valiaikapistetunnus"]);
			$muokattu->setKilpailutunnus($_POST["kilpailutunnus"]);
			$muokattu->setMatka($_POST["matka"]);
			$valiaikatunnus = $_POST['kilpailutunnus'];
			$muokattu->paivitaKantaan();
			$_SESSION["ilmoitus"] = "Väliaikapisteen muokkaus onnistui!";
			header("Location: valiaikapisteet.php?valiaika=$valiaikatunnus");
		}
		if(isset($_GET['lisaa'])){
			$_SESSION['kilpailutunnus'] = $_GET['lisaa'];
			naytaNakyma('valiaikapisteenLisays.php');
		}
		
		if(!isset($_POST['lisattava'])){
			$valiaikapiste = new Valiaikapiste;
			$valiaikapiste->setKilpailutunnus($_POST["kilpailutunnus"]);
			$valiaikapiste->setMatka($_POST["matka"]);
			$kilpailutunnus = $_POST["kilpailutunnus"];
			$valiaikapiste->lisaaKantaan();
			$_SESSION['ilmoitus'] = "Väliaikapiste lisätty onnistuneesti.";
			header("Location: valiaikapisteet.php?valiaika=$kilpailutunnus");
		}
	}	
?>
