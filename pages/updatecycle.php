<?php
session_start();

if (isset($_SESSION['admin'])) {
    require_once("../connexion.php");
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $num_action = isset($_POST['num_action']) ? $_POST['num_action'] : "";
    $entreprise = isset($_POST['entreprise']) ? $_POST['entreprise'] : "";
    $theme = isset($_POST['theme']) ? $_POST['theme'] : "";
    $mode = isset($_POST['mode']) ? $_POST['mode'] : "";
    $lieu = isset($_POST['lieu']) ? $_POST['lieu'] : "";
    $gouvernorat = isset($_POST['gouvernorat']) ? $_POST['gouvernorat'] : "";
    $credit_impot = isset($_POST['credit_impot']) ? 1 : 0;
    $droit_tirage = isset($_POST['droit_tirage']) ? $_POST['droit_tirage'] : "";
    $date_deb = isset($_POST['date_deb']) ? $_POST['date_deb'] : "";
    $date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : "";
    $heure_deb = isset($_POST['heure_deb']) ? $_POST['heure_deb'] : "";
    $heure_fin = isset($_POST['heure_fin']) ? $_POST['heure_fin'] : "";
    $pause_deb = isset($_POST['pause_deb']) ? $_POST['pause_deb'] : "";
    $pause_fin = isset($_POST['pause_fin']) ? $_POST['pause_fin'] : "";
    $num_salle = isset($_POST['num_salle']) ? $_POST['num_salle'] : "";

    $errors = [];

    if (strtotime($date_deb) >= strtotime($date_fin)) {
        $_SESSION['erreuredate'] = "<strong>Erreur</strong> La date de début doit être antérieure à la date de fin.!!!";
        header('Location: modifiercycle.php?id=' . $id);
        exit();
    }

    if (strtotime($heure_deb) >= strtotime($heure_fin)) {
        $_SESSION['erreureheure'] = "<strong>Erreur</strong> L'heure de début doit être antérieure à l'heure de fin . !!!";
        header('Location: modifiercycle.php?id=' . $id);
        exit();
    }

    if (strtotime($pause_deb) <= strtotime($heure_deb) or strtotime($pause_fin) >= strtotime($heure_fin)) {
        $_SESSION['erreurepause'] = "<strong>Erreur</strong> La pause doit être entre l'heure de début et l'heure de fin. !!!";
        header('Location: modifiercycle.php?id=' . $id);
        exit();
    }

    if (strtotime($pause_deb) >= strtotime($pause_fin)) {
        $_SESSION['erreurepause'] = "<strong>Erreur</strong> L'heure de début de la pause doit être antérieure à l'heure de fin de la pause. !!!";
        header('Location: modifiercycle.php?id=' . $id);
        exit();
    }

    if (empty($errors)) {
        $requetecount = "SELECT count(*) countC FROM cycles WHERE id_formateur = '$id_formateur' AND 
                                ((date_deb <= '$date_fin' AND date_fin >= '$date_deb') OR 
                                (date_deb <= '$date_fin' AND date_fin >= '$date_deb')) ";
        $resultatcount = $conn->query($requetecount);
        $tabCount = $resultatcount->fetch_assoc();
        $nbrcycles = $tabCount['countC'];

        $requetecountsalle = "SELECT count(*) countC FROM cycles WHERE num_salle = '$num_salle' AND 
                            ((date_deb <= '$date_fin' AND date_fin >= '$date_deb') OR 
                                (date_deb <= '$date_fin' AND date_fin >= '$date_deb')) AND
                                ((heure_deb <= '$heure_fin' AND heure_fin >= '$heure_deb'))";

        $resultatcountsalle = $conn->query($requetecountsalle);
        $tabCountsalle = $resultatcountsalle->fetch_assoc();
        $nbsalle = $tabCountsalle['countC'];


        if ($nbrcycles == 0 and $nbsalle == 0) {

            $requete = "update cycles set num_action=?, entreprise=?, theme=?, mode=?, lieu=?, gouvernorat=?, credit_impot=?, droit_tirage=?, date_deb=?, date_fin=?, heure_deb=?, heure_fin=?, pause_deb=?, pause_fin=?, num_salle=? where id=?";
            $params = array($num_action, $entreprise, $theme, $mode, $lieu, $gouvernorat, $credit_impot, $droit_tirage, $date_deb, $date_fin, $heure_deb, $heure_fin, $pause_deb, $pause_fin, $num_salle, $id);

            $resultat = $conn->prepare($requete);
            $resultat->execute($params);

            header('Location: cycles.php');
            exit();
        } else if ($nbrcycles != 0) {
            $_SESSION['dispoformateur'] = "<strong>Erreur</strong> Le formateur est déjà affecté à un cycle pendant cette période!!!";
            header('Location: nouveaucycle.php#id_formateur');
            exit();
        } else if ($nbsalle != 0) {
            $_SESSION['erreuresalle'] = "<strong>Erreur</strong> La salle est déjà réservé pendant cette période!!!";
            header('Location: nouveaucycle.php#num_salle');
            exit();
        }
    }
} else {
    header('login.php');
}
