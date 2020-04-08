<?php

namespace Model;

class UserModel extends \Core\Entity{

    public $relation = [
        'has_many' => ['table' => 'article' , 'key' => 'user_id'],
        'has_one' => ['table' => 'voiture' , 'key' => 'voiture_id']
         ];

    public function save()
    {
        $this->create();
    }

    public function readAll(){
        return $this->find();
    }

    public function mailExist(){
        if($this->find(['WHERE' => ['email' => $this->param['email']]])){
            return true;
        }
        else
        {
            return false;
        }
    }

    public function accountExist(){
        if($this->find(['WHERE' => ['email' => $this->email , 'password' => $this->password], 'ADD' => 'AND'])){
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getID(){
        return $this->find(['WHERE' => ['email' => $this->email , 'password' => $this->password] , 'ADD' => 'AND'])[0]['id'];
    }
}
// $a = new UserModel('y','y');
// $a->create($tab = ['prenom' => 'nordine','nom' => 'elbarkaoui','age'=>'22 ans','sexe'=>'homme']);
