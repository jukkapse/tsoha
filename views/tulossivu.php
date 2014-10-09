<?php
	require_once "./libs/common.php";
	require_once "./libs/models/kilpailu.php";
	require_once "./libs/models/kilpailija.php";
	$kilpailutunnus = $_SESSION['kilpailutunnus'];
	$kilpailijat = Kilpailija::tuloslista($kilpailutunnus);
	$kilpailu = Kilpailu::etsiKilpailu($kilpailutunnus);
	$sijoitus = 0;


?>
   
   <h1>Tulokset</h1>
   <h3><?php echo $kilpailu->getNimi();?> - <?php echo date("d.m.Y", strtotime($kilpailu->getPaivamaara()));?></h3>
   <table class="table table-striped">
	    <thead>
        <tr>
		<th>Sijoitus</th>
          <th>Nimi</th>
          <th>Seura</th>
          <th>Loppuaika</th>
		  <th>Ero kärkeen</th>
        </tr>
      </thead>
	 <?php foreach($kilpailijat as $kilpailija) { ?>
	 <?php 	

			$parasLahto = new Datetime(date('Y-m-d H:i:s', strtotime($kilpailijat[0]->getLahtoaika())));
			$parasMaali = new Datetime(date('Y-m-d H:i:s', strtotime($kilpailijat[0]->getLoppuaika())));
			$parastulos = $parasMaali->diff($parasLahto); 
			$parasaika = new Datetime(date($parastulos->format('%Y-%m-%d %H:%i:%s')));
			$lahtoaika = new Datetime(date('Y-m-d H:i:s', strtotime($kilpailija->getLahtoaika())));
			$maaliaika = new Datetime(date('Y-m-d H:i:s', strtotime($kilpailija->getLoppuaika())));
			$suoritus = $maaliaika->diff($lahtoaika); 
			$suoritusaika = new Datetime(date($suoritus->format('%Y-%m-%d %H:%i:%s')));
			$erokarkeen = $parasaika->diff($suoritusaika);
			$erokarkeen = date('H:i:s', strtotime($erokarkeen->format('%Y-%m-%d %H:%i:%s')));
			$suoritus = date('H:i:s', strtotime($suoritus->format('%Y-%m-%d %H:%i:%s')));
			?>
      <tr>
	  <td><?php if($kilpailija->getLoppuaika() == "") echo "-"; else echo $sijoitus = $sijoitus + 1;?></td>
	  <td><a href="./kilpailija.php?kilpailijatunnus=<?php echo $kilpailija->getKilpailijatunnus(); ?>"><?php echo $kilpailija->getNimi(); ?></a></td>
	  <td><?php echo $kilpailija->getSeura(); ?></td>
	  <td><?php if($kilpailija->getLoppuaika() == "") echo "Ei aikaa"; else echo $suoritus; ?></td>
	  <td><?php if($kilpailija->getLoppuaika() == "" || $sijoitus == 1) echo ""; else echo  "+ $erokarkeen"; ?></td>
	  </tr>
    <?php } ?>	
   </table>
   
   <button class="btn btn-default" onClick="location.href='index.php'" >Palaa takaisin</button>
