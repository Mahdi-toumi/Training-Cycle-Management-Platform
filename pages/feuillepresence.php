<?php 
    include ("../connexion.php") ;

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $requete = "SELECT * FROM cycles where id='$id' " ; 
    $res = $conn -> query($requete) ;
    if ($cycle = $res->fetch_assoc()) {
        // Assign fetched data to variables
        $num_action = $cycle['num_action'];
        $entreprise = $cycle['entreprise'];
        $theme = $cycle['theme'];
        $mode = $cycle['mode'];
        $lieu = $cycle['lieu'];
        $gouvernorat = $cycle['gouvernorat'];
        $credit_impot = $cycle['credit_impot'];
        $droit_tirage = $cycle['droit_tirage'];
        $date_deb = $cycle['date_deb'];
        $date_fin = $cycle['date_fin'];
        $heure_deb = $cycle['heure_deb'];
        $heure_fin = $cycle['heure_fin'];
        $pause_deb = $cycle['pause_deb'];
        $pause_fin = $cycle['pause_fin'];
        $num_salle = $cycle['num_salle'];
        $id_formateur = $cycle['id_formateur'];

        $requetef="select * from formateurs where id = '$id_formateur' ";
        $resultatf=$conn->query($requetef);


        $date_deb = new DateTime($date_deb);
        $date_fin = new DateTime($date_fin);

        $heure_deb = new DateTime($heure_deb);
        $heure_fin = new DateTime($heure_fin);
        $pause_deb = new DateTime($pause_deb);
        $pause_fin = new DateTime($pause_fin);
    }

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feuille De Présence</title>
    <link rel="stylesheet" type = "text/css" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../css/feullepresence.css">
    <style>
        @media print {
            #printButton,
            #retourButton {
                display: none !important;
            }

            .print-area {
                page-break-after:avoid;
            }
                    
        }

        .box {
            width: 25px;
            border: 1.5px solid #000000;
            border-radius: 0%;
            text-align : center ;
        }
                
    </style>

</head>
<body>
    <div class="print-area">
        <!-- En-tête avec image -->
        <div class="header">
            <table class="entete">
                <tr>
                    <td style="width :200px ; "><img src="../images/logo_cni.png" alt="log" width="40"></td>
                    <td><h1>Feuille De Présence</h1></td>
                    <td style="width : 200px ; "><p>Ref: FORM.FINC.03</p></td>
                </tr>
            </table>
        </div>

        <!-- Informations sur le cycle -->
        <div class="cycle-info">
            <p>Entreprise: <?php echo $entreprise ?></p>
            <p class = " line2" >N° Action :&nbsp; &nbsp; &nbsp; <input class = "Naction" type="text" value =" <?php echo $num_action ?> "   ></p>
            <p class = " line2"><input class = "box" type="text"  value =" <?php echo ($credit_impot==1)? "X" : ""  ?> ">&nbsp; &nbsp; &nbsp; Credit d'impot </p>
            <p  class = " line2"><input class = "box" type="text" value =" <?php echo ($droit_tirage==1)? "X" : "" ?>  ">&nbsp; &nbsp; &nbsp; Droit de tirage (individuel) </p>
            <p class = " line2"><input class = "box" type="text"  value =" <?php echo ($droit_tirage==0)? "X" : ""?> ">&nbsp; &nbsp; &nbsp; Droit de tirage (collectif) </p><br>
            <p class = " line3">Theme de Formation :...............................<?php echo $theme ?>.......................................... </p>
            <p class = " line3">Mode de Formation :...............................<?php echo $mode ?>.................................... </p>
            <p class = " line3">Num Salle :...<?php echo $num_salle ?>..... </p> <br>
            <p class = " line3">Lieu de deroulement :................................<?php echo $lieu ?>................................................................................. </p>
            <p class = " line3">Gouvernorat :..................................<?php echo $gouvernorat ?>........................................... </p> <br>
            <p class = " line3">Periode : du : ........<?php echo $date_deb->format('d/m/Y'); ?>............ Au : .............<?php echo $date_fin->format('d/m/Y'); ?>.......... Horaire : de :.........<?php echo $heure_deb->format('H:i'); ?>........... a : ...............<?php echo $heure_fin->format('H:i'); ?>............. </p>
            <p class = " line3" >Pause : de : .....<?php echo $pause_deb->format('H:i'); ?>....... a : ......<?php echo $pause_fin->format('H:i'); ?>.....  </p> <br>

            

        </div>

        <!-- Tableau de présence -->
        <div class="presence-table">
            <table class="presence" >
                
                    <tr>
                        <th rowspan="2" style ="width : 22px" >N°</th>
                        <th rowspan="2" style ="width : 170px">Nom et Prénom</th>
                        <th rowspan="2" style ="width : 90px">N°CIN</th>
                        <th rowspan="2" style ="width : 139px">Direction / service</th>
                        <th rowspan="2">Entreprise</th>
                        <th colspan="6" style ="width : 220px ; line-height: 6px; ">EMARGEMENT</th>
                        <!-- Ajouter des colonnes supplémentaires si nécessaire -->
                    </tr>
                
                    <!-- 10 lignes de présence -->
                    <!-- Ajouter des lignes dynamiquement si nécessaire -->
                    <tr class ="emargement">
                        <td><small><b>Journee du <br> <?php echo $date_deb->format('d/m/Y'); ?></b></small></td>
                        <td><small><b>Journee du <br> <?php  $date_deb->modify('+1 day'); echo $date_deb->format('d/m/Y');?></b></small></td>
                        <td><small><b>Journee du <br><?php  $date_deb->modify('+1 day'); echo $date_deb->format('d/m/Y');?></b></small></td>
                        <td><small><b>Journee du <br><?php  $date_deb->modify('+1 day'); echo $date_deb->format('d/m/Y');?></b></small></td>
                        <td><small><b>Journee du <br><?php  $date_deb->modify('+1 day'); echo $date_deb->format('d/m/Y');?></b></small></td>
                        <td><small><b>Journee du <br><?php  $date_deb->modify('+1 day'); echo $date_deb->format('d/m/Y');?></b></small></td>
                        
                    </tr>
                    <tr>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- Continuer jusqu'à 10 lignes -->
                
            </table>
        </div>

        <!-- Tableau de formateurs -->
         <div class="pied">
            <div class="formateur-table">
                <table>
                    <thead>
                        <tr>
                            <th>Nom et Prenom du formateur</th>
                            <th>Spécialité</th>
                            <th>Direction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Lignes de formateurs -->
                        <tr>
                            <td>
                                <?php  if($formateur = $resultatf->fetch_assoc()) { 
                                 echo $formateur['nom'] . ' ' . $formateur['prenom'];    
                                ?>
                            </td>
                            <td>
                                <?php  
                                 echo $formateur['specialite'] ;    
                                ?>
                            </td>
                            <td>
                                <?php   
                                    echo $formateur['direction'];   }  
                                ?>
                            </td>
                        </tr>
                        
                        <!-- Ajouter des lignes supplémentaires si nécessaire -->
                    </tbody>
                </table>
            </div>
            <div class="cachet"><p><b>Signature et Cachet de l'organisme de formation / Entreprise</b></p><br>
                    
                        <button class="btn btn-primary" id="retourButton" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Retour</button>
                        <button class="btn btn-success " id="printButton" onclick="printDocument()"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Imprimer</button>
                  
            </div>
        </div>
    </div>
    
    <script>
        function printDocument() {
            window.print();
        }
        window.onload = function() {
            document.getElementById('printButton').click();
        };
        
    </script>
</body>
</html>
