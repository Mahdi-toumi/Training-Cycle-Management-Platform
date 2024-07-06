<?php 
    session_start();
    
    if (isset($_SESSION['admin'])) {
            include ("../connexion.php") ;
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

            
            $requete = "update cycles set num_action=?, entreprise=?, theme=?, mode=?, lieu=?, gouvernorat=?, credit_impot=?, droit_tirage=?, date_deb=?, date_fin=?, heure_deb=?, heure_fin=?, pause_deb=?, pause_fin=?, num_salle=? where id=?";
            $params = array($num_action, $entreprise, $theme, $mode, $lieu, $gouvernorat, $credit_impot, $droit_tirage, $date_deb, $date_fin, $heure_deb, $heure_fin, $pause_deb, $pause_fin, $num_salle ,$id);

            $resultat = $conn->prepare($requete);
            $resultat->execute($params);

            header('Location: cycles.php');
            exit();
    
    }
    else {
        header('login.php') ;
    }

?>