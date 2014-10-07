<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	require_once './libs/models/kilpailija.php';

if (isset($_SESSION['kirjautunut'])) {
	


	if(!isset($_POST['submit'])){

	$_SESSION['kilpailutunnus'] = $_GET['lisaaKilpailija'];
    naytaNakyma('kilpailijanLisays.php');	
	
	}

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
?>
