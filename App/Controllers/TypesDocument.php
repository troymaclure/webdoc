<?php
namespace App\Controllers;

use App\Models\TypeDocument;

use Core\View;
use function substr;
use function var_dump;

/**
 * Class TypesDocument
 * Controller Controlling the logic of document types domain
 * @package App\Controllers
 */
class TypesDocument extends Authenticated
{
    /**
     * Control /types-document/new
     * @return void
     * @throws \Exception
     */
    public function newAction(){
        View::render('TypesDocument/create-type-document.php');
    }

    /**
     * Handle creation of a document type
     * @return void
     * @throws \Exception
     */
    public function createAction(){
        $typeDocument = new TypeDocument($_POST);

        if ($typeDocument->save()) {
            $this->redirect('/types-document/create-type-document-success');
        } else {
            View::render('TypesDocument/create-type-document.php', [
                'typeDocument' => $typeDocument
            ]);
        }
    }

    /**
     * Redirection after Type document creation
     * @return void
     */
    public function createTypeDocumentSuccessAction(){
        View::render('TypesDocument/create-type-document-success.php');
    }

    /**
     * Handle search view
     * @return void
     */
    public function searchAction(){
        View::render('TypesDocument/search-type-document.php');
    }

    /**
     * Call and handles the list results of the search form
     * @return void
     */
    public function listAction(){
        $subTypeDocumentName = substr($_POST['inputTypeDocumentName'], 0, 3);
        $typesDocumentAsJson = TypeDocument::getListSubAsJson($subTypeDocumentName);
        View::render('TypesDocument/list-types-document.php', [
            'typesDocumentAsJson' => $typesDocumentAsJson
        ]);
    }

    /**
     * Handle show-type-individu.php view
     * @return void
     */
    public function showAction(){
        $typeDocumentId = $_POST['typesDocumentId'];
        $typeDocument = TypeDocument::getById($typeDocumentId);
        //var_dump($typeDocument);
        View::render('TypesDocument/show-type-document.php', [
            'typeDocument' => $typeDocument
        ]);
    }

    /**
     * Handle database update operation view and redirect according to result of operation
     * @return void
     */
    public function updateAction(){
        $typeDocument = new TypeDocument($_POST);

        if($typeDocument->update() === true){
            $this->redirect('/types-document/update-type-document-success');
        }else{
            View::render('TypesDocument/show-type-document.php', [
                'typeDocument' => $typeDocument,
            ]);
        }
    }

    /**
     * Redirect to update-type-document-success after update Action
     * @return void
     */
    public function updateTypeDocumentSuccessAction(){
        View::render('TypesDocument/update-type-document-success.php');
    }

    /**
     * Call databate delete operation and redirect according to result of operation
     * @return void
     * @throws \Exception
     */
    public function deleteAction(){
        $id = $_POST['id'];
        if(TypeDocument::delete($id) === true){
            View::render('TypesDocument/delete-type-document-success.php');
        }else{
            View::render('TypesDocument/delete-type-document-faillure.php');
        }
    }

	/**
	 * Ajax valifation checking the existence of a matricule
     * @return void
	 */
	public function validateNameAction(){
		$is_valid = ! TypeDocument::nameExists($_GET['name']);
		header('Content-Type: application/json');
		echo json_encode($is_valid);
	}
}