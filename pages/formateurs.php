<?php 
        include ("../connexion.php") ;
    
    
        $specialite = isset($_GET['specialite'] ) ? $_GET['specialite'] : "" ; 
        $direction = isset($_GET['direction'] ) ? $_GET['direction'] : "" ; 
    
        $size=isset($_GET['size'])?$_GET['size']:5;
        $page=isset($_GET['page'])?$_GET['page']:1;
        $offset=($page-1)*$size;
    
        $requete = "SELECT * FROM formateurs WHERE 1=1";
        if ($specialite != "") {
            $requete .= " AND specialite LIKE '%$specialite%'";
        }
    
        if ($direction != "") {
            $requete .= " AND direction = '$direction'";
        }
    
     
        $requete .= " limit $size 
                      offset $offset";
        $resultat=$conn->query($requete) ;
    
    
        $requetecount = "SELECT count(*) countC FROM formateurs WHERE 1=1";
    
        if ($specialite != "") {
            $requetecount .= " AND specialite LIKE '%$specialite%'";
        }
    
        if ($direction != "") {
            $requetecount .= " AND direction = '$direction'";
        }
    
       
    
        
    
        $resultatcount=$conn->query($requetecount) ;
        
        $tabCount=$resultatcount->fetch_assoc();
        $nbrformateurs = $tabCount['countC'] ;
    
        if ($nbrformateurs % $size == 0){
            $nbrpage = $nbrformateurs / $size  ;
        }
        else  $nbrpage = floor ($nbrformateurs / $size)+1 ; //floor() -> partie entiere 
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formateurs</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <?php include("menu.php"); ?>
    <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">
                Chercher des formateurs ...
            </div>
            <div class="panel-body">
                <form method="get" action="formateurs.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="specialite" id="specialite" placeholder="Taper la specialite" class="form-control" > &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="direction" id="direction" placeholder="Taper la direction" class="form-control"> &nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span> Chercher...
                        </button> &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <a href="nouveauformateur.php">
                            
                                <span class="glyphicon glyphicon-plus"></span>
                                
                                Nouveau formateur
                                
                            </a>
                </form>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                Liste des formateurs (<?php echo $nbrformateurs; ?> participants)
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id formateur</th>
                            <th>Nom & Prenom</th>
                            <th>Direction </th>
                            <th>Specialite</th> <th></th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($participant = $resultat->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $participant['id']; ?></td>
                                <td><?php echo $participant['nom'] . " " . $participant['prenom']; ?></td>
                                <td><?php echo $participant['direction']; ?></td>
                                <td><?php echo $participant['specialite']; ?></td>
                                <td>
                                         <a href="modifierformateur.php?id=<?php echo $cycles['id']  ?>"> <span class="glyphicon glyphicon-edit"></span>Modifier</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                         <a onclick= "return confirm('Etes vous sur de vouloir supprimer le formateur')" href="supprimerformateur.php?id=<?php echo $cycles['id']  ?>"> <span class="glyphicon glyphicon-trash"></span>Supprimer</a>
                                    </td> 
                                </tr>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div>
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $nbrpage; $i++) { ?>
                            <li class="<?php if ($i == $page) echo 'active'; ?>">
                                <a href="formateurs.php?page=<?php echo $i; ?>&specialite=<?php echo $specialite; ?>&direction=<?php echo $direction; ?>">
                                    <?php echo 'Page ' . $i; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
