<?php
	require_once "./libs/common.php";
	require_once "./libs/models/valiaika.php";
	require_once "./libs/models/valiaikapiste.php";
	require_once "./libs/models/kilpailija.php";
	$kilpailijatunnus = $_SESSION['kilpailijatunnus'];
	$kilpailija = Kilpailija::etsiKilpailija($kilpailijatunnus);
	$valiaikapisteet = Valiaikapiste::getValiaikapisteet($kilpailija->getKilpailutunnus());


?>
   <h1><?php echo $kilpailija->getNimi(); ?></h1>
   <h4><?php echo $kilpailija->getSeura();?></h4>
   <table class="table table-striped">
	    <thead>
        <tr>
		<th>Väliaikapiste</th>
          <th>Väliaika</th>
          <th>Ero kärkeen</th>
        </tr>
      </thead>
	    <?php foreach($valiaikapisteet as $valiaikapiste) { 
			$valiajat = Valiaika::getValiajat($valiaikapiste->getValiaikapistetunnus());
			foreach($valiajat as $valiaika) {
			
			if($valiaika != null){
			$parasKilpailija = Kilpailija::etsiKilpailija($valiajat[0]->getKilpailijatunnus());
			$parasLahto = new Datetime(date('Y-m-d H:i:s', strtotime($parasKilpailija->getLahtoaika())));
			$parasValiaika = new Datetime(date('Y-m-d H:i:s', strtotime($valiajat[0]->getValiaika())));
			$parastulos = $parasValiaika->diff($parasLahto); 
			$parasaika = new Datetime(date($parastulos->format('%Y-%m-%d %H:%i:%s')));
			
			if($valiaika->getKilpailijatunnus() ==  $kilpailijatunnus){
			$lahtoaika = new Datetime(date('Y-m-d H:i:s', strtotime($kilpailija->getLahtoaika())));
			$valiaikapisteessa = new Datetime(date('Y-m-d H:i:s', strtotime($valiaika->getValiaika())));
			$suoritus = $valiaikapisteessa->diff($lahtoaika);
			$suoritusaika = new Datetime(date($suoritus->format('%Y-%m-%d %H:%i:%s')));
			$erokarkeen = $parasaika->diff($suoritusaika);
			$erokarkeen = date('H:i:s', strtotime($erokarkeen->format('%Y-%m-%d %H:%i:%s')));
			$suoritus = date('H:i:s', strtotime($suoritus->format('%Y-%m-%d %H:%i:%s')));
			}}}
			?>
		<tr>
		<td><?php echo $valiaikapiste->getMatka(); ?> km</td>
		<td><?php echo $suoritus; ?></td>
		<td><?php if($erokarkeen == null) echo ""; else echo "+ $erokarkeen"; ?></td>
	    <?php } ?>
		</tr>
   </table>
   <button class="btn btn-default" onClick="location.href='tulokset.php?tulokset=<?php echo $kilpailija->getKilpailutunnus(); ?>'" >Palaa takaisin</button>
