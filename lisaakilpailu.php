<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';

if (isset($_SESSION['kirjautunut'])) {
	
	if (isset($_POST["paluu"])) {
    header("Location: hallinta.php");
	}
	if(!isset($_POST['submit'])){
    naytaNakyma('kilpailunLisays.php');	
	}
	$kilpailu = new Kilpailu;
	$kilpailu->setNimi($_POST["nimi"]);
	$kilpailu->setPaikkakunta($_POST["paikkakunta"]);
	$kilpailu->setPaivamaara($_POST["paivamaara"]);
	
	if ($kilpailu->onkoKelvollinen()) {
    $kilpailu->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Kilpailu lisätty onnistuneesti.";
    header('Location: hallinta.php');
} else {
    naytaNakyma("kilpailunLisays.php", array(
        'virheet' => $kilpailu->getVirheet(),
    ));
}
}
?>