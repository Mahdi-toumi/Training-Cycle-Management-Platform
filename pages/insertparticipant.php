<?php
session_start();
if (!isset($_SESSION['admin'])) {
    require_once("../connexion.php");
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $cin = isset($_POST['cin']) ? $_POST['cin'] : "";
    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    $direction = isset($_POST['direction']) ? $_POST['direction'] : "";
    $entreprise = isset($_POST['entreprise']) ? $_POST['entreprise'] : "";

    $requete = "SELECT * FROM participants WHERE cin = '$cin' AND nom = '$nom' AND prenom = '$prenom' ";
    $resultat = $conn->query($requete);
    $participants = $resultat->fetch_assoc();

    $requetedate = "SELECT * FROM cycles WHERE id = '$id' ";
    $resultatdate = $conn->query($requetedate);
    $cyc = $resultatdate->fetch_assoc();
    $date_fin = $cyc['date_fin'];
    $date_deb = $cyc['date_deb'];

    $requeteverif = "SELECT * FROM participants p 
                        JOIN cycles c ON p.id_cycle = c.id 
                        WHERE p.cin = '$cin' 
                        AND c.date_deb <= '$date_fin' 
                        AND c.date_fin >= '$date_deb'";
    $resultverif = $conn->query($requeteverif);
    if ( $tab = $resultverif->fetch_assoc()) {$datef=$tab['c.date_fin'] ; }else {$datef = $date_fin ;}
    
    $today = date('Y-m-d');

    if ($today<=$datef or $participants['id_cycle'] == $id) {
        $_SESSION['erreurinscription'] = "<strong>Erreur</strong> Vous êtes actuellement inscrit à un cycle pendant cette période!";
        header('Location: first.php#panel');
        exit();
    } elseif ($participants) {
        $requeteupdate = "UPDATE participants set cin=?, nom=?, prenom=?, direction=?, entreprise=? , id_cycle=? WHERE cin = '$cin' AND nom = '$nom' AND prenom = '$prenom'";
        $params = array($cin, $nom, $prenom, $direction, $entreprise, $id);
        $resultatipdate = $conn->prepare($requeteupdate);
        $resultatipdate->execute($params);
        $_SESSION['inscription'] = " Inscription réussie !!!";
        header('Location: ../index.php#panel');
        exit();
    } else {
        $requeteinsert = "INSERT INTO participants (cin, nom, prenom, direction, entreprise , id_cycle ) VALUES (?, ?, ?, ?, ?, ?)";
        $params = array($cin, $nom, $prenom, $direction, $entreprise, $id);
        $resultatinsert = $conn->prepare($requeteinsert);
        $resultatinsert->execute($params);
        $_SESSION['inscription'] = " Inscription réussie !!!";
        header('Location: ../index.php');
        exit();
    }
} else {
    $_SESSION['erreurinscription'] = "<strong>Erreur</strong> Vous etes un Admin!!!";
    header('location: ../index.php');
}
