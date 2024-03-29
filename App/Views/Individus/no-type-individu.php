<?php
/**
 * File of the create-individu-success.php view
 * @package App\Views\Individus
 * @filesource
 */

namespace App\Views\Individus;

/**
 * Dummy class
 */
class CreateIndividuSucces{}
?>

    <?php include("entete.php")?>
    <title>Erreur</title>
    <?php include("header.php")?>
    <?php
if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
if($current_user != '') {
    if ($current_user->hasRole('utilisateur')) {
        include("menu_utilisateur.php");
    } else if ($current_user->hasRole('encodeur')) {
        include("menu_encodeur.php");
    } else if ($current_user->hasRole('administrateur')) {
        include("menu_administrateur.php");
    }
} else {
    include("menu_anonyme.php");
}
?>

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
                        <h5 style="text-align: center">Erreur</h5>
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
            <!--MAIN PANEL -->
            <div class="container">
                <div class="row">
                    <div class="alert alert-warning alert-dismissible fade show">
                        Vous devez créer un type d'individu avant de pouvoir créer un individu !<br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form method="post" action="/types-individu/new" id="form-redirect-type-individu">
                            <input type="button" id="button-type-invidu-creation" value="Créer un type d&apos;individu">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript">
        $('#button-type-invidu-creation').jqxButton({width: "100%", height: "25", theme: "energyblue"});
        $('#button-type-invidu-creation').on('click', function(event){
            $('#form-redirect-type-individu').submit();
        })
    </script>

    <?php include("footer.php") ?>