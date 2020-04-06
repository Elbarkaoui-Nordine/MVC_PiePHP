<?php

namespace Core;

class Core {
    
    function __construct()
    {
        include_once('src/routes.php');
    }

    public function run()
    {
       
        $URL = array_filter(explode('/',$_SERVER['REQUEST_URI'])); 
        $URLRoute = str_replace('/MVC_PiePHP','',$_SERVER['REQUEST_URI']);
    
        if(Router::get($URLRoute) != null){
            $router = Router::get($URLRoute);
            $class = 'Controller\\'.ucfirst($router['controller']).'Controller';
            $method = $router['action'].'Action';
        }
        else if(count($URL) == 3){
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
                if(isset(Router::$id)){$int->$method(Router::$id);}else{$int->$method();}
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



