<script>
function startTime() {
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('kello').innerHTML = h+":"+m+":"+s;
    var t = setTimeout(function(){startTime()},500);
}

function checkTime(i) {
    if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link rel="icon" href="img/favicon.ico" type="image/icon">
		

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Hiihtokisojen tulospalvelu</title>
    </head>
    <body onload="startTime()">
	<div class="container">
	            <?php if (!empty($_SESSION['ilmoitus'])): ?>
            <div class="alert alert-success">
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
