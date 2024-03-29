<?php
/**
 * File of the list-types-document.php view
 * @package App\Views\TypesDocument
 * @filesource
 */
namespace App\Views\TypesDocument;

/**
 * Dummy class
 */
class ListTypesDocument{}
?>

<?php include("entete.php")?>
    <title>Chercher un type de document</title>
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
                        <h5 style="text-align: center">Chercher un type de document</h5>
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
                <div class="row" style="align-content: center">
                    <div id="grid"></div>
                </div>
            </div >
            <form id="form-show-types-document" method="post" action="/types-document/show">
                <input id='input-types-document' name='typesDocumentId' type='hidden'>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript">
	    /////////////
	    //jqWidgets//
	    //////////////
        <?php if(isset($typesDocumentAsJson)){
            echo 'var data ='.$typesDocumentAsJson;
        }?>

	    // prepare the data
	    var source = {
			    datatype: "json",
			    datafields: [
				    { name: 'id', type: 'string'},
				    { name: 'name', type: 'string'}
			    ],
			    localdata: data
        };

	    var dataAdapter = new $.jqx.dataAdapter(source);

	    $("#grid").jqxGrid({
			    width: '100%',
			    source: dataAdapter,
		        autoheight: true,
			    enablehover: true,
                theme: 'energyblue',
			    selectionmode: 'singlerow',
			    columns: [
				    { text: 'Id', datafield: 'id', width: '10%' },
				    { text: 'Name', datafield: 'name', width: '90%' },
			    ]
        });

        $("#grid").on('rowselect', function (event) {
	        $('#input-types-document').val(event.args.row.id);
	        $('#form-show-types-document').submit();
        });

    </script>

<?php include("footer.php") ?>