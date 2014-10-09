
<?php

	require_once './libs/common.php';
	require_once './libs/models/kilpailija.php';
	require_once './libs/models/valiaika.php';
	require_once './libs/models/valiaikapiste.php';
	require_once './libs/models/kilpailu.php';
	
	if (isset($_SESSION['kirjautunut'])) {
		if (isset($_GET["valiaika"])) {
			$valiaikapiste = Valiaikapiste::etsiValiaikapiste($_GET["valiaika"]);
			$kilpailija = Kilpailija::etsiKilpailija($_GET["kilpailijatunnus"]);
			$valiaika = new Valiaika();
			$valiaika->lisaaValiaika($valiaikapiste->getValiaikapistetunnus(), $kilpailija->getKilpailijatunnus()); 
			$_SESSION['ilmoitus'] = "Kilpailijalle lisättiin väliaika onnistuneesti!";
			header('Location:' . $_SERVER['HTTP_REFERER']);  
			exit();
		}
	}
	if (isset($_GET["valiajat"])) {
	$_SESSION['kilpailutunnus'] = $_GET["valiajat"];
		naytaNakyma('valiajat.php');
	}
?>