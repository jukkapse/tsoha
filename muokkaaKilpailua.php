<?php
	require_once './libs/common.php';

	if (isset($_SESSION['kirjautunut'])) {
		naytaNakyma('kilpailunMuokkaus.php');
	}
?>
