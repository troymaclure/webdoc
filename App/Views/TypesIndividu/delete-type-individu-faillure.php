<?php
/**
 * File of the delete-type-individu-faillure.php view
 * @package App\Views\TypesIndividu
 * @filesource
 */
namespace App\Views\TypesIndividu;

/**
 * Dummy class
 */
class DeleteTypeIndividuFaillure{}
?>

<?php include("entete.php")?>
    <title>Effacer un type d&apos;individu</title>
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
                        <h5 style="text-align: center">Effacer un type d&apos;individu</h5>
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
                <div class="alert alert-danger alert-dismissible fade show">
                    Le type d&apos;individu n'a bien été effacé ! <br/>
                    Etes-vous certain certain que ce type d&apos;individu n'est pas actuellement utilisé ? <br/>
                    Un type d&apos;individu ne peut pas être effacé tant qu'il est utilisé pour décrire un individu.<br/>
                    Veuiller <strong>effacer les/l&apos;individu</strong> ou <strong>changer leur type</strong> avant d'essayer à nouveau.
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

    </script>

<?php include("footer.php") ?>