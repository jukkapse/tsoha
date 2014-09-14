<!DOCTYPE html>
<html>
    <head>
        <title></title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<link href="css/bootstrap-min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
<body>
  <div class="container">
    <h1>Sisäänkirjautuminen</h1>
    <form class="form-horizontal" role="form" action="lomake.html" method="POST">
      <div class="form-group">
        <label for="inputEmail1" class="col-md-2 control-label">Sähköposti</label>
        <div class="col-md-10">
          <input type="email" class="form-control" id="inputEmail1" name="email" placeholder="Email">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword1" class="col-md-2 control-label">Salasana</label>
        <div class="col-md-10">
          <input type="password" class="form-control" id="inputPassword1" name="password" placeholder="Password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <div class="checkbox">
            <label>
              <input type="checkbox"> Muista kirjautuminen
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <a href="hallinta.php"<button type="submit" class="btn btn-default">Kirjaudu sisään</button></a>
        </div>
      </div>
    </form>
  </div>
</body>