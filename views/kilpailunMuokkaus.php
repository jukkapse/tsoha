<?php
	require_once './libs/common.php';
	require_once './libs/models/kilpailu.php';

?>

<h3>Kilpailun muokkaus</h3>
    <form class="form-horizontal" role="form" action="kilpailu.php" method="POST">
        <div class="form-group">
            <label for="paivamaara" class="col-md-2 control-label">Päivämäärä:</label>
            <div class="col-md-3">
                <input type="date" class="form-control" name="paivamaara" placeholder="Päivämäärä" value="<?php echo $data->paivamaara; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="nimi" class="col-md-2 control-label">Kilpailun nimi:</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="nimi" placeholder="Kilpailun nimi" value="<?php echo $data->nimi; ?>">
            </div>
        </div>
		 <div class="form-group">
            <label for="paikkakunta" class="col-md-2 control-label">Paikkakunta</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="paikkakunta" placeholder="Paikkakunta" value="<?php echo $data->paikkakunta; ?>">
            </div>
        </div>
		<input type="hidden" name="kilpailutunnus" value="<?php echo $data->kilpailutunnus; ?>">
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button name="muokkaa" type="submit" class="btn btn-default">Muokkaa kilpailu</button>
				<button name="hallinta" type="submit" class="btn btn-default">Palaa takaisin</button>
            </div>
        </div>
    </form>