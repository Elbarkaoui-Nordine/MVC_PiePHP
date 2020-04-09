<?php

namespace Model;

class UserModel extends \Core\Entity{

    public $relation = [
        'has_many' => [ ['table' => 'article' , 'key' => 'user_id'] ],
        'has_one' => [ ['table' => 'voiture' , 'key' => 'voiture_id'] ],
        'many_to_many' => [ ['table1' => 'user' , 'table2' => 'item'] ],
         ];
//on connais la table pivot car il faut concatener les deux table ? 
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
