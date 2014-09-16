<?php>
	require_once "libs/tietokantayhteys.php";
	require_once "libs/kayttaja.php";
	$lista = Kayttaja::etsiKaikkiKayttajat();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Listaustesti</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<link href="css/bootstrap-min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
<html>
    <body>
        <h1>Listaustesti</h1>
        <ul>
            <?php foreach ($lista as $kayttaja): ?>
                <li><?php echo $kayttaja->getUsername(); ?></li>
             <?php endforeach; ?>
        </ul>
    </body>
</html>