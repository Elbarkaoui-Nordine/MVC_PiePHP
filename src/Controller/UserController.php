<?php

namespace Controller;

class UserController extends \Core\Controller{
    
    public function indexAction(){
        echo 'User index here';
    }

    public function signupAction(){
        $this->render('register');
    }

    public function allAction(){
        $model = new \Model\UserModel([]);        
        $this->render('all',['users' => $model->readAll()]);
    }


    public function showAction($id = '')
    {
        if($id != ''){
            $model = new \Model\UserModel(['id' => $id]);
            echo '<pre>';
            print_r($model);
            // $this->render('show',['model' => $model->articles]);
        }
    }

    public function deleteAction($id = null){

        if($id != null){
            $model = new \Model\UserModel(['id' => $id]);
            $model->delete();
            $this->render('delete',['id' => $id]);
        }
    }

    
    public function registerAction()
    {
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['promo_id']) && isset($_POST['voiture_id']))
        {
            $_POST['promo_id'] = (int)$_POST['promo_id'];
            $_POST['voiture_id'] = (int)$_POST['voiture_id'];

            $params = $this->request->getQueryParams();
            $model = new \Model\UserModel($params);
            if(!$model->mailExist()){
                if($model->save() > 0){

                    self::$_render = 'Votre compte a ete cree';
                }
                else{
                    self::$_render = 'un probleme est survenue';
                }
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