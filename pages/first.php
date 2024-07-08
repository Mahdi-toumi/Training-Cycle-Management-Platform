<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CNI - Présentation</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/firstpagestyle.css">



    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
            font-weight: 700;
        }

        hr {
            height: 0.2px;
            background-color: #000;
            border: none;
        }

        .titel {
            font-size: 20px;
        }
    </style>



</head>

<body>

    <?php include("menu.php"); ?>


    <!-- Header -->
    <header class="jumbotron text-center">
        <div class="container header-logo">
            <img src="../images/logo_cni.png" alt="Logo CNI">

        </div>
        <div class="container header-text titel">
            <p>Votre partenaire pour des formations de qualité et des compétences certifiées.</p>
        </div>
    </header>

    <!-- Présentation -->
    <section id="presentation" class="container py-5 presentation">
        <h2 class="text-center"><b>Présentation de l'entreprise</b></h2><br><br>
        <p class="text-center">
            Le Centre National de l'Informatique (CNI) est une institution dédiée à la formation professionnelle et au développement des compétences dans le domaine de l'informatique.
            Fort de plusieurs années d'expérience, le CNI propose des programmes de formation adaptés aux besoins du marché et des entreprises. <small><a href="http://www.cni.tn/index.php/fr/layout-3/presentation-du-cni-2" target="_blank">plus d'information</a></small>
        </p>
    </section><br>
    <hr>
    <br><br>
    <!-- Cycles de Formations -->
    <section id="formations" class="container py-5">
        <h2 class="text-center"><b>Cycles de Formations Disponibles</b></h2>
        <?php include("affichagecycles.php"); ?>


    </section>

    <!-- Footer -->
    <footer class="footer ">
        <div class="container text-center bg-dark text-white">
            <p class="text-muted">© 2024 CNI. Tous droits réservés.</p>
        </div>
    </footer>






</body>

</html>