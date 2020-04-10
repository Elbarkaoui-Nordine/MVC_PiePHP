<?php

namespace Controller;

class UserController extends \Core\Controller{
    
    public function indexAction(){
        echo 'User index here';
    }

    public function signupAction(){
        $this->render('register');
    }


    public function testAction(){
        $this->render('test');
    }
    public function showAction($id)
    {
        $model = new \Model\UserModel(['id' => $id]);
        echo '<pre>';
        print_r($model);
        echo '</pre>';
    }
    public function snkAction(){
        $model = new \Model\UserModel(['id' => '1']);
        echo '<pre>';
        print_r($model);
        echo '</pre>';
    }

    public function readAllAction(){
        $model = new \Model\UserModel([]);
        $tab = $model->readAll();

        $inst = [];
        foreach( $tab as $value ){
            $inst[] = new  \Model\UserModel($value);   
        }
        echo '<pre>';
        print_r($inst);
        echo '<pre>';
       
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

    public function erreurAction(){
        echo 'Vous avez mis un point d\'interogation';
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
            $model = new \Model\UserModel($_POST);
            if($model->accountExist())
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