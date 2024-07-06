<?php 
    session_start() ;
    if (!isset($_SESSION['admin'])) {
        include ("../connexion.php") ;
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $cin = isset($_POST['cin']) ? $_POST['cin'] : "";
        $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
        $direction = isset($_POST['direction']) ? $_POST['direction'] : "";
        $entreprise = isset($_POST['entreprise']) ? $_POST['entreprise'] : "";

        $requete = "SELECT * FROM participants WHERE cin = '$cin' AND nom = '$nom' AND prenom = '$prenom' ";
        $resultat=$conn->query($requete) ;

        $requetedate = "SELECT * FROM cycles WHERE id = '$id' ";
        $resultatdate=$conn->query($requetedate) ;
        $cyc = $resultatdate->fetch_assoc() ;
        $date_fin = $cyc['date_fin'] ;
        $date_deb = $cyc['date_deb'] ;
        $today = date("Y-m-d");

        if ( $participants=$resultat->fetch_assoc() and $date_fin>$today and $today>$date_deb ){
            $_SESSION['erreurinscription']="<strong>Erreur</strong> Vous etes actuellement inscrit a un cycle!!!";
             header('location: ../index.php');
        }

        elseif ($participants=$resultat->fetch_assoc()){
            $requeteupdate = "UPDATE participants set cin=?, nom=?, prenom=?, direction=?, entreprise=? , id_cycle=? WHERE cin = '$cin' AND nom = '$nom' AND prenom = '$prenom'";
            $params = array($cin, $nom, $prenom, $direction, $entreprise, $id );
            $resultatipdate = $conn->prepare($requeteupdate);
            $resultatipdate->execute($params);
            header('Location: ../index.php');
            exit();

        }
        else {
            $requeteinsert = "INSERT INTO participants (cin, nom, prenom, direction, entreprise , id_cycle ) VALUES (?, ?, ?, ?, ?, ?)";
            $params = array($cin, $nom, $prenom, $direction, $entreprise, $id );
            $resultatinsert = $conn->prepare($requeteinsert);
            $resultatinsert->execute($params);
            header('Location: ../index.php');
            exit();

        }

    
        


        
    }
    else {
        $_SESSION['erreurinscription']="<strong>Erreur</strong> Vous etes un Admin!!!";
        header('location: ../index.php');
    }

?>