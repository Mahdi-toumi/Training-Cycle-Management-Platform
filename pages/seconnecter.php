<?php
    session_start();
    include('../connexion.php');
    
    $login=isset($_POST['login'])?$_POST['login']:"";
    
    $pwd=isset($_POST['pwd'])?$_POST['pwd']:"";

    $requete="select id,login,role
                from utilisateur where login='$login' 
                and pwd='$pwd' ";
    
    $resultat=$conn->query($requete);

    if($user=$resultat->fetch_assoc()){ 
            $_SESSION['user']=$user;
            header('location:../index.php');
    }else{
        $_SESSION['erreurLogin']="<strong>Erreur</strong> Login ou mot de passe incorrecte!!!";
        header('location:login.php');
    }

?>