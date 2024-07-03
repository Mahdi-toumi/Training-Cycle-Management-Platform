<?php 
    include ("../connexion.php") ;
    
    
    $theme = isset($_GET['theme'] ) ? $_GET['theme'] : "" ; 
    $date_deb = isset($_GET['date_deb'] ) ? $_GET['date_deb'] : "" ; 
    $num_salle = isset($_GET['num_salle'] ) ? $_GET['num_salle'] : "" ; 

    $size=isset($_GET['size'])?$_GET['size']:5;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;

    $requete = "SELECT * FROM cycles WHERE 1=1";
    if ($theme != "") {
        $requete .= " AND theme LIKE '%$theme%'";
    }

    if ($date_deb != "") {
        $requete .= " AND date_deb = '$date_deb'";
    }

    if ($num_salle != "") {
        $requete .= " AND num_salle = '$num_salle'";
    }
    $requete .= " limit $size 
                  offset $offset";
    $resultat=$conn->query($requete) ;


    $requetecount = "SELECT count(*) countC FROM cycles WHERE 1=1";

    if ($theme != "") {
        $requetecount .= " AND theme LIKE '%$theme%'";
    }

    if ($date_deb != "") {
        $requetecount .= " AND date_deb = '$date_deb'";
    }

    if ($num_salle != "") {
        $requetecount .= " AND num_salle = '$num_salle'";
    }

    

    $resultatcount=$conn->query($requetecount) ;
    
    $tabCount=$resultatcount->fetch_assoc();
    $nbrcycles = $tabCount['countC'] ;

    if ($nbrcycles % $size == 0){
        $nbrpage = $nbrcycles / $size  ;
    }
    else  $nbrpage = floor ($nbrcycles / $size)+1 ; //floor() -> partie entiere 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cycles</title>
    <link rel="stylesheet" type = "text/css" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" type = "text/css" href="../css/style.css" >
</head>
<body>
    <?php include("menu.php") ; ?>
    <div class="container">

        <div class="panel panel-success margetop">
            <div class="panel-heading">
                Recherche des cycles ...
            </div>
            <div class="panel-body">
                <form method="get" action="cycles.php"  class="form-inline">
                    <div class="form-group">
                        <input type="text" name="theme" id="theme" placeholder="Taper le thème" class="form-control">
                        <label for="date_deb">Date debut : </label>
                        <input type="date" name="date_deb" id="date_deb"class="form-control">
                        <input type="number" name="num_salle" id="num_salle" placeholder="N° salle" class="form-control"  min="1" max="100" >
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span>Chercher...</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <a href="nouveaucycle.php">
                            
                                <span class="glyphicon glyphicon-plus"></span>
                                
                                Nouveau cycle
                                
                            </a>
                </form>
            </div>
        </div>

        <div class="panel panel-primary ">
            <div class="panel-heading">
                Liste des cycles (<?php echo $nbrcycles ; ?> cycles)
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id cycle</th> <th>Thème de formation</th> <th>Date debut</th> <th>Date fin</th> <th>Num salle</th>  <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php while($cycles = $resultat->fetch_assoc()){ ?>
                                <tr>
                                   <td><?php echo $cycles['id']?></td> 
                                   <td><?php echo $cycles['theme']?></td> 
                                   <td><?php echo $cycles['date_deb']?></td> 
                                   <td><?php echo $cycles['date_fin']?></td> 
                                   <td><?php echo $cycles['num_salle']?></td>
                                   <td><a href="affichercycle.php?id=<?php echo $cycles['id']  ?>">
                                        <span class="glyphicon glyphicon-list-alt"></span>    Afficher  </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    
                                         <a href="modifiercycle.php?id=<?php echo $cycles['id']  ?>"> <span class="glyphicon glyphicon-edit"></span>Modifier</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                         <a onclick= "return confirm('Etes vous sur de vouloir supprimer le cycle')" href="supprimercycle.php?id=<?php echo $cycles['id']  ?>"> <span class="glyphicon glyphicon-trash"></span>Supprimer</a>
                                    </td> 
                                </tr>
                                   
                            <?php } ?>
                        

                    </tbody>
                </table>
                <div>
                    <ul class="pagination">
                        <?php for($i=1;$i<=$nbrpage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active'  ?>"> 
                                <a href="cycles.php?page=<?php echo $i;?>&theme=<?php echo $theme; ?>&date_deb=<?php echo $date_deb ;?>&num_salle=<?php echo $num_salle ;?>">
                                    <?php echo 'Page ' . $i; ?>
                                </a> 
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
  <!--  <script src="../js/script.js"></script> -->
</body>
</html>