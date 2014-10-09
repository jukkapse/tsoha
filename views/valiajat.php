<?php
	require_once "./libs/common.php";
	require_once "./libs/models/kilpailu.php";
	require_once "./libs/models/kilpailija.php";
	require_once "./libs/models/valiaikapiste.php";
	require_once "./libs/models/valiaika.php";
	
	$kilpailutunnus = $_SESSION['kilpailutunnus'];
	$kilpailijat = Kilpailija::tuloslista($kilpailutunnus);
	$valiaikapisteet = Valiaikapiste::getValiaikapisteet($kilpailutunnus);
	$kilpailu = Kilpailu::etsiKilpailu($kilpailutunnus);


?>
   
   <h1>Väliajat</h1>
   <h3><?php echo $kilpailu->getNimi();?> - <?php echo date("d.m.Y", strtotime($kilpailu->getPaivamaara()));?></h3>
   <br>
   <?php foreach($valiaikapisteet as $valiaikapiste) {
		 $valiajat = Valiaika::getValiajat($valiaikapiste->getValiaikapistetunnus());
   ?>
   
   <h3>Väliaikapiste <?php echo $valiaikapiste->getMatka(); $sijoitus = 0;?> km</h3>
   <table class="table table-striped">
	    <thead>
        <tr>
		<th>Sijoitus</th>
          <th>Nimi</th>
          <th>Seura</th>
          <th>Väliaika</th>
		  <th>Ero kärkeen</th>
        </tr>
      </thead>

	 <?php foreach($valiajat as $valiaika) { 
		$kilpailija = Kilpailija::etsiKilpailija($valiaika->getKilpailijatunnus());
		$parasKilpailija = Kilpailija::etsiKilpailija($valiajat[0]->getKilpailijatunnus());?>
	 <?php 
		$parasLahto = new Datetime(date('Y-m-d H:i:s', strtotime($parasKilpailija->getLahtoaika())));
		$parasValiaika = new Datetime(date('Y-m-d H:i:s', strtotime($valiajat[0]->getValiaika())));
		$parastulos = $parasValiaika->diff($parasLahto); 
		$parasaika = new Datetime(date($parastulos->format('%Y-%m-%d %H:%i:%s')));
		$lahtoaika = new Datetime(date('Y-m-d H:i:s', strtotime($kilpailija->getLahtoaika())));
		$valiaikapisteessa = new Datetime(date('Y-m-d H:i:s', strtotime($valiaika->getValiaika())));
		$suoritus = $valiaikapisteessa->diff($lahtoaika);
		$suoritusaika = new Datetime(date($suoritus->format('%Y-%m-%d %H:%i:%s')));
		$erokarkeen = $parasaika->diff($suoritusaika);
		$erokarkeen = date('H:i:s', strtotime($erokarkeen->format('%Y-%m-%d %H:%i:%s')));
		$suoritus = date('H:i:s', strtotime($suoritus->format('%Y-%m-%d %H:%i:%s'))); 
			?>
      <tr>
	  <td><?php if($valiaika->getValiaika() == "") echo "-"; else echo $sijoitus = $sijoitus + 1;?></td>
	  <td><?php echo $kilpailija->getNimi(); ?></td>
	  <td><?php echo $kilpailija->getSeura(); ?></td>
	  <td><?php echo $suoritus; ?></td>
	  <td><?php if($sijoitus == 1) echo ""; else echo  "+ $erokarkeen"; ?></td>
	  </tr>
    <?php } ?>	
   </table>
      <br>

   <?php } ?>	
   
   <button class="btn btn-default" onClick="location.href='index.php'" >Palaa takaisin</button>
