<?php

namespace Model;


class UserModel extends \Core\Entity{
    private $email;
    private $password;
    private $bdd;

    public function __construct($email,$password)
    {
        $this->bdd = new \PDO('mysql:host=127.0.0.1;dbname=MVC_PiePHP','root','');
        $this->email = $email;
        $this->password = $password;
    }

    public function save()
    {

        $req = $this->bdd->prepare("INSERT INTO users (email,password) VALUES(:email,:password)");
        $req->bindParam(':email', $this->email);
        $req->bindParam(':password', $this->password);
        $req->execute();
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

