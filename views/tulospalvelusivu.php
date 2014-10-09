<?php
	require_once "./libs/common.php";
	require_once "./libs/models/kilpailu.php";
	require_once "./libs/models/kilpailija.php";
	require_once "./libs/models/valiaikapiste.php";
	require_once "./libs/models/valiaika.php";
	$kilpailuid = $_SESSION['kilpailuid'];
	$kilpailijat = Kilpailija::lahtolista($kilpailuid);
	$valiaikapisteet = Valiaikapiste::getValiaikapisteet($kilpailuid);
	$kilpailu = Kilpailu::etsiKilpailu($kilpailuid);


?>
   <h1>Ajanotto</h1>
   <table><td>&nbsp;&nbsp;Kilpailuaika:&nbsp;</td><td><div id="kello"></div></td></table>
   <h3><?php echo $kilpailu->getNimi();?> - <?php echo date("d.m.Y", strtotime($kilpailu->getPaivamaara()));?></h3>
   <table class="table table-striped">
	    <thead>
        <tr>
          <th>Kilpailunumero</th>
          <th>Nimi</th>
          <th>Seura</th>
          <th>Lähtöaika</th>
		  <?php foreach($valiaikapisteet as $valiaikapiste) { ?>
		  <th>Väliaika <?php echo $valiaikapiste->getMatka(); ?>km</th>
		  <?php } ?>	
		  <th>Maaliaika</th>
        </tr>
      </thead>
	 <?php foreach($kilpailijat as $kilpailija) { ?>
      <tr>
	  <td><?php echo $kilpailija->getKilpailijanumero();?></td>
	  <td><?php echo $kilpailija->getNimi(); ?></td>
	  <td><?php echo $kilpailija->getSeura(); ?></td>
	  <td><?php echo $kilpailija->getLahtoaika(); ?></td>
	  <?php foreach($valiaikapisteet as $valiaikapiste) { 
			$tulos = Valiaika::etsiValiaika($valiaikapiste->getValiaikapistetunnus(),$kilpailija->getKilpailijatunnus());
			if($tulos == null){
	  ?>
	  <form method="GET">
			<input type="hidden" name="kilpailijatunnus" value="<?php echo $kilpailija->getKilpailijatunnus(); ?>">
			<td><button type="submit" name="valiaika" value="<?php echo $valiaikapiste->getValiaikapistetunnus(); ?>"  class="btn btn-info" formaction="valiaika.php">Väliaika</button></td> 
      </form>
	  <?php } else { ?>
	  <td></td>
	  <?php }} ?>	
	  <?php if($kilpailija->getLoppuaika() == null) { ?>
	  	   <form method="GET">
			<td><button type="submit" name="maali" value="<?php echo $kilpailija->getKilpailijatunnus(); ?>"  class="btn btn-success" formaction="maaliaika.php">Maali</button></td>               
      </form>
	  <?php } else { ?>	
	  <td></td>
	  <?php } ?>	
	  </tr>
    <?php } ?>	
   </table>
   
   <button class="btn btn-default" onClick="location.href='hallinta.php'" >Palaa takaisin</button>
