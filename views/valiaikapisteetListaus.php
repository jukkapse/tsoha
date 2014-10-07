<?php
	require_once "./libs/common.php";
	require_once "./libs/models/kilpailu.php";
	require_once "./libs/models/kilpailija.php";
	require_once "./libs/models/valiaikapiste.php";
	$kilpailuid = $_SESSION['kilpailuid'];
	$valiaikapisteet = Valiaikapiste::getValiaikapisteet($kilpailuid);
	$kilpailu = Kilpailu::etsiKilpailu($kilpailuid);


?>
   
   <h1>Väliaikapisteet</h1>
   <h3><?php echo $kilpailu->getNimi();?> - <?php echo date("d.m.Y", strtotime($kilpailu->getPaivamaara()));?></h3>
   <table class="table table-striped">
	    <thead>
        <tr>
          <th>Matka</th>
        </tr>
      </thead>
	 <?php foreach($valiaikapisteet as $valiaikapiste) { ?>
      <tr>
	  <td><?php echo $valiaikapiste->getMatka();?> km</td>

	  <form method="GET">
			<td><button type="submit" name="muokattava" value="<?php echo $valiaikapiste->getValiaikapistetunnus(); ?>"  class="btn btn-warning" formaction="muokkaaValiaikapistetta.php">Muokkaa</button></td>               
      </form>
	  <form method="GET" onsubmit="return confirm('Haluatko varmasti poistaa väliaikapisteen?')">
                <td><button type="submit" name="poista" value="<?php echo $valiaikapiste->getValiaikapistetunnus(); ?>" class="btn btn-danger" formaction="poistaValiaikapiste.php" >Poista</button></td>
      </form>
	  </tr>
    <?php } ?>	
   </table>
   	  <form method="GET">
			<button type="submit" name="lisaaValiaikapiste" value="<?php echo $kilpailu->getKilpailutunnus(); ?>"  class="btn btn-success" formaction="lisaaValiaikapiste.php">Lisää valiaikapiste</button>    
			<button type="submit" class="btn btn-default" formaction="hallinta.php">Palaa takaisin</button>			
      </form>
