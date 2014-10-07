	<h3>Kirjaudu sisään</h3>
    <form class="form-horizontal" role="form" action="login.php" method="POST">
        <div class="form-group">
            <label for="tunnus" class="col-md-2 control-label">Käyttäjätunnus:</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="tunnus" placeholder="Käyttäjätunnus">
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
                <button name="paluu" type="submit" class="btn btn-default">Palaa takaisin</button>
            </div>
        </div>
    </form>
