<?php
/**
 * File of the create-user.php view
 * @package App\Views\Users
 * @filesource
 */
namespace App\Views\Users;

/**
 * Dummy class
 */
class CreateUser{}
?>


<?php include("entete.php")?>
    <title>Créer un utilisateur</title>
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
                        <h5 style="text-align: center">Créer un utilisateur</h5>
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
            <form method="post" action="/users/create" id="form-create-user">
                <div class="container">
                    <?php if (!empty($user->errors)){
                        $errors_message = '<div class="alert alert-danger alert-dismissible fade show"><strong>Errors</strong>
                        <ul>';
                        foreach($user->errors as $error){
                            $errors_message .= '<li>';
                            $errors_message .= $error;
                            $errors_message .= '</li>';
                        }
                        $errors_message .= '</ul></div>';
                        echo $errors_message;
                    }?>
                    <div class="row">
                        <div class="col">
                            <label class="float-right">Email :</label>
                        </div>
                        <div class="col">
                            <input id="input-email" name="email" placeholder="Email adresse" required autofocus type="email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="float-right">Nom d'utilisateur :</label>
                        </div>
                        <div class="col">
                            <input type="text" id="input-name" name="name" placeholder="Nom d&apos;utilisateur" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Role :</label>
                        </div>
                        <div class="col-6">
                            <div id="dropdown-role-name" name="rolename"></div>
                            <input type="hidden"  id="input-role-id" name="roleid" value="1" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right"> Role description </label>
                        </div>
                        <div class="col-6">
                            <textarea id="textarea-role-description" nom="roledescriprion"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="float-right">Password :</label>
                        </div>
                        <div class="col">
                            <input type="password" id="input-password" name="password" placeholder="Password" />
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
                                <input type="button" value="Créer utilisateur" id="button-submit" />
                            </div>
                        </div>
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
        <?php if (isset($roleNameListAsJson)) {
            echo 'var roleNameDataSource =' . $roleNameListAsJson.';';
        };?>

        var descriptionData = [];
        descriptionData.push('Un utilisateur peut consulter les données ainsi qu\'afficher, imprimer et téléchargér les documents');
        descriptionData.push('Un encodeur peut consulter les données, les modifier, les effacer, afficher les documents, les effacer. Il ne peut pas télécharger ces documents, ni les imprimer.');
        descriptionData.push('Un administrateur s\'occupe uniquement de la gestion des utilisateur. Il ne peut mi consulter les données, ni les effacer.');

        $('#dropdown-role-name').jqxDropDownList({source: roleNameDataSource, width: '100%', height: 30, theme: "energyblue"});
        $('#dropdown-role-name').jqxDropDownList('selectItem', "utilisateur" );
        $('#dropdown-role-name').on('change', function(event) {
            $('#textarea-role-description').val(descriptionData[$('#dropdown-role-name').jqxDropDownList('selectedIndex')]);
            $("#input-role-id").val($('#dropdown-role-name').jqxDropDownList('selectedIndex')+1);
        });

        $('#textarea-role-description').jqxTextArea({height: 100, width: '100%', minLength: 1, disabled: true, theme: "energyblue" });
        $('#textarea-role-description').val(descriptionData[0]);

	    $('#input-name').jqxInput({width: '100%', height: 30, theme: "energyblue"});

	    $('#input-email').jqxInput({width: '100%', height: 30, theme: "energyblue"});

	    $('#input-password').jqxPasswordInput({width: '100%', height: 30, theme: "energyblue"});

	    $('#button-submit').jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $('#button-submit').click(function(){
		    $('#form-create-user').submit();
	    });

	    //
	    // Password validator function
	    //
	    $.validator.addMethod('validAlphaNum',
		    function(value, element, param){
			    if(value !== ''){
				    if (value.match(/^[0-9A-Za-zéèëêïîôöûüäâ\- ]*$/) == null){
					    return false;
				    }
			    }
			    return true;
		    },
		    'Ne doit contenir que des chiffres et des lettres (A-Z & a-z) des tirets et des espaces!'
	    );

	    $.validator.addMethod('validPassword',
		    function(value, element, param){
			    if(value !== ''){
				    if (value.match(/.*[a-z]+.*/i) == null){
					    return false;
				    }
				    if (value.match(/.*\d+.*/) == null){
					    return false;
				    }
			    }
			    return true;
		    },
		    'Doit contenir aumoins 1 lettre et 1 nombre!'
	    );
	    $(document).ready(function(){
		    $("#form-create-user").validate({
			    rules: {
				    name: {
					    required: true,
					    minlength: 3,
					    validAlphaNum: true
				    },
				    email: {
					    required: true,
					    email: true,
					    remote: "/account/validate-email"
				    },
				    password: {
					    required: true,
					    minlength: 6,
					    validPassword: true
				    }
			    },
			    messages: {
				    email: {
					    remote: "Email est déjà prit!"
				    }
			    }
		    });
	    });

    </script>

<?php include("footer.php") ?>