<?php

namespace Core;
require_once ( implode ( DIRECTORY_SEPARATOR , [ 'Core' , 'autoload.php']) ) ;
class Core {

    public function run ()
    {
        echo __CLASS__ . " [ OK ]" . PHP_EOL ;
    }
    
    public function getURL()
    {
        $URL = array_filter(explode('/',$_SERVER['REQUEST_URI'])); 
        if(count($URL) == 3){
            $method = array_reverse($URL)[0].'Action';
            $class = 'Controller\\'.ucfirst(array_reverse($URL)[1]).'Controller';
        }
        else if (count($URL) == 2){
            $class = 'Controller\\'.ucfirst(array_reverse($URL)[0]).'Controller';
            $method = 'indexAction';
        }
        else
        {
            $class = 'Controller\\AppController';
            $method = 'indexAction';
        }

        if(class_exists($class)){
            $int = new $class();
            if(method_exists($class,$method)){
                $int->$method();
            }
            else{
                echo 'error 404';
            }
        }
        else
        {
            echo 'error 404';
        }
        
    }
}   



