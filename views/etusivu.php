<?php
	require_once "./libs/common.php";
	require_once "./libs/models/kilpailu.php";
	require_once "./libs/models/kilpailija.php";
	$kilpailut = Kilpailu::getKilpailut();

?>
  <img src="./img/header.png" alt="Hiihtaja" height="242">
   
   <h1>Kilpailut</h1>
   <table class="table table-striped">
	
	    <thead>
        <tr>
          <th>Päivämäärä</th>
          <th>Kilpailun nimi</th>
          <th>Paikkakunta</th>
          <th>Lähtölista</th>
          <th>Lopputulokset</th>
        </tr>
      </thead>
	 <?php foreach($kilpailut as $kilpailu) { ?>
	 <?php $lahtolista = Kilpailija::lahtolista($kilpailu->getKilpailutunnus()); ?>
	 <?php $tuloslista = Kilpailija::tuloslista($kilpailu->getKilpailutunnus()); ?>
      <tr>
	  <td><?php echo date("d.m.Y", strtotime($kilpailu->getPaivamaara()));?></td>
	  <td><?php echo $kilpailu->getNimi(); ?></td>
	  <td><?php echo $kilpailu->getPaikkakunta(); ?></td>
	  <td> 
	  <?php if (empty($lahtolista)) echo "Ei lähtölistaa"; else include "lahtonappula.php";?>
	  </td>
	  <td> <?php if (empty($tuloslista)) echo "Ei tuloksia"; else include "tulosnappula.php" ?></td>
	  </tr>
    <?php } ?>	
   </table>
   <a href="./login.php"><button type="submit" class="btn btn-default">Tulospalvelun hallinta</button></a>
