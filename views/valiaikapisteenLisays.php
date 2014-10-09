<?php $kilpailutunnus = $_SESSION['kilpailutunnus'] ?>
<h3>Lisää väliaikapiste</h3>
    <form class="form-horizontal" role="form" action="lisaaValiaikapiste.php" method="POST">
        <div class="form-group">
            <label for="matka" class="col-md-2 control-label">Matka:</label>
            <div class="col-md-3">
                <input type="number" step="0.1" class="form-control" name="matka" placeholder="Matka (km)">
            </div>
        </div>
		<input type="hidden" name="kilpailutunnus" value="<?php echo $kilpailutunnus; ?>">
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button name="submit" type="lisattava" class="btn btn-default">Lisää väliaikapiste</button>
				<button type="submit" class="btn btn-default" formaction="valiaikapisteet.php?valiaika=<?php echo $kilpailutunnus; ?>">Palaa takaisin</button>
            </div>
        </div>
    </form>
