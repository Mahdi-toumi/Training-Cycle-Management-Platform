<?php 
   session_start() ;
   if (!isset($_SESSION['admin']))  header ('location: ../index.php') ;
   include ("../connexion.php");

    $cin = isset($_GET['cin']) ? $_GET['cin'] : ""; 
    $theme = isset($_GET['theme']) ? $_GET['theme'] : ""; 

    $size = isset($_GET['size']) ? $_GET['size'] : 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $size;


    $requete = "SELECT participants.*, cycles.theme 
                FROM participants 
                LEFT JOIN cycles ON participants.id_cycle = cycles.id 
                WHERE 1=1";

    if ($cin != "") {
        $requete .= " AND participants.cin LIKE '%$cin%'";
    }

    if ($theme != "") {
        $requete .= " AND cycles.theme = '$theme'";
    }

    $requete .= " LIMIT $size OFFSET $offset";
    $resultat = $conn->query($requete);




    $requetecount = "SELECT COUNT(*) as countC 
                     FROM participants 
                     LEFT JOIN cycles ON participants.id_cycle = cycles.id 
                     WHERE 1=1";

    if ($cin != "") {
        $requetecount .= " AND cin LIKE '%$cin%'";
    }

    if ($theme != "") {
        $requetecount .= " AND cycles.theme = '$theme'";
    }

    $resultatcount = $conn->query($requetecount);
    $tabCount = $resultatcount->fetch_assoc();
    $nbrparticipant = $tabCount['countC'];

    $nbrpage = ceil($nbrparticipant / $size);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <?php include("menu.php"); ?>
    <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">
                Chercher des participants ...
            </div>
            <div class="panel-body">
                <form method="get" action="participants.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="cin" id="cin" placeholder="Taper le cin" class="form-control" value="<?php echo $cin; ?>">
                        <input type="text" name="theme" id="theme" placeholder="Taper le theme" class="form-control">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span> Chercher...
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                Liste des participants (<?php echo $nbrparticipant; ?> participants)
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id participant</th>
                            <th>Nom & Prenom</th>
                            <th>N°cin</th>
                            <th>Direction / service</th>
                            <th>Entreprise</th>
                            <th>Theme de formation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($participant = $resultat->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $participant['id']; ?></td>
                                <td><?php echo $participant['nom'] . " " . $participant['prenom']; ?></td>
                                <td><?php echo $participant['cin']; ?></td>
                                <td><?php echo $participant['direction']; ?></td>
                                <td><?php echo $participant['entreprise']; ?></td>
                                <td><?php echo $participant['theme']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div>
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $nbrpage; $i++) { ?>
                            <li class="<?php if ($i == $page) echo 'active'; ?>">
                                <a href="participants.php?page=<?php echo $i; ?>&cin=<?php echo $cin; ?>&theme=<?php echo $theme; ?>">
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
