<h3>Lisää kilpailu</h3>
    <form class="form-horizontal" role="form" action="kilpailu.php" method="POST">
        <div class="form-group">
            <label for="paivamaara" class="col-md-2 control-label">Päivämäärä:</label>
            <div class="col-md-3">
                <input type="date" class="form-control" name="paivamaara" placeholder="Päivämäärä">
            </div>
        </div>
        <div class="form-group">
            <label for="nimi" class="col-md-2 control-label">Kilpailun nimi:</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="nimi" placeholder="Kilpailun nimi">
            </div>
        </div>
		 <div class="form-group">
            <label for="paikkakunta" class="col-md-2 control-label">Paikkakunta</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="paikkakunta" placeholder="Paikkakunta">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button name="lisattava" type="submit" class="btn btn-default">Lisää kilpailu</button>
				<button type="submit" name="hallinta" class="btn btn-default" formaction="hallinta.php">Palaa takaisin</button>
				
            </div>
        </div>
    </form>