<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	
	if (isset($_SESSION['kirjautunut'])) {
		if (isset($_GET["valiaika"])) {
			$_SESSION['kilpailuid'] = $_GET["valiaika"];
			naytaNakyma('valiaikapisteetListaus.php');
		}
	}	
?>
