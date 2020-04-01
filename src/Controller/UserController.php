<?php

namespace Controller;

class UserController extends \Core\Controller{
    
    public function indexAction(){
        echo 'User index here';
    }
    
    public function registerAction()
    {
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $model = new \Model\UserModel($_POST['email'],$_POST['password']);
            $model->save($_POST['email'],$_POST['password']);
        }
    }

    public function logAction()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            echo 'bien connecter a la session '.$_SESSION['id'];
        }
        else if(isset($_POST['email']) && isset($_POST['password']))
        {
            $model = new \Model\UserModel($_POST['email'],$_POST['password']);
            if($model->logAction($_POST['email'],$_POST['password']))
            {
                
                $_SESSION['id'] = $model->getID();
                echo 'bien connecter a la session '.$_SESSION['id'];
            }
            else
            {
                echo 'mauvais identifiant';
                echo $this->render('login');
            }
        }
        else
        {
            echo $this->render('login');
        }
    }
}