<?php
session_start();
$id = isset($_GET['id']) ? $_GET['id'] : 0;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'iscrire</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <?php include("menu.php"); ?>
    <div class="container">

        <div class="panel panel-primary margetop">
            <div class="panel-heading">
                Veuillez saisir Vos données 
            </div>
            <div class="panel-body">

                <form method="post" action="insertparticipant.php" class="form">
                    <div class="form-group">
                        <br>
                        <label for="num_action">CIN :</label>
                        <input type="text" id="cin" name="cin" class="form-control margeright" required>

                        <label for="num_action">Nom :</label>
                        <input type="text" id="nom" name="nom" class="form-control margeright" required>

                        <label for="entreprise">Prenom :</label>
                        <input type="text" id="prenom" name="prenom" class="form-control margeright" required><br><br>

                        <label for="theme">Direction / Service : </label>
                        <input type="text" id="direction" name="direction" class="form-control margeright" required>

                        <label for="mode">Entreprise :</label>
                        <input type="text" id="entreprise" name="entreprise" class="form-control " required><br><br>
                        <br>
                        <input type="hidden" id="id" name="id" class="form-control margeright" value="<?php echo $id ?>" required>

                        <br>

                        <button class="btn btn-primary" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Retour</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-success "><span class="glyphicon glyphicon-save"></span>&nbsp;&nbsp;Enregistrer</button>



                    </div>

                </form>

            </div>
        </div>

    </div>
</body>

</html>