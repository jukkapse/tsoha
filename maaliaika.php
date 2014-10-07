
<?php

require_once './libs/common.php';
require_once './libs/models/kilpailija.php';

if (isset($_GET["maali"])) {
    $kilpailija = Kilpailija::etsiKilpailija($_GET["maali"]);
	$kilpailija->maaliaika(); 
    $_SESSION['ilmoitus'] = "Kilpailijalle lisättiin maaliaika onnistuneesti!";
	header('Location:' . $_SERVER['HTTP_REFERER']);  
    exit();
} else {
    header("Location: index.php");
    exit();
}