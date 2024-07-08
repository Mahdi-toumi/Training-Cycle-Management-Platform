<?php
session_start();

if (isset($_SESSION['admin'])) {
    require_once("../connexion.php");
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $requete = "SELECT * FROM formateurs where id='$id' ";
    $res = $conn->query($requete);
    if ($formateur = $res->fetch_assoc()) {

        $nom = $formateur['nom'];
        $prenom = $formateur['prenom'];
        $specialite = $formateur['specialite'];
        $direction = $formateur['direction'];
    }
} else {
    header('login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un cycle</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <?php include("menu.php"); ?>
    <div class="container">

        <div class="panel panel-primary margetop">
            <div class="panel-heading">
                Modification du cycle
            </div>
            <div class="panel-body">

                <form method="post" action="updateformateur.php" class="form-inline">
                    <div class="form-group">
                        <br>
                        <input type="hidden" id="id" name="id" class="form-control margeright" value="<?php echo $id ?>" required>
                        <br>
                        <label for="num_action">Nom :</label>
                        <input type="text" id="nom" name="nom" class="form-control margeright" value="<?php echo $nom ?>" required>

                        <label for="entreprise">Prenom :</label>
                        <input type="text" id="prenom" name="prenom" class="form-control margeright" value="<?php echo $prenom ?>" required><br><br>

                        <label for="theme">Direction : </label>
                        <input type="text" id="direction" name="direction" class="form-control margeright" value="<?php echo $direction ?>" required>

                        <label for="mode">Specialite :</label>
                        <input type="text" id="specialite" name="specialite" class="form-control " value="<?php echo $specialite ?>" required><br><br>
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