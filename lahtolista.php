<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	require_once './libs/models/kilpailija.php';
	
	if (isset($_GET["lahtolista"])) {
	$_SESSION['kilpailuid'] = $_GET["lahtolista"];
		naytaNakyma('lahtolistasivu.php');
	}	
?>
