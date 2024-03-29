<?php
/**
 * File for Documents class
 * @package App\Controllers
 * @filesource
 */
namespace App\Controllers;
use Core\Logger;
use App\Config;
use App\Downloader;
use Core\View;
use App\Models\Document;
use App\Models\TypeDocument;
use App\Uploader;

/**
 * Class Documents
 * Control the Document domain of the application
 * @package App\Controllers
 */
class Documents extends Authenticated
{
    /**
     * LOG_MODE
     * @var int
     */
    const LOG_MODE = Logger::DEBUG;

    /**
     * Load the view proposing the creation of a document
     * @return void
     * @throws \Exception
     */
    public function newAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('creation')){
            $individuid = $_POST['individuid'];
            $individumatricule = $_POST['individumatricule'];
            $individufirstname = $_POST['individufirstname'];
            $individulastname = $_POST['individulastname'];
            $jsonListTypesDocument = TypeDocument::getListAsJson();
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER DOCUMENTS/NEW :: $individuid: '.$individuid.'; $individumatricule: '.$individumatricule.'; $individufirstname: '.$individufirstname.'; $individulastname: '.$individulastname.'; $jsonlisttypedocument: '.$jsonListTypesDocument);
            View::render('Documents/upload-document.php',[
                'individuid' => $individuid,
                'individufirstname' => $individufirstname,
                'individulastname' => $individulastname,
                'jsonListTypesDocument' => $jsonListTypesDocument,
                'individumatricule' => $individumatricule
            ]);
        }else{
            View::render('Default/no-permission.php');
        }
    }

    /**
     * Upload and create a document from the view /documents/new.
     * Redirect to /documents/new in case of faillure with proper error handling
     * @return void
     * @throws \Exception
     */
    public function uploadAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('creation')){
            $individuid = $_POST['individuid'];
            $individumatricule = $_POST['individumatricule'];
            $individulastname = $_POST['individulastname'];
            $individufirstname = $_POST['individufirstname'];
            $typedocument = $_POST['typedocument'];
            $file = $_FILES["fileToUpload"];
            $typedocumentid = TypeDocument::getIndexFromName($typedocument);
            $documentname = $typedocument.' de '.$individufirstname.' '.$individulastname.'('.$individumatricule.')';
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER DOCUMENTS/UPLOAD :: $individuid: '.$individuid.'; $individumatricule: '.$individumatricule.'; $individufirstname: '.$individufirstname.'; $individulastname: '.$individulastname.'; $typedocument: '.$typedocument.'; $file:'.$file.'; $typedocumentid:'.$typedocumentid.'; $documentname:'.$documentname);

            $upload = new Uploader($file, $documentname, $typedocumentid, $individuid);
            $success = $upload->uploadFile();

            if($success){
                $logger = new Logger(Logger::UPLOAD, Config::LOG_ENABLED);
                $logger->writeLog('IN CONTROLLER DOCUMENTS/UPLOAD FROM UPLOADER :: $upload->uploadFile(): true.');
                View::render('Documents/upload-document-success.php', [
                    'individuid' => $individuid,
                    'individulastname' => $individulastname,
                    'individufirstname' => $individufirstname,
                    'documentname' => $documentname
                ]);
            }else{
                $logger = new Logger(Logger::UPLOAD, Config::LOG_ENABLED);
                $logger->writeLog('IN CONTROLLER DOCUMENTS/UPLOAD FROM UPLOADER :: $upload->uploadFile(): false.');
                $jsonListTypesDocument = TypeDocument::getListAsJson();
                View::render('Documents/upload-document.php',[
                    'individuid' => $individuid,
                    'individufirstname' => $individufirstname,
                    'individulastname' => $individulastname,
                    'chosentypedocument' => $typedocument,
                    'jsonListTypesDocument' => $jsonListTypesDocument,
                    'individumatricule' => $individumatricule,
                    'upload' => $upload
                ]);
            }
        }else{
            View::render('Default/no-permission.php');
        }

    }

    /**
     * Show an existing document under /documents/show
     * @return void
     * @throws \Exception
     */
    public function showAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('consultation')) {
            $individuid = $_POST['individuid'];
            $documentid = $_POST['documentid'];
            $documentname = Document::getDocumentName($documentid);
            $filename = Document::getFileName($documentid);
            $filepath = Config::RELATIVE_UPLOAD_FOLDER . $filename;
            $serverfilepath = Config::SERVER_URL . $filepath;
            $absolutefilepath = Config::ABSOLUTE_UPLOAD_FOLDER . $filename;
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER DOCUMENTS/SHOW :: $individuid: '.$individuid.'; $documentid:'.$documentid.'; $documentname:'.$documentname.'; $filename:'.$filename.'; $filepath:'.$filepath.'; $serverfilepath:'.$serverfilepath.'; $absolutefilepath:'.$absolutefilepath);
            View::render('Documents/show-document.php',[
                'individuid' => $individuid,
                'documentname' => $documentname,
                'filepath' => $filepath,
                'serverfilepath' => $serverfilepath,
                //'filename' => $filename,
                'documentid' => $documentid,
            ]);
        }else{
            View::render('Default/no-permission.php');
        }
    }


    /**
     * Hangle le download des document par les utilisateurs
     */
    public function downloadAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('consultation')) {
            $documentid = $_POST['documentid'];
            $filename = Document::getFileName($documentid);
            $documentname = Document::getDocumentName($documentid);

            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER DOCUMENTS/DOWNLOAD :: $documentid:'.$documentid.'; $filename;'.$filename.'; $documentname:'.$documentname);

            $downloader = new Downloader($filename, $documentname);
            $downloader->send();
            $success = $downloader->isDownloadSuccess();
            $logger2 = new Logger(Logger::DOWNLOAD, Config::LOG_ENABLED);
            $logger2->writeLog('IN CONTROLLER DOCUMENTS/DOWNLOAD FROM DOWNLOADER :: downloader->isDownloadSuccess(): '.$this->success.' bytes downloaded.');
            if ($success){
                $logger = new Logger(Logger::DOWNLOAD, Config::LOG_ENABLED);
                $logger->writeLog('IN CONTROLLER DOCUMENTS/DOWNLOAD FROM DOWNLOADER :: downloader->isDownloadSuccess(): '.$this->success.' bytes downloaded.');
            }else{
                $logger = new Logger(Logger::DOWNLOAD, Config::LOG_ENABLED);
                $logger->writeLog('IN CONTROLLER DOCUMENTS/DOWNLOAD FROM DOWNLOADER :: downloader->isDownloadSuccess(): false');
            }
        }else{
            View::render('Default/no-permission.php');
        }
    }


    /**
     * Call Document::delete and redirect according to result
     * @return void
     * @throws \Exception
     */
    public function deleteAction(){
        if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
        if($current_user->hasPermission('modification')) {
            $documentid = $_POST['documentid'];
            $individuid = $_POST['individuid'];
            $logger = new Logger(self::LOG_MODE, Config::LOG_ENABLED);
            $logger->writeLog('IN CONTROLLER DOCUMENTS/DELETE :: $documentid:'.$documentid.'; $individuid;'.$individuid);
            if(Document::delete($documentid) === true){
                View::render('Documents/delete-document-success.php', [
                    'individuid' => $individuid
                    ]);
            }else{
                View::render('Documents/delete-document-faillure.php', [
                    'individuid' => $individuid
                ]);
            }
        }else{
            View::render('Default/no-permission.php');
        }
    }
}