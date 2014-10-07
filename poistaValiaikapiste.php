<?php

require_once './libs/common.php';
require_once './libs/models/valiaikapiste.php';


if (!empty($_GET["poista"])) {
    $poistettava = Valiaikapiste::etsiValiaikapiste($_GET["poista"]);
    $poistettava->poistaKannasta();
    $_SESSION['ilmoitus'] = "Väliaikapiste poistettiin onnistuneesti!";
    header("Location: hallinta.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
