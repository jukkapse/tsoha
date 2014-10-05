<?php $kilpailuid = $_SESSION['kilpailutunnus'] ?>
<h3>Lisää kilpailija</h3>
    <form class="form-horizontal" role="form" action="lisaaKilpailija.php" method="POST">
        <div class="form-group">
            <label for="kilpailijanumero" class="col-md-2 control-label">Kilpailijanumero:</label>
            <div class="col-md-3">
                <input type="number" class="form-control" name="kilpailijanumero" placeholder="Kilpailijanumero">
            </div>
        </div>
        <div class="form-group">
            <label for="nimi" class="col-md-2 control-label">Nimi:</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="nimi" placeholder="Sukunimi, Etunimi">
            </div>
        </div>
		 <div class="form-group">
            <label for="seura" class="col-md-2 control-label">Seura:</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="seura" placeholder="Seura">
            </div>
        </div>
         <div class="form-group">
            <label for="lahtoaika" class="col-md-2 control-label">Lähtöaika:</label>
            <div class="col-md-3">
                <input type="time" class="form-control" name="lahtoaika" placeholder="Lähtöaika">
            </div>
        </div>
		<input type="hidden" name="kilpailutunnus" value="<?php echo $kilpailuid; ?>">
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button name="submit" type="submit" class="btn btn-default">Lisää kilpailija</button>
            </div>
        </div>
    </form>
<!--	<button class="btn btn-default" onClick="location.href='hallinta.php'">Takaisin</button>
	-->