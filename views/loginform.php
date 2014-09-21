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
	
	<h3>Kirjaudu sisään</h3>
    <form class="form-horizontal" role="form" action="login.php" method="POST">
        <div class="form-group">
            <label for="tunnus" class="col-md-2 control-label">Käyttäjätunnus:</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="tunnus" placeholder="Käyttäjätunnus" value="<?php echo $data->tunnus; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="salasana" class="col-md-2 control-label">Salasana:</label>
            <div class="col-md-3">
                <input type="password" class="form-control" id="inputPassword1" name="salasana" placeholder="Salasana">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button name="submit" type="submit" class="btn btn-default">Kirjaudu sisään</button>
            </div>
        </div>
    </form>