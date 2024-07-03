<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau cycle</title>
    <link rel="stylesheet" type = "text/css" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" type = "text/css" href="../css/style.css" >
</head>
<body>
    <?php include("menu.php") ; ?>
    <div class="container">

        <div class="panel panel-primary margetop">
            <div class="panel-heading">
                Veuillez saisir les données du nouvaeu cycle
            </div>
            <div class="panel-body">

                <form method="post" action="insertcycle.php"  class="form-inline">
                    <div class="form-group">
                        <br>
                        <label for="num_action">N° action :</label>
                        <input type="text" id="num_action" name="num_action" class="form-control margeright" required> <br><br>
                        
                        <label for="entreprise">Entreprise :</label>
                        <input type="text" id="entreprise" name="entreprise" class="form-control margeright" value="Centre National de l'Informatique" required>
                        
                        <label for="theme">Thème de formation:</label>
                        <input type="text" id="theme" name="theme" class="form-control margeright" required>
                        
                        <label for="mode">Mode de formation :</label>
                        <input type="text" id="mode" name="mode" class="form-control " required><br><br>
                        
                        <label for="lieu">Lieu de deroulement :</label>
                        <input type="text" id="lieu" name="lieu" class="form-control margeright" value="cni" required>
                        
                        <label for="gouvernorat">Gouvernorat :</label>
                        <input type="text" id="gouvernorat" name="gouvernorat" class="form-control margeright" value="Tunis" required> <br><br><br>
                        
                        <label for="credit_impot" >Crédit d'impôt :</label>
                        <input type="checkbox" id="credit_impot" name="credit_impot" class="custom-checkbox" >
                        
                        <label for="droit_tirage_i" class="margeleft">Droit tirage (individuel) :</label>
                        <input type="radio" id="droit_tirage_i" name="droit_tirage" class="custom-checkbox" value="1" required>
                        
                        <label for="droit_tirage_c" class="margeleft">Droit tirage (collectif) :</label>
                        <input type="radio" id="droit_tirage_c" name="droit_tirage" class="custom-checkbox" value="0" required><br><br><br>
                        
                        <label for="date_deb">Date début :</label>
                        <input type="date" id="date_deb" name="date_deb" class="form-control margeright" required>
                        
                        <label for="date_fin">Date fin :</label>
                        <input type="date" id="date_fin" name="date_fin" class="form-control margeright" required><br><br>
                        
                        <label for="heure_deb">Heure début :</label>
                        <input type="time" id="heure_deb" name="heure_deb" class="form-control margeright" required>
                        
                        <label for="heure_fin">Heure fin :</label>
                        <input type="time" id="heure_fin" name="heure_fin" class="form-control margeright" required><br><br>
                        
                        <label for="pause_deb">Pause début :</label>
                        <input type="time" id="pause_deb" name="pause_deb" class="form-control margeright" required>
                        
                        <label for="pause_fin">Pause fin :</label>
                        <input type="time" id="pause_fin" name="pause_fin" class="form-control margeright" required><br><br>
                        
                        <label for="num_salle">Numéro salle :</label>
                        <input type="number" name="num_salle" id="num_salle" class="form-control"  min="1" max="100" ><br><br><br>
                        
                        
                        <button class="btn btn-primary" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Retour</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-success "><span class="glyphicon glyphicon-save"></span>&nbsp;&nbsp;Enregistrer</button>
                    </div>
                            
                </form>

            </div>
        </div>

    </div>
</body>
</html>