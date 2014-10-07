<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	require_once './libs/models/kilpailija.php';
	
	if (isset($_GET["valiajat"])) {
	$_SESSION['kilpailuid'] = $_GET["valiajat"];
		naytaNakyma('valiaikasivu.php');
	}	
?>
