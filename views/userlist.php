<?php

require_once '../libs/models/user.php';
require_once '../libs/models/common.php';

  $hakusana = null;
  if (!empty($_GET['haku'])) {
    $hakusana = $_GET['haku'];
  }

    $kissat = Kissa::etsiHakusanalla($hakusana);
	
	naytaNakymä("kayttajalista", array(
    'title' => "Kayttajalista",
    'kissat' => $kissat
  ));