<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	require_once './libs/models/kilpailija.php';
	
	if (isset($_GET["kilpailijatunnus"])) {
	$_SESSION['kilpailijatunnus'] = $_GET["kilpailijatunnus"];
		naytaNakyma('kilpailijasivu.php');
	}	
?>
