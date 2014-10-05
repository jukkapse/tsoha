<?php
	require_once "./libs/common.php";
	require_once "./libs/models/kilpailu.php";
	require_once "./libs/models/kilpailija.php";
	$kilpailuid = $_SESSION['kilpailuid'];
	$kilpailijat = Kilpailija::lahtolista($kilpailuid);
	$kilpailu = Kilpailu::etsiKilpailu($kilpailuid);


?>
   
   <h1>Tulospalvelu</h1>
   <h3><?php echo $kilpailu->getNimi();?> - <?php echo date("d.m.Y", strtotime($kilpailu->getPaivamaara()));?></h3>
   <table class="table table-striped">
	    <thead>
        <tr>
          <th>Kilpailunumero</th>
          <th>Nimi</th>
          <th>Seura</th>
          <th>Lähtöaika</th>
		  <th>Väliaika (matka)</th>
		  <th>Maaliaika</th>
        </tr>
      </thead>
	 <?php foreach($kilpailijat as $kilpailija) { ?>
      <tr>
	  <td><?php echo $kilpailija->getKilpailijanumero();?></td>
	  <td><?php echo $kilpailija->getNimi(); ?></td>
	  <td><?php echo $kilpailija->getSeura(); ?></td>
	  <td><?php echo $kilpailija->getLahtoaika(); ?></td>
	  <form method="GET">
			<td><button type="submit" name="valiaika" value="<?php echo $kilpailija->getKilpailijatunnus(); ?>"  class="btn btn-success" formaction="">Väliaika</button></td>               
      </form>
	  	   <form method="GET">
			<td><button type="submit" name="maali" value="<?php echo $kilpailija->getKilpailijatunnus(); ?>"  class="btn btn-success" formaction="maaliaika.php">Maali</button></td>               
      </form>
	  </tr>
    <?php } ?>	
   </table>
   
   <button class="btn btn-default" onclick="goBack()" >Palaa takaisin</button>
