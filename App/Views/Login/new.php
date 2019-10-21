<?php
/**
 * File of the new.php view
 * @package App\Views\Login
 * @filesource
 */

namespace App\Views\Login;

/**
 * Dummy class
 */
class News{}
?>

<?php include("entete.php")?>
    <title>Login</title>
<?php include("header.php")?>
    <?php
if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
if($current_user != '') {
    if ($current_user->hasRole('ustilisateur')) {
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

        <div class=""row>
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
                            <h5 style="text-align: center">Connection</h5>
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
                <?php
                    if(isset($message_home)){
                        echo '<div class="alert alert-success alert-dismissible fade show">'.$message_home.'</div>';
                    }
                ?>
                <form id="form-login" action="/login/create" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <label class="float-right">Adresse email :</label>
                            </div>
                            <div class="col-6">
                                <input id="inputEmail" name="email" placeholder="votre adresse email" required type="email" value="<?php if(isset($email)){echo $email;} ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="float-right">Mot de passe :</label>
                            </div>
                            <div class="col-6">
                                <input type="password" id="inputPassword" name="password" placeholder="votre mot de passe" value="<?php if(isset($password)){echo $password;}?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="float-right">Se souvenir de moi :</label>
                            </div>
                            <div class="col-6">
                                <div id="remember_me" name="remember_me"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row" style="align-content: center">
                            <div class="col">
                                <div style="display: table; margin: auto">
                                    <input type="button" value="Se connecter" id="button-submit" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
	$('#inputEmail').jqxInput({width: 200, height: 30, theme: "energyblue"});

	$('#inputPassword').jqxPasswordInput({ width: 200, height: 30, theme: "energyblue"});

	$('#remember_me').jqxCheckBox({ width: 25, height: 25, theme:"energyblue" });

	$("#button-submit").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$('#button-submit').click(function(){
		$('#form-login').submit();
    });
</script>
<?php include("footer.php");