<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailija.php';

?>

<h3>Kilpailijan muokkaus</h3>
    <form class="form-horizontal" role="form" action="muokkaaKilpailijaa.php" method="POST">
        <div class="form-group">
            <label for="kilpailijanumero" class="col-md-2 control-label">Kilpailunumero:</label>
            <div class="col-md-3">
                <input type="number" class="form-control" name="kilpailijanumero" placeholder="Kilpailijanumero" value="<?php echo $data->kilpailijanumero; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="nimi" class="col-md-2 control-label">Nimi:</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="nimi" placeholder="Sukunimi, Etunimi" value="<?php echo $data->nimi; ?>">
            </div>
        </div>
		 <div class="form-group">
            <label for="seura" class="col-md-2 control-label">Seura:</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="seura" placeholder="Seura" value="<?php echo $data->seura; ?>">
            </div>
        </div>
		<div class="form-group">
            <label for="lahtoaika" class="col-md-2 control-label">Lähtöaika:</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="lahtoaika" placeholder="Lähtöaika" value="<?php echo $data->lahtoaika; ?>">
            </div>
        </div>
		<input type="hidden" name="kilpailijatunnus" value="<?php echo $data->kilpailijatunnus; ?>">
		<input type="hidden" name="kilpailutunnus" value="<?php echo $data->kilpailutunnus; ?>">
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button name="muokkaa" type="submit" class="btn btn-default">Muokkaa kilpailijaa</button>
				<button type="submit" class="btn btn-default" formaction="kilpailijat.php?kilpailijat=<?php echo $data->kilpailutunnus; ?>">Palaa takaisin</button>
            </div>
        </div>
    </form>
