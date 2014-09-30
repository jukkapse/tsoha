<?php
	require_once './libs/common.php';
	require_once './libs/models/kayttaja.php';

    $kayttajat = Kayttaja::getKayttajat();

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Listaustesti</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
	<div class="container">
        <h1>Listaustesti</h1>
    <p> Käyttäjät listattuna: </p>
    <ul>
    <?php foreach($kayttajat as $kayttaja) { ?>
      <li>Tunnus: <?php echo $kayttaja->getTunnus(); ?></li>
    <?php } ?>
        </ul>
		</div>
    </body>
</html>
