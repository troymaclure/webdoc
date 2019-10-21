<?php
/**
 * File of the upload-document-success.php view
 * @package App\Views\Documents
 * @filesource
 */

namespace App\Views\Documents;

/**
 * Dummy class
 */
Class UploadDocumentSuccess{}

?>

<?php include("entete.php")?>
    <title>Upload réussi !</title>
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
                        <h5 style="text-align: center">Upload réussi !</h5>
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
            <div class="alert alert-success alert-dismissible fade show">
                Le document a bien été uploadé ! <br/>
            </div>
            <form id="form-return-to-individu-view" method="post" action="/individus/show">
                <input type="hidden" name="individuid" value="<?php if (isset($individuid)){echo $individuid;} ?>" />
                <div class="container">
                    <div class="row">
                        <input type="button" id="button-submit" value="Retourner à la fiche Individu">
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript">

	    //////////////
	    // jqWidgets//
	    //////////////
	    $('#button-submit').jqxButton({width: "100%", height: "25", theme: "energyblue"});
	    $('#button-submit').click(function(){
		    $('#form-return-to-individu-view').submit();
	    });
    </script>

<?php include("footer.php") ?>