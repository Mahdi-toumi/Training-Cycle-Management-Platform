<?php 
    session_start() ;
    if (isset($_SESSION['user'])) {
        include ("../connexion.php") ;
        $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
        $specialite = isset($_POST['specialite']) ? $_POST['specialite'] : "";
        $direction = isset($_POST['direction']) ? $_POST['direction'] : "";
    
        
        $requete = "INSERT INTO formateurs (nom, prenom, specialite, direction ) VALUES (?, ?, ?,?)";
        $params = array($nom, $prenom, $specialite, $direction );

        $resultat = $conn->prepare($requete);
        $resultat->execute($params);

        header('Location: cycles.php');
        exit();
    }
    else {
        header('login.php') ;
    }

?>