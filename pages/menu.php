<?php
session_start();

?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="../index.php" class="navbar-brand"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Acceuil</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="cycles.php">Les cycles de formation</a></li>
            <?php if (isset($_SESSION['admin'])) { ?>
                <li><a href="formateurs.php">Les formateurs</a></li>
                <li><a href="participants.php">Les participants</a></li>
            <?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">

            <?php if (isset($_SESSION['admin'])) { ?>
                <li><a><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Admin</a></li>
                <li><a onclick="return confirm('Etes-vous sûr de vouloir vous déconnecter ?')" href="deconnecter.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Se deconnecter</a></li>
            <?php } else { ?>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;S'authentifier&nbsp;&nbsp;</a></li>
            <?php } ?>


        </ul>
    </div>
</nav>