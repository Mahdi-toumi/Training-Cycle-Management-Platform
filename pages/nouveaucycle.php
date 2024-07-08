<?php
session_start();
require_once('../connexion.php');

// Fetching formateurs from the database
$requetef = "SELECT * FROM formateurs";
$resultatf = $conn->query($requetef);

// Checking for admin session
if (isset($_SESSION['admin'])) {
    // Handling session messages for errors
    $erreurdispoformateur = $_SESSION['dispoformateur'] ?? "";
    $erreuredate = $_SESSION['erreuredate'] ?? "";
    $erreureheure = $_SESSION['erreureheure'] ?? "";
    $erreurepause = $_SESSION['erreurepause'] ?? "";
    $erreuresalle = $_SESSION['erreuresalle'] ?? "";

    // Unsetting session variables after use
    unset($_SESSION['dispoformateur']);
    unset($_SESSION['erreuredate']);
    unset($_SESSION['erreureheure']);
    unset($_SESSION['erreurepause']);
    unset($_SESSION['erreuresalle']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau cycle</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <?php include("menu.php"); ?>
    <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">
                Veuillez saisir les données du nouveau cycle
            </div>
            <div class="panel-body">
                <form method="post" action="insertcycle.php" class="form-inline">
                    <div class="form-group">
                        <label for="num_action">N° action :</label>
                        <input type="text" id="num_action" name="num_action" class="form-control margeright" required><br><br>

                        <label for="entreprise">Entreprise :</label>
                        <input type="text" id="entreprise" name="entreprise" class="form-control margeright" value="Centre National de l'Informatique" required>

                        <label for="theme">Thème de formation:</label>
                        <input type="text" id="theme" name="theme" class="form-control margeright" required>

                        <label for="mode">Mode de formation :</label>
                        <input type="text" id="mode" name="mode" class="form-control" required><br><br>

                        <label for="lieu">Lieu de déroulement :</label>
                        <input type="text" id="lieu" name="lieu" class="form-control margeright" value="cni" required>

                        <label for="gouvernorat">Gouvernorat :</label>
                        <input type="text" id="gouvernorat" name="gouvernorat" class="form-control margeright" value="Tunis" required><br><br><br>

                        <label for="credit_impot">Crédit d'impôt :</label>
                        <input type="checkbox" id="credit_impot" name="credit_impot" class="custom-checkbox">

                        <label for="droit_tirage_i" class="margeleft">Droit tirage (individuel) :</label>
                        <input type="radio" id="droit_tirage_i" name="droit_tirage" class="custom-checkbox" value="1" required>

                        <label for="droit_tirage_c" class="margeleft">Droit tirage (collectif) :</label>
                        <input type="radio" id="droit_tirage_c" name="droit_tirage" class="custom-checkbox" value="0" required><br><br><br>

                        <?php if (!empty($erreuredate)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreuredate ?>
                            </div>
                        <?php } ?>

                        <label for="date_deb">Date début :</label>
                        <input type="date" id="date_deb" name="date_deb" class="form-control margeright" required>

                        <label for="date_fin">Date fin :</label>
                        <input type="date" id="date_fin" name="date_fin" class="form-control margeright" required><br><br>

                        <?php if (!empty($erreureheure)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreureheure ?>
                            </div>
                        <?php } ?>

                        <label for="heure_deb">Heure début :</label>
                        <input type="time" id="heure_deb" name="heure_deb" class="form-control margeright" required>

                        <label for="heure_fin">Heure fin :</label>
                        <input type="time" id="heure_fin" name="heure_fin" class="form-control margeright" required><br><br>

                        <?php if (!empty($erreurepause)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreurepause ?>
                            </div>
                        <?php } ?>

                        <label for="pause_deb">Pause début :</label>
                        <input type="time" id="pause_deb" name="pause_deb" class="form-control margeright" required>

                        <label for="pause_fin">Pause fin :</label>
                        <input type="time" id="pause_fin" name="pause_fin" class="form-control margeright" required><br><br>

                        <?php if (!empty($erreuresalle)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreuresalle ?>
                            </div>
                        <?php } ?>

                        <label for="num_salle">Numéro salle :</label>
                        <input type="number" name="num_salle" id="num_salle" class="form-control" min="1" max="10"><br><br><br>

                        <?php if (!empty($erreurdispoformateur)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreurdispoformateur ?>
                            </div>
                        <?php } ?>

                        <label for="formateur">Formateur :</label>
                        <select name="id_formateur" id="id_formateur" class="form-control" required>
                            <?php while ($formateur = $resultatf->fetch_assoc()) { ?>
                                <option value="<?php echo $formateur['id']; ?>">
                                    <?php echo $formateur['nom'] . ' ' . $formateur['prenom'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <br><br><br>
                        <button type="button" class="btn btn-primary" onclick="window.history.back();">
                            <span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Retour
                        </button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>&nbsp;&nbsp;Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>