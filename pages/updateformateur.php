<?php 
    session_start() ;
    
    if (isset($_SESSION['user'])) {
        include ("../connexion.php") ;
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
        $specialite = isset($_POST['specialite']) ? $_POST['specialite'] : "";
        $direction = isset($_POST['direction']) ? $_POST['direction'] : "";
        

        
        $requete = "update formateurs set nom=?, prenom=?, specialite=?, direction=?  where id=?";
        $params = array($nom, $prenom, $specialite, $direction ,$id);

        $resultat = $conn->prepare($requete);
        $resultat->execute($params);

        header('Location: formateurs.php');
        exit();
    }
    else {
        header('login.php') ;
    }

?>