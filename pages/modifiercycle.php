<?php 
    session_start();
    
    if (isset($_SESSION['admin'])) {
        include ("../connexion.php") ;
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $requete = "SELECT * FROM cycles where id='$id' " ; 
        $res = $conn -> query($requete) ;
        if ($cycle = $res->fetch_assoc()) {

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

            $requetef="select * from formateurs ";
            $resultatf=$conn->query($requetef);



            if (isset($_SESSION['dispoformateur'])){
                $erreurdispoformateur = $_SESSION['dispoformateur'];
                unset($_SESSION['dispoformateur']);}
            else {
                    $erreurdispoformateur = "";
            }

            if (isset($_SESSION['erreuredate'])){
                    $erreuredate = $_SESSION['erreuredate'];
                    unset($_SESSION['erreuredate']);}
            else {
                    $erreuredate = "";
            }

            if (isset($_SESSION['erreureheure'])){
                $erreureheure = $_SESSION['erreureheure'];
                unset($_SESSION['erreureheure']);}
            else {
                    $erreureheure = "";
            }

            if (isset($_SESSION['erreurepause'])){
                $erreurepause = $_SESSION['erreurepause'];
                unset($_SESSION['erreurepause']);}
            else {
                    $erreurepause = "";
            }

            if (isset($_SESSION['erreuresalle'])){
                $erreuresalle = $_SESSION['erreuresalle'];
                unset($_SESSION['erreuresalle']);}
            else {
                    $erreurepause = "";
            }
              



        }
    }
    else {
        header('login.php') ;
    }

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un cycle</title>
    <link rel="stylesheet" type = "text/css" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" type = "text/css" href="../css/style.css" >
</head>
<body>
    <?php include("menu.php") ; ?>
    <div class="container">

        <div class="panel panel-primary margetop">
            <div class="panel-heading">
            Modification du cycle
            </div>
            <div class="panel-body">

                <form method="post" action="updatecycle.php"  class="form-inline">
                    <div class="form-group">
                        <br>
                        <input type="hidden" id="id" name="id" class="form-control margeright" value="<?php echo $id ?>" required>
                        <label for="num_action">N° action :</label>
                        <input type="text" id="num_action" name="num_action" class="form-control margeright" value="<?php echo $num_action ?>" required> <br><br>
                        
                        <label for="entreprise">Entreprise :</label>
                        <input type="text" id="entreprise" name="entreprise" class="form-control margeright" value="<?php echo $entreprise ?>" required>
                        
                        <label for="theme">Thème de formation:</label>
                        <input type="text" id="theme" name="theme" class="form-control margeright" value="<?php echo $theme ?>" required>
                        
                        <label for="mode">Mode de formation :</label>
                        <input type="text" id="mode" name="mode" class="form-control " value="<?php echo $mode ?>" required><br><br>
                        
                        <label for="lieu">Lieu de deroulement :</label>
                        <input type="text" id="lieu" name="lieu" class="form-control margeright" value="<?php echo $lieu ?>" required>
                        
                        <label for="gouvernorat">Gouvernorat :</label>
                        <input type="text" id="gouvernorat" name="gouvernorat" class="form-control margeright" value="<?php echo $gouvernorat ?>" required> <br><br><br>
                        
                        <label for="credit_impot">Crédit d'impôt :</label>
                        <input type="checkbox" id="credit_impot" name="credit_impot" class="custom-checkbox" <?php if($credit_impot=="1") echo "checked" ?> >
                        
                        <label for="droit_tirage_i" class="margeleft">Droit tirage (individuel) :</label>
                        <input type="radio" id="droit_tirage_i" name="droit_tirage" class="custom-checkbox" value="1" <?php if($droit_tirage=="1") echo "checked" ?> required>
                        
                        <label for="droit_tirage_c" class="margeleft">Droit tirage (collectif) :</label>
                        <input type="radio" id="droit_tirage_c" name="droit_tirage" class="custom-checkbox" value="0"  <?php if($droit_tirage=="0") echo "checked" ?> required><br><br><br>
                        
                        <?php if (!empty($erreuredate)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreuredate ?>
                            </div>
                        <?php } ?>

                        <label for="date_deb">Date début :</label>
                        <input type="date" id="date_deb" name="date_deb" class="form-control margeright" value="<?php echo $date_deb ?>" required>
                        
                        <label for="date_fin">Date fin :</label>
                        <input type="date" id="date_fin" name="date_fin" class="form-control margeright" value="<?php echo $date_fin ?>" required><br><br>
                        
                        <?php if (!empty($erreureheure)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreureheure ?>
                            </div>
                        <?php } ?>

                        <label for="heure_deb">Heure début :</label>
                        <input type="time" id="heure_deb" name="heure_deb" class="form-control margeright" value="<?php echo $heure_deb ?>" required>
                        
                        <label for="heure_fin">Heure fin :</label>
                        <input type="time" id="heure_fin" name="heure_fin" class="form-control margeright" value="<?php echo $heure_fin ?>" required><br><br>
                        
                        <?php if (!empty($erreurepause)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreurepause ?>
                            </div>
                        <?php } ?>

                        <label for="pause_deb">Pause début :</label>
                        <input type="time" id="pause_deb" name="pause_deb" class="form-control margeright" value="<?php echo $pause_deb ?>" required>
                        
                        <label for="pause_fin">Pause fin :</label>
                        <input type="time" id="pause_fin" name="pause_fin" class="form-control margeright" value="<?php echo $pause_fin ?>" required><br><br>
                        
                        <?php if (!empty($erreuresalle)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreuresalle ?>
                            </div>
                        <?php } ?>

                        <label for="num_salle">Numéro salle :</label>
                        <input type="number" name="num_salle" id="num_salle" class="form-control" value="<?php echo $num_salle ?>"  min="1" max="100" ><br><br><br>
                        <?php if (!empty($erreurdispoformateur)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreurdispoformateur ?>
                            </div>
                        <?php } ?>    
                            
                        <label for="formateur">Formateur :</label>
                        <select name="id_formateur" id="id_formateur" class="form-control" required>
                            <?php while($formateur = $resultatf->fetch_assoc()) { ?>
                                <option value="<?php echo $formateur['id']; ?>" <?php if($formateur['id'] == $id_formateur) echo "selected"; ?>>
                                    <?php echo $formateur['nom'] . ' ' . $formateur['prenom']; ?>
                                </option>
                            <?php } ?>
                        </select>
                            

                        
                        <br><br><br>
                        
                        
                        <button type="buton" class="btn btn-primary" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Retour</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-success "><span class="glyphicon glyphicon-save"></span>&nbsp;&nbsp;Enregistrer</button>

                    </div>
                            
                </form>

            </div>
        </div>

    </div>
</body>
</html>