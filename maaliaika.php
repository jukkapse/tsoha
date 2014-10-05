
<?php

require_once './libs/common.php';
require_once './libs/models/kilpailija.php';
$today = strtotime("now");

if (!empty($_GET["kilpailijatunnus"])) {
    $kilpailija = Kilpailija::etsiKilpailija($_GET["kilpailijatunnus"]);
    $kilpailija->setLoppuaika(echo date("H:i:s", time()));
	$kilpailija->maaliaika();
    $_SESSION['ilmoitus'] = "Kilpailijalle lisättiin maaliaika onnistuneesti!";
	header('Location:' . $_SERVER['HTTP_REFERER']);  
    exit();
} else {
    header("Location: index.php");
    exit();
}