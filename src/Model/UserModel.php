<?php

namespace Model;

class UserModel extends \Core\Entity{

    public function save()
    {
        $this->create();
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

    public function logAction()
    {
        $req = $this->bdd->prepare("SELECT * FROM users where email = :email AND password = :password");
        $req->bindParam(':email', $this->email);
        $req->bindParam(':password', $this->password);
        $req->execute();
        $count = $req->rowCount();
        if($count){
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getID(){
        $req = $this->bdd->prepare("SELECT id FROM users where email = :email AND password = :password");
        $req->bindParam(':email', $this->email);
        $req->bindParam(':password', $this->password);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC)[0]['id'];
    }
}
// $a = new UserModel('y','y');
// $a->create($tab = ['prenom' => 'nordine','nom' => 'elbarkaoui','age'=>'22 ans','sexe'=>'homme']);
