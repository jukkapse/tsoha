<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';

if (isset($_SESSION['kirjautunut'])) {
	
	if(!isset($_POST['submit'])){
    naytaNakyma('kilpailunLisays.php');	
	$kilpailu = new Kilpailu();
	$kilpailu->setNimi($_POST["nimi"]);
	$kilpailu->setPaikkakunta($_POST["paikkakunta"]);
	$kilpailu->setPaivamaara($_POST["paivamaara"]);
 	$kilpailu->lisaaKantaan();
	}
	header('Location: ./hallinta.php');
}
?>