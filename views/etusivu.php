<?php
	require_once "./libs/common.php";
	require_once "./libs/models/kilpailu.php";
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
      <tr>
	  <td><?php echo date("d.m.Y", strtotime($kilpailu->getPaivamaara()));?></td>
	  <td><?php echo $kilpailu->getNimi(); ?></td>
	  <td><?php echo $kilpailu->getPaikkakunta(); ?></td>
	  <td><a href="./views/lahtolista.php?"<?php echo $kilpailu->getKilpailutunnus();?>>Ei lähtölistaa</a></td>
	  <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-check"></span> Tulokset</button></td>
	  </tr>
    <?php } ?>	
   </table>
   <a href="./login.php"><button type="submit" class="btn btn-default">Tulospalvelun hallinta</button></a>
