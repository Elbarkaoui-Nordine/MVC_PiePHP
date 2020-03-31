<?php

namespace Controller;

class UserController extends \Core\Controller{
    
    public function indexAction(){
        echo $this->render('login');
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
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $model = new \Model\UserModel($_POST['email'],$_POST['password']);
            if($model->logAction($_POST['email'],$_POST['password']))
            {
                echo 'bien connecter';
            }
            else
            {
                echo 'pas connecter';
                echo $this->render('login');
            }
        }
    }
}