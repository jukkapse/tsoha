<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	require_once './libs/models/kilpailija.php';
	require_once './libs/models/valiaikapiste.php';

if (isset($_SESSION['kirjautunut'])) {
	


	if(!isset($_POST['submit'])){

	$_SESSION['kilpailutunnus'] = $_GET['lisaaValiaikapiste'];
    naytaNakyma('valiaikapisteenLisays.php');	
	
	}

	$valiaikapiste = new Valiaikapiste;
	$valiaikapiste->setKilpailutunnus($_POST["kilpailutunnus"]);
	$valiaikapiste->setMatka($_POST["matka"]);
	$kilpailutunnus = $_POST["kilpailutunnus"];
	
    $valiaikapiste->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Väliaikapiste lisätty onnistuneesti.";
    header("Location: valiaikapisteet.php?valiaika=$kilpailutunnus");
}
?>
