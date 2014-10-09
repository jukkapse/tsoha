<?php
	require_once './libs/common.php';
	require_once './libs/models/valiaikapiste.php';

?>

<h3>Väliaikapisteen muokkaus</h3>
    <form class="form-horizontal" role="form" action="valiaikapiste.php" method="POST">
        <div class="form-group">
            <label for="kilpailijanumero" class="col-md-2 control-label">Matka:</label>
            <div class="col-md-3">
                <input type="number" step="0.1" class="form-control" name="matka" placeholder="Matka (km)" value="<?php echo $data->matka; ?>">
            </div>
        </div>
		<input type="hidden" name="valiaikapistetunnus" value="<?php echo $data->valiaikapistetunnus; ?>">
		<input type="hidden" name="kilpailutunnus" value="<?php echo $data->kilpailutunnus; ?>">
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button name="muokkaa" type="submit" class="btn btn-default">Muokkaa väliaikapistettä</button>
				<button type="submit" class="btn btn-default" formaction="valiaikapisteet.php?valiaika=<?php echo $data->kilpailutunnus; ?>">Palaa takaisin</button>
            </div>
        </div>
    </form>
