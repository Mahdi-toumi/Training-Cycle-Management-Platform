<?php
session_start();

if (isset($_SESSION['admin'])) {
    require_once("../connexion.php");
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    $requeteparticipant = "SELECT count(*) countC FROM participants WHERE id_cycle = '$id'";
    $resultatcount = $conn->query($requeteparticipant);
    $tabCount = $resultatcount->fetch_assoc();
    $nbrparticipants = $tabCount['countC'];
    if ($nbrparticipants == 0) {
        $requete = "delete from cycles where id=?";
        $params = array($id);

        $resultat = $conn->prepare($requete);
        $resultat->execute($params);

        header('Location: cycles.php');
        exit();
    } else {
        $requeteparticipants = "delete from participants where id_cycle=?";
        $params = array($id);
        $resultatparticipants = $conn->prepare($requeteparticipants);
        $resultatparticipants->execute($params);

        $requete = "delete from cycles where id=?";


        $resultat = $conn->prepare($requete);
        $resultat->execute($params);

        header('Location: cycles.php');
        exit();
    }
} else {
    header('login.php');
}
