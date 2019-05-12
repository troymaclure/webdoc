<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/styles/bootstrap.css" >
    <link rel="stylesheet" href="/styles/jqx.base.css">
    <link rel="stylesheet" href="/styles/jqx.energyblue.css">
    <link rel="stylesheet" href="/styles/custom.css">
    <script type="text/javascript" src="/scripts/jqx-all.js"></script>
    <script type="text/javascript" src="/scripts/menu.js"></script>
</head>
<body>
<div id="wrap">
    <div id="pageheader">
        <h1>WEBDOC</h1>
    </div>
    <!-- Begin page content -->
    <div class="container">
        <div class="row">
            <div id="app-menu" class="offset-lg-3 col-lg-6">
                <script type="text/javascript">

                </script>

                <div id="window-about">
                    <div>Au sujet de...</div>
                    <div>Copyright (c) 2019 [Stéphane Piriou], MIT License.</div>
                </div>
                <div id='jqxMenu'>
                    <ul>
                        <li>Connexion
                            <ul>
                                <li><a href="../login/login.php">Déconnecter</a></li>
                            </ul>
                        <li>Individu
                            <ul>
                                <li><a href="../individus/chercher-type-individu.php">Chercher un Individu</a></li>
                                <li><a href="../individus/creer-un-individu.php">Créer un Individu</a></li>
                                <li style="color: rgb(148, 176,202);">---------------------</li>
                                <li><a href="../individus/chercher-type-individu.php">Chercher un Type d'Individu</a></li>
                                <li><a href="../individus/creer-un-individu.php">Créer un Type d'Individu</a></li>
                            </ul>
                        </li>
                        <li>Documents
                            <ul>
                                <li><a href="../documents/chercher-un-document.php">Chercher un Document</a></li>
                                <li style="color: rgb(148, 176,202);">---------------------</li>
                                <li><a href="../documents/chercher-type-document.php">Chercher un Type de Document</a></li>
                                <li><a href="../documents/creer-type-document.php">Créer un Type de Document</a></li>
                            </ul>
                        </li>
                        <li>Backup
                            <ul>
                                <li><a href="../backup/creer-un-backup.php">Créer un backup</a></li>
                                <li><a href="../backup/restaurer-un-backup.php">Restaurer un backup</a></li>
                            </ul>
                        </li>
                        <li>Utilisateurs
                            <ul>
                                <li><a href="../utilisateurs/creer-un-utilisateur.php">Créer un utilisateur</a></li>
                                <li><a href="../utilisateurs/chercher-un-utilisateur.php">Chercher un utilisateur</a></li>
                            </ul>
                        </li>
                        <li>?
                            <ul>
                                <li><a href="../aide/aide.php">Aide</a></li>
                                <li><a id="about" >Au sujet de...</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- </div> -->
            </div>
        </div>
        <div class="row">
            <div class="col">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <!-- TITLE PAGE-->
            <div id="page-title" class="offset-lg-3 col-lg-6">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h5 style="text-align: center"><?= $titlepage ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div id="main-panel"  class="offset-lg-3 col-lg-6">
                <div class="container">
                    <div class="row">
                        &nbsp;<?= $mainpanel ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12" id="footer">

</div>
<script type="text/javascript">
<?= $bottomscript ?>
</script>
</body>
</html>

<?php
