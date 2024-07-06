<?php
    session_start();
    include('../connexion.php');
    
    $login=isset($_POST['login'])?$_POST['login']:"";
    
    $pwd=isset($_POST['pwd'])?$_POST['pwd']:"";

    $requete="select id,login
                from admin where login='$login' 
                and pwd='$pwd' ";
    
    $resultat=$conn->query($requete);

    if($admin=$resultat->fetch_assoc()){ 
            $_SESSION['admin']=$admin;
            header('location:../index.php');
    }else{
        $_SESSION['erreurLogin']="<strong>Erreur</strong> Login ou mot de passe incorrecte!!!";
        header('location:login.php');
    }

?>