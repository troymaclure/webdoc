<?php
/**
 * File for TypeIndividu class
 * @package App\Models
 * @filesource
 */
namespace App\Models;

use \Core\Model;
use function json_encode;
use PDO;
use function strtolower;
use function utf8_encode;
use function var_dump;

/**
 * Class TypeIndividu
 * Create object mapped on TypeIndividu table
 * and allow retrieval and record of data in the table TypeIndividu
 * @package App\Models
 */

class TypeIndividu extends Model
{


    /**
     * Errors from validation of user input before create and update operation (see validate() method)
     * @var array
     */
    public $errors = [];

    /**
     * Class constructor
     * @param array $data  Initial property values (optional)
     * @return void
     */
    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    /**
     * Save the TypeIndividu model with the current property values
     * @return boolean True if the user was saved, false otherwise
     */
    public function save(){
	    $this->name = strtolower($this->name);
	    if($this->checkTypeIndividuExist($this->name)){
		    $this->errors[] = 'Un type d\'individu avec ce nom existe déjà.';
	    }else {
		    $this->validate();
	    }

        if (empty($this->errors)) {
        	$sql = 'INSERT 
                    INTO typesindividu (name) 
                    VALUES (:name)';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            return $stmt->execute();
        }
        return false;
    }

	/**
	 * Check if typeindividu exist in the DB
	 * @param string $name The typeindividu name
	 * @return bool True if document exist false otherwise
	 */
	private function checkTypeIndividuExist($name){
		$sql = 'SELECT count(*)
                FROM typesindividu
                WHERE name=:name';
		$db = static::getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->fetchColumn();
		return ($count > 0 ? true : false);
	}

	/**
	 * Check if there is already a typeindividu in the database
	 * @return boolean false if not user, true otherwise
	 **/
	public static function isThereFirstTypeIndividu(){
		$sql = 'SELECT count(*)
                FROM typesindividu';
		$db = static::getDB();
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$count = $stmt->fetchColumn();
		return ($count > 0 ? true : false);
	}

    /**
     * validate the fields of form create and update and fill error[] viariable for user insight
     * @return void
     */
    public function validate(){

        if ($this->name === '') {
            $this->errors[] = 'Nom de type d&apos;individu requit !';
        }

        if (preg_match('/.*[A-Za-z]+.*/i', $this->name) === 0) {
            $this->errors[] = 'Nom de type d&apos;individu requière au moins une lettre !';
        }

        if (preg_match('/.*[A-Za-z]+.*/i', $this->name) === 0) {
            $this->errors[] = 'Nom de type d&apos;individu requière au moins une lettre !';
        }

        if (preg_match('/^[0-9A-Za-zéèëêïîôöûüùäâà\-_ ]*$/', $this->name) === 0) {
            $this->errors[] = 'Seul les caractères "/^[0-9A-Za-zéèëêïîôöûüäâ\-_ ]*$/" sont autorisés !';
        }
    }

	/**
	 * See if a typesindividu record already exists with the specified name
	 * @param string $name name to search for
	 * @return boolean True if a record already exists with the specified email, false otherwise
	 */
	public static function nameExists($name){
		return static::findByName($name) !== false;
	}

	/**
	 * Find a typeindividu model by name
	 * @param string $name to search for
	 * @return mixed User object if found, false otherwise
	 */
	public static function findByName($name){
		$sql = 'SELECT * 
	                FROM typesindividu 
	                WHERE name =:name';
		$db = static::getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
		$stmt->execute();
		return $stmt->fetch();
	}

    /**
     * Return a json list of all name of type of individu
     * @return string json object
     */
    public static function getListAsJson(){
        $sql = 'SELECT name 
                FROM typesindividu';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }

    /**
     * Get the id of the index of
     * @param string $name The name of the TypeIndividu
     *
     */
    public static function getIndexFromName($name){
        $sql = 'SELECT * 
                FROM typesindividu 
                WHERE name=:name ';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute(['name' => $name]);
        $array = $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($array as $key =>$value){
            $index = $value;
            break;
        }
        return $index;
    }

    /**
     * Get TypeDocument list as Json object
     * @param string $subStringName The subtring of the name of document type entered in the search field
     * @return string $jsonList List of DocumentType as json list
     */
    public static function getListSubAsJson($subStringName){
        $subStringName = strtolower($subStringName);
        $sql = 'SELECT * 
                FROM typesindividu 
                WHERE name LIKE concat(:substring, "%")';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':substring', $subStringName, PDO::PARAM_STR);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }

    /**
     * Get TypeIndividu object from an id
     * @param int $id The id of the looked for typesIndividu
     * @return object TypeIndividu object
     */
    public static function getById($id){
        $sql = 'SELECT * 
                FROM typesindividu 
                WHERE id=:id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $typesIndividu = $stmt->fetch();
        return $typesIndividu;
    }

    /**
     * Get Name of TypeIndividu from its id
     * @param int $id The id of the TypeIndividu
     * @return string TypeIndividu name
     */
    public static function getNameFromIndex($id){
        $sql = 'SELECT * 
                FROM typesindividu 
                WHERE id=:id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        $typesIndividu = $stmt->fetch();
        return $typesIndividu->name;
    }

    /**
     * Update TypeIndividu object in the database
     * @param int $id The id of the object to update
     * @return boolean True if success, false otherwise.
     */
    public function update(){
        $this->validate();

        if(empty($this->errors)){
            $this->name = strtolower($this->name);
            $sql = 'UPDATE typesindividu 
                    SET name=:name 
                    WHERE id=:id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            return $stmt->execute();
        }else{
            return false;
        }
    }

    /**
     * Delete TypeIndividu object in the database if not used
     * @param int $id The id of the object to delete
     * @return mixed
     */
    public static function delete($id){
        $sql = 'DELETE 
                FROM typesindividu 
                WHERE id=:id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Magical function __toString
     * Show the object as a json object.
     */
    public function __toString(){
        return json_encode($this);
    }
}