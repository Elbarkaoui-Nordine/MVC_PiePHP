<?php
namespace Core;

class Database {

    public static function connect(){
        return new \PDO('mysql:host=127.0.0.1;dbname=MVC_PiePHP','root','');
    }
}
