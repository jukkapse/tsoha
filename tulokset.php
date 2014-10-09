<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	require_once './libs/models/kilpailija.php';
	
	if (isset($_GET["tulokset"])) {
	$_SESSION['kilpailutunnus'] = $_GET["tulokset"];
		naytaNakyma('tulossivu.php');
	}	
?>
