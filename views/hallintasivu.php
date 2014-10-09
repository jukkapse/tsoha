<?php	
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';
	$kilpailut = Kilpailu::getKilpailut();
?>

<h1>Tulospalvelun hallinta</h1>
<table><td>&nbsp;&nbsp;Kilpailuaika:&nbsp;</td><td><div id="kello"></div></td></table>

<h3>Kilpailut</h3>
   <table class="table table-striped">
	    <thead>
        <tr>
          <th>Päivämäärä</th>
          <th>Kilpailun nimi</th>
          <th>Paikkakunta</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
	 <?php foreach($kilpailut as $kilpailu) { ?>
      <tr>
	  <td><?php echo date("d.m.Y", strtotime($kilpailu->getPaivamaara()));?></td>
	  <td><?php echo $kilpailu->getNimi(); ?></td>
	  <td><?php echo $kilpailu->getPaikkakunta(); ?></td>
	  <form method="GET">
			<td><button type="submit" name="tulospalvelu" value="<?php echo $kilpailu->getKilpailutunnus(); ?>"  class="btn btn-primary" formaction="tulospalvelu.php">Ajanotto</button></td>               
      </form>
	  <form method="GET">
			<td><button type="submit" name="valiaika" value="<?php echo $kilpailu->getKilpailutunnus(); ?>"  class="btn btn-info" formaction="valiaikapiste.php">Väliaikapisteet</button></td>               
      </form>
	  <form method="GET">
			<td><button type="submit" name="kilpailijat" value="<?php echo $kilpailu->getKilpailutunnus(); ?>"  class="btn btn-info" formaction="kilpailijat.php">Kilpailijat</button></td>               
      </form>
	  <form method="GET">
			<td><button type="submit" name="muokattava" value="<?php echo $kilpailu->getKilpailutunnus(); ?>"  class="btn btn-warning" formaction="kilpailu.php">Muokkaa</button></td>               
      </form>
	  <form method="GET" onsubmit="return confirm('Haluatko varmasti poistaa kilpailun?')">
                <td><button type="submit" name="poista" value="<?php echo $kilpailu->getKilpailutunnus(); ?>" class="btn btn-danger" formaction="kilpailu.php" >Poista</button></td>
      </form>
	  </tr>
	<?php } ?>	
   </table>
   
	<form method="GET">
		<button type="submit" name="lisaa" formaction="kilpailu.php" class="btn btn-success">Lisää kilpailu</button>
		<button type="submit" name="logout" formaction="login.php" class="btn btn-danger">Kirjaudu ulos</button>
	</form>
