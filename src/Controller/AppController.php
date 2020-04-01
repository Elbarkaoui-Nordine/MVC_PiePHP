<?php

namespace Controller;

// Faire un lien qui menne a une methode qui render la page login et qui verifie
class AppController extends \Core\Controller{
    public function addAction(){
        echo $this->render('index');
    }

    public function indexAction(){
        echo 'The app index function has been called';
    }
    
    public function weshAction(){
        echo 'wesh alors';
    }
} 