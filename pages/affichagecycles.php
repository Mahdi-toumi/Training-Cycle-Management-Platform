<?php
require_once("../connexion.php");

$theme = isset($_GET['theme']) ? $_GET['theme'] : "";
$date_deb = isset($_GET['date_deb']) ? $_GET['date_deb'] : "";
$num_salle = isset($_GET['num_salle']) ? $_GET['num_salle'] : "";

$size = isset($_GET['size']) ? $_GET['size'] : 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

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
$resultat = $conn->query($requete);


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




$resultatcount = $conn->query($requetecount);

$tabCount = $resultatcount->fetch_assoc();
$nbrcycles = $tabCount['countC'];

if ($nbrcycles % $size == 0) {
    $nbrpage = $nbrcycles / $size;
} else  $nbrpage = floor($nbrcycles / $size) + 1; //floor() -> partie entiere 

if (!isset($_SESSION['admin'])) {
    if (isset($_SESSION['erreurinscription']))
        $erreurinscription = $_SESSION['erreurinscription'];
    else {
        $erreurinscription = "";
    }
}

if (!isset($_SESSION['admin'])) {
    if (isset($_SESSION['inscription']))
        $inscription = $_SESSION['inscription'];
    else {
        $inscription = "";
    }
}

if (isset($_SESSION['erreurinscription'])) {
    $erreurinscription = $_SESSION['erreurinscription'];
    unset($_SESSION['erreurinscription']);
} else {
    $erreurinscription = "";
}


if (!isset($_SESSION['admin']))  session_destroy();

?>
<div class="container">

    <div class="panel panel-success margetop">
        <div class="panel-heading" id="cycles">
            Recherche des cycles ...
        </div>
        <div class="panel-body">
            <form method="get" action="cycles.php" class="form-inline">
                <div class="form-group">
                    <input type="text" name="theme" id="theme" placeholder="Taper le thème" class="form-control">
                    <label for="date_deb">Date debut : </label>
                    <input type="date" name="date_deb" id="date_deb" class="form-control">
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <input type="number" name="num_salle" id="num_salle" placeholder="N° salle" class="form-control" min="1" max="100">
                    <?php } ?>
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span>Chercher...</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <?php if (isset($_SESSION['admin'])) { ?>
                    <a href="nouveaucycle.php">

                        <span class="glyphicon glyphicon-plus"></span>

                        Nouveau cycle

                    </a>
                <?php } ?>
            </form>
        </div>
    </div>

    <div class="panel panel-primary ">
        <div class="panel-heading">
            Liste des cycles (<?php echo $nbrcycles; ?> cycles)
        </div>
        <div class="panel-body" id="panel">
            <?php if (!empty($inscription)) { ?>
                <div class="alert alert-success">
                    <?php echo $inscription ?>
                </div>
            <?php } ?>
            <?php if (!empty($erreurinscription)) { ?>
                            <div class="alert alert-danger">
                                <?php echo $erreurinscription ?>
                            </div>
                        <?php } ?>
            <table class="table table-striped table-bordered centred">
                <thead>
                    <tr>
                        <?php if (isset($_SESSION['admin'])) { ?>
                            <th>Id cycle</th>
                        <?php  } ?>
                        <th>Thème de formation</th>
                        <th>Date debut</th>
                        <th>Date fin</th>
                        <?php if (isset($_SESSION['admin'])) { ?>
                            <th>Nbr participants</th>
                        <?php } ?>
                        <?php if (isset($_SESSION['admin'])) { ?>
                            <th>Num salle</th>
                        <?php  } ?>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($cycles = $resultat->fetch_assoc()) { ?>
                        <tr>
                            <?php if (isset($_SESSION['admin'])) { ?>
                                <td><?php echo $cycles['id'] ?></td>
                            <?php } ?>
                            <td><?php echo $cycles['theme'] ?></td>
                            <td><?php echo $cycles['date_deb'] ?></td>
                            <td><?php echo $cycles['date_fin'] ?></td>
                            <?php if (isset($_SESSION['admin'])) {
                                $id = $cycles['id'];
                                $requetec = "SELECT count(*) countC FROM participants WHERE id_cycle = '$id'";
                                $resultatc = $conn->query($requetec);
                                $tabCount = $resultatc->fetch_assoc();
                                $nbrparticipants = $tabCount['countC'];
                            ?>
                                <td><?php echo $nbrparticipants ?></td>
                            <?php } ?>
                            <?php if (isset($_SESSION['admin'])) { ?>
                                <td><?php echo $cycles['num_salle'] ?></td>
                            <?php } ?>
                            <td><a href="affichercycle.php?id=<?php echo $cycles['id']  ?>">
                                    <span class="glyphicon glyphicon-list-alt"></span> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <?php if (isset($_SESSION['admin'])) { ?>
                                    <a href="modifiercycle.php?id=<?php echo $cycles['id']  ?>"> <span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a onclick="return confirm('Etes vous sur de vouloir supprimer le cycle')" href="supprimercycle.php?id=<?php echo $cycles['id']  ?>"> <span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="feuillepresence.php?id=<?php echo $cycles['id']  ?>"> <span class="glyphicon glyphicon-print"></span></a>
                                <?php } ?>
                                <?php if (!isset($_SESSION['admin'])) { ?>
                                    <a href="inscrire.php?id=<?php echo $cycles['id']  ?>"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;S'inscrire</a>
                                <?php } ?>

                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
            <div>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $nbrpage; $i++) { ?>
                        <li class="<?php if ($i == $page) echo 'active'  ?>">
                            <a href="first.php?page=<?php echo $i; ?>&theme=<?php echo $theme; ?>&date_deb=<?php echo $date_deb; ?>&num_salle=<?php echo $num_salle; ?>#cycles">
                                <?php echo 'Page ' . $i; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</div>