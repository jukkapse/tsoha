
<?php

require_once './libs/common.php';
require_once './libs/models/kilpailija.php';


if (!empty($_GET["kilpailijatunnus"])) {
    $poistettava = Kilpailija::etsiKilpailija($_GET["kilpailijatunnus"]);
    $poistettava->poistaKannasta();
    $_SESSION['ilmoitus'] = "Kilpailija poistettiin onnistuneesti!";
	header('Location:' . $_SERVER['HTTP_REFERER']);  
    exit();
} else {
    header("Location: index.php");
    exit();
}