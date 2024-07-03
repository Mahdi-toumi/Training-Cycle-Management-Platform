<?php 
    include ("../connexion.php") ;

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
  
    $requete = "delete from cycles where id=?";
    $params = array($id);

    $resultat = $conn->prepare($requete);
    $resultat->execute($params);

    header('Location: cycles.php');
    exit();

?>