<?php
/**
 * File for Signup class
 * @package App\Controllers
 */
namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Signup controller
 * @package App\Controllers
 */
class Signup extends \Core\Controller
{

    /**
     * Show the signup page
     * @return void
     */
    public function newAction(){
        View::render('Signup/new.php');
    }

    /**
     * Sign up a new user
     * @return void
     */
    public function createAction(){
        $user = new User($_POST);

        if ($user->save()) {
            $this->redirect('/signup/success');
        } else {
            View::render('Signup/new.php', [
                'user' => $user
            ]);
        }
    }

    /**
     * Show the signup success page
     * @return void
     */
    public function successAction(){
        View::render('Signup/success.php');
    }
}
