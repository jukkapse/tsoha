<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	require_once './libs/models/kilpailija.php';
	
	if (isset($_SESSION['kirjautunut'])) {

		if (isset($_GET["kilpailijat"])) {
			$_SESSION['kilpailuid'] = $_GET["kilpailijat"];
			naytaNakyma('kilpailijatlistaus.php');
		}
	}	
?>
