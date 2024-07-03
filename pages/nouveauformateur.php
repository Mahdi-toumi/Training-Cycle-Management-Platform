<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau formateur</title>
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

                <form method="post" action="insertformateur.php"  class="form-inline">
                    <div class="form-group">
                        <br>
                        <label for="num_action">Nom :</label>
                        <input type="text" id="nom" name="nom" class="form-control margeright" required> 
                        
                        <label for="entreprise">Prenom :</label>
                        <input type="text" id="prenom" name="prenom" class="form-control margeright" required><br><br>
                        
                        <label for="theme">Direction : </label>
                        <input type="text" id="direction" name="direction" class="form-control margeright" required>
                        
                        <label for="mode">Specialite :</label>
                        <input type="text" id="specialite" name="specialite" class="form-control " required><br><br>
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