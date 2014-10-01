<?php

require_once './libs/common.php';
require_once './libs/models/kilpailu.php';


if (!empty($_GET["kilpailutunnus"])) {
    $poistettava = Kilpailu::etsiKilpailu($_GET["kilpailutunnus"]);
    $poistettava->poistaKannasta();
    $_SESSION['ilmoitus'] = "Kilpailu poistettiin onnistuneesti!";
    header("Location: hallinta.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}