<?php
	require_once "./libs/common.php";
	require_once "./libs/models/kilpailu.php";
	require_once "./libs/models/kilpailija.php";
	$kilpailuid = $_SESSION['kilpailuid'];
	$kilpailijat = Kilpailija::lahtolista($kilpailuid);
	$kilpailu = Kilpailu::etsiKilpailu($kilpailuid);


?>
   
   <h1>Kilpailijat</h1>
   <h3><?php echo $kilpailu->getNimi();?> - <?php echo date("d.m.Y", strtotime($kilpailu->getPaivamaara()));?></h3>
   <table class="table table-striped">
	    <thead>
        <tr>
          <th>Kilpailunumero</th>
          <th>Nimi</th>
          <th>Seura</th>
          <th>Lähtöaika</th>
        </tr>
      </thead>
	 <?php foreach($kilpailijat as $kilpailija) { ?>
      <tr>
	  <td><?php echo $kilpailija->getKilpailijanumero();?></td>
	  <td><?php echo $kilpailija->getNimi(); ?></td>
	  <td><?php echo $kilpailija->getSeura(); ?></td>
	  <td><?php echo $kilpailija->getLahtoaika(); ?></td>
	  <form method="GET">
			<td><button type="submit" name="muokattava" value="<?php echo $kilpailija->getKilpailijatunnus(); ?>"  class="btn btn-warning" formaction="kilpailija.php">Muokkaa</button></td>               
      </form>
	  <form method="GET" onsubmit="return confirm('Haluatko varmasti poistaa kilpaililjan?')">
                <td><button type="submit" name="poista" value="<?php echo $kilpailija->getKilpailijatunnus(); ?>" class="btn btn-danger" formaction="kilpailija.php" >Poista</button></td>
      </form>
	  </tr>
    <?php } ?>	
   </table>
   	  <form method="GET">
			<button type="submit" name="lisaa" value="<?php echo $kilpailu->getKilpailutunnus(); ?>"  class="btn btn-success" formaction="kilpailija.php">Lisää kilpailija</button>    
			<button type="submit" class="btn btn-default" formaction="hallinta.php">Palaa takaisin</button>			
      </form>
