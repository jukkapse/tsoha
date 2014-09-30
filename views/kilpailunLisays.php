            <?php if (!empty($_SESSION['ilmoitus'])): ?>
            <div class="alert alert-info">
                <?php echo $_SESSION['ilmoitus']; ?>
            </div>
            <?php unset($_SESSION['ilmoitus']);
        endif; ?>
        <?php if (!empty($data->virhe)): ?>
            <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
        <?php endif; ?> 

        <?php if (!empty($data->virheet)): ?>
            <div class="alert alert-danger">
                <?php foreach ($data->virheet as $error): ?>
                    <?php echo $error . "<br>"; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['virheet'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['virheet']; ?>
            </div>
            <?php
            unset($_SESSION['virheet']);
        endif;
        ?>

<h3>Lisää kilpailu</h3>
    <form class="form-horizontal" role="form" action="lisaaKilpailu.php" method="POST">
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
                <button name="submit" type="submit" class="btn btn-default">Lisää kilpailu</button>
            </div>
        </div>
    </form>