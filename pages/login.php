<?php
session_start();
if (isset($_SESSION['erreurLogin']))
    $erreurLogin = $_SESSION['erreurLogin'];
else {
    $erreurLogin = "";
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'authentifier</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 margtop">
    <div class="panel panel-primary margetop60">
        <div class="panel-heading">S'authentifier :</div>
        <div class="panel-body">
            <form method="post" action="seconnecter.php" class="form">

                <?php if (!empty($erreurLogin)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $erreurLogin ?>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label for="login">Login :</label>
                    <input type="text" name="login" placeholder="Login"
                           class="form-control" autocomplete="off"/>
                </div>

                <div class="form-group">
                    <label for="pwd">Mot de passe :</label>
                    <input type="password" name="pwd"
                           placeholder="Mot de passe" class="form-control"/>
                </div>

                <button class="btn btn-primary" ><a href="../index.php" style="color: white;"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Retour</a></button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-log-in"></span>
                    S'authentifier
                </button>

            </form>
        </div>
    </div>
</div>
</body>
</HTML>