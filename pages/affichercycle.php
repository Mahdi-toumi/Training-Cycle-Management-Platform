<?php
require_once("../connexion.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$requete = "SELECT * FROM cycles where id='$id' ";
$res = $conn->query($requete);
if ($cycle = $res->fetch_assoc()) {
    // Assign fetched data to variables
    $num_action = $cycle['num_action'];
    $entreprise = $cycle['entreprise'];
    $theme = $cycle['theme'];
    $mode = $cycle['mode'];
    $lieu = $cycle['lieu'];
    $gouvernorat = $cycle['gouvernorat'];
    $credit_impot = $cycle['credit_impot'];
    $droit_tirage = $cycle['droit_tirage'];
    $date_deb = $cycle['date_deb'];
    $date_fin = $cycle['date_fin'];
    $heure_deb = $cycle['heure_deb'];
    $heure_fin = $cycle['heure_fin'];
    $pause_deb = $cycle['pause_deb'];
    $pause_fin = $cycle['pause_fin'];
    $num_salle = $cycle['num_salle'];
    $id_formateur = $cycle['id_formateur'];

    $requetef = "select * from formateurs where id = '$id_formateur' ";
    $resultatf = $conn->query($requetef);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage du cycle</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <?php include("menu.php"); ?>
    <div class="container">

        <div class="panel panel-primary margetop">
            <div class="panel-heading">
                Affichage du cycle
            </div>
            <div class="panel-body">

                <form method="post" class="form-inline">
                    <div class="form-group">
                        <br>
                        <label for="num_action" class="info">N° action : <?php echo $num_action ?></label>
                        <input type="hidden" id="num_action" name="num_action" class="form-control margeright" value="<?php echo $num_action ?>" required> <br><br><br>

                        <label for="entreprise" class="info">Entreprise : <?php echo $entreprise ?></label>
                        <input type="hidden" id="entreprise" name="entreprise" class="form-control margeright" value="<?php echo $entreprise ?>" required>

                        <label for="theme" class="info">Thème de formation : <?php echo $theme ?></label>
                        <input type="hidden" id="theme" name="theme" class="form-control margeright" value="<?php echo $theme ?>" required>

                        <label for="mode" class="info">Mode de formation : <?php echo $mode ?></label>
                        <input type="hidden" id="mode" name="mode" class="form-control " value="<?php echo $mode ?>" required><br><br><br>

                        <label for="lieu" class="info">Lieu de deroulement : <?php echo $lieu ?></label>
                        <input type="hidden" id="lieu" name="lieu" class="form-control margeright" value="<?php echo $lieu ?>" required>

                        <label for="gouvernorat" class="info">Gouvernorat : <?php echo $gouvernorat ?></label>
                        <input type="hidden" id="gouvernorat" name="gouvernorat" class="form-control margeright" value="<?php echo $gouvernorat ?>" required> <br><br><br>

                        <label for="credit_impot" class="info-check">Crédit d'impôt :</label>
                        <input type="checkbox" id="credit_impot" name="credit_impot" class="custom-checkbox" <?php if ($credit_impot == "1") echo "checked" ?> disabled>

                        <label for="droit_tirage_i" class="margeleft info-check">Droit tirage (individuel) :</label>
                        <input type="checkbox" id="droit_tirage_i" name="droit_tirage" class="custom-checkbox" value="1" <?php if ($droit_tirage == "1") echo "checked" ?> disabled>

                        <label for="droit_tirage_c" class="margeleft info-check">Droit tirage (collectif) :</label>
                        <input type="checkbox" id="droit_tirage_c" name="droit_tirage" class="custom-checkbox" value="0" <?php if ($droit_tirage == "0") echo "checked" ?> disabled><br><br><br>

                        <label for="date_deb" class="info">Periode : du : <?php echo $date_deb ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Au : <?php echo $date_fin ?></label>
                        <input type="hidden" id="date_deb" name="date_deb" class="form-control margeright" value="<?php echo $date_deb ?>" required>

                        <input type="hidden" id="date_fin" name="date_fin" class="form-control margeright" value="<?php echo $date_fin ?>" required><br><br><br>

                        <label for="heure_deb" class="info">Horaire : de : <?php echo $heure_deb ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; à : <?php echo $heure_fin ?></label>
                        <input type="hidden" id="heure_deb" name="heure_deb" class="form-control margeright" value="<?php echo $heure_deb ?>" required>

                        <input type="hidden" id="heure_fin" name="heure_fin" class="form-control margeright" value="<?php echo $heure_fin ?>" required><br><br><br>

                        <label for="pause_deb" class="info">Pause : de : <?php echo $pause_deb ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;à : <?php echo $pause_fin ?></label>
                        <input type="hidden" id="pause_deb" name="pause_deb" class="form-control margeright" value="<?php echo $pause_deb ?>" required>

                        <input type="hidden" id="pause_fin" name="pause_fin" class="form-control margeright" value="<?php echo $pause_fin ?>" required><br><br><br>

                        <label for="num_salle" class="info">Numéro salle : <?php echo $num_salle ?></label>
                        <input type="hidden" name="num_salle" id="num_salle" class="form-control" value="<?php echo $num_salle ?>" min="1" max="100"><br><br><br>

                        <label class="info" for="formateur">Formateur :
                            <?php
                            if ($formateur = $resultatf->fetch_assoc()) {
                                echo $formateur['nom'] . ' ' . $formateur['prenom'];
                            } ?>
                        </label><br><br><br>



                        <button type="button" class="btn btn-primary" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Retour</button> &nbsp;&nbsp;
                        <?php if (!isset($_SESSION['admin'])) { ?>
                            <button class="btn btn-success"> <a style="color:white;" href="inscrire.php?id=<?php echo $cycle['id']  ?>"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;S'inscrire</a> </button>
                        <?php } ?>






                    </div>



            </div>
        </div>

    </div>
</body>

</html>