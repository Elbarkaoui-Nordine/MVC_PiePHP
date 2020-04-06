<?php

namespace Model;

class UserModel extends \Core\Entity{

    public function save()
    {
        $this->create();
    }

    public function readAll(){
        return $this->find();
    }

    public function mailExist(){
        if($this->find(['WHERE' => ['email' => $this->email]])){
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
