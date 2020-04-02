<?php

namespace Controller;

class UserController extends \Core\Controller{
    
    public function indexAction(){
        echo 'User index here';
    }

    public function signupAction(){
        $this->render('register');
    }
    
    public function registerAction()
    {
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $params = $this->request->getQueryParams();
            $model = new \Model\UserModel($params);
            if(!$model->mailExist()){
                $model->save();
                self::$_render = 'Votre compte a ete cree';
            }
            else{
                echo 'Cette adresse email est deja prise.';
                $this->render('register');
            }
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
                $this->render('login');
            }
        }
        else
        {
            $this->render('login');
        }
    }
}