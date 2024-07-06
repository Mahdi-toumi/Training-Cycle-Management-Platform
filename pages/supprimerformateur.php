<?php 
    session_start();
    
    if (isset($_SESSION['admin'])) {
        include ("../connexion.php") ;
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
    
        $requete = "delete from formateurs where id=?";
        $params = array($id);

        $resultat = $conn->prepare($requete);
        $resultat->execute($params);

        header('Location: formateurs.php');
        exit();
    }
    else {
        header('login.php') ;
    }

?>