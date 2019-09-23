<?php
/**
 * File for Account class
 * @package App\Controllers
 */
namespace App\Controllers;

use \App\Models\User;

/**
 * Account controller
 * @package App\Controllers
 */
class Account extends \Core\Controller
{

    /**
     * Validate if email is available (AJAX) for a new signup.
     * @return void
     */
    public function validateEmailAction(){
        $is_valid = ! User::emailExists($_GET['email']);

        header('Content-Type: application/json');
        echo json_encode($is_valid);
    }
}